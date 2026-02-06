<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RekapPenugasanExport implements FromView
{
    protected $tahun;
    protected $bulan;
    protected $type;

    public function __construct($tahun, $bulan, $type)
    {
        $this->tahun = $tahun;
        $this->bulan = $bulan;
        $this->type = $type;
    }

    public function view(): View
    {
        $query = DB::table('penugasans')
            ->join('jenis__pengawasans', 'penugasans.id_jenisPengawasan', '=', 'jenis__pengawasans.id')
            ->join('obriks', 'penugasans.id_obrik', '=', 'obriks.id')
            ->leftJoin('kegiatans', 'penugasans.id_anggaran', '=', 'kegiatans.id')
            ->select(
                'penugasans.*',
                'jenis__pengawasans.nama_jenispengawasan as jenis_nama',
                'obriks.nama_obrik as obrik_nama',
                'kegiatans.kegiatan'
            )
            ->whereYear('penugasans.tanggalAwalPenugasan', $this->tahun)
            ->orderBy('penugasans.tanggalAwalPenugasan', 'ASC');

        if ($this->type === 'monthly' && $this->bulan) {
            $query->whereMonth('penugasans.tanggalAwalPenugasan', $this->bulan);
        }

        $data = $query->get();

        // Transform data
        $mappedData = $data->map(function ($item) {
            // 1. Fetch View Data to get filtered officers (matches 'Bukti Penerimaan')
            $viewData = DB::table('v_demo7')->where('id', $item->id)->first();
            $officers = $viewData ? json_decode($viewData->detail_petugas) : [];

            // 2. Fetch IDs for Overlap Logic (Name -> ID Map)
            $suratTugasDb = DB::table('surat_tugas')
                ->join('pegawais', 'surat_tugas.id_pegawai', '=', 'pegawais.id')
                ->where('surat_tugas.id_penugasan', $item->id)
                ->select('surat_tugas.id_pegawai', 'pegawais.nama_pegawai')
                ->get();

            $pegawaiMap = [];
            foreach ($suratTugasDb as $st) {
                $pegawaiMap[$st->nama_pegawai] = $st->id_pegawai;
            }

            $totalAnggaran = 0;

            foreach ($officers as $off) {
                // Filter out 'Pengguna Anggaran' relative to User Feedback
                if (isset($off->peran) && stripos($off->peran, 'Pengguna Anggaran') !== false) {
                    continue;
                }

                // Resolve ID
                $idPegawai = $pegawaiMap[$off->namapegawai] ?? null;

                // Dates from JSON or Fallback
                $start = isset($off->tanggalPemeriksaanAwal) ? Carbon::parse($off->tanggalPemeriksaanAwal) : Carbon::parse($item->tanggalAwalPenugasan);
                $end = isset($off->tanggalPemeriksaanAkhir) ? Carbon::parse($off->tanggalPemeriksaanAkhir) : Carbon::parse($item->tanggalAkhirPenugasan);

                // --- LOGIC PENENTUAN HARI EFEKTIF (Match SuratController) ---
                $blockingRanges = [];

                if ($idPegawai) {
                    // 1. Get Overlaps from Tabel Kendali
                    $overlaps = DB::table('tabel_kendalis')
                        ->where('id_pegawai', $idPegawai)
                        ->get();

                    foreach ($overlaps as $ov) {
                        $blockingRanges[] = [
                            'start' => Carbon::parse($ov->tanggal_awal_pemeriksaan)->startOfDay(),
                            'end' => Carbon::parse($ov->tanggal_akhir_pemeriksaan)->endOfDay()
                        ];
                    }

                    // 2. Get Overlaps from Newer Assignments
                    $otherAssignments = DB::table('surat_tugas')
                        ->join('penugasans', 'surat_tugas.id_penugasan', '=', 'penugasans.id')
                        ->where('surat_tugas.id_pegawai', $idPegawai)
                        ->where('surat_tugas.id_penugasan', '>', $item->id)
                        ->select('surat_tugas.*', 'penugasans.tanggalAwalPenugasan', 'penugasans.tanggalAkhirPenugasan')
                        ->get();

                    foreach ($otherAssignments as $oa) {
                        $oaStart = $oa->tanggalAwalPemeriksaan ? Carbon::parse($oa->tanggalAwalPemeriksaan) : Carbon::parse($oa->tanggalAwalPenugasan);
                        $oaEnd = $oa->tanggalAkhirPemeriksaan ? Carbon::parse($oa->tanggalAkhirPemeriksaan) : Carbon::parse($oa->tanggalAkhirPenugasan);

                        $blockingRanges[] = [
                            'start' => $oaStart->startOfDay(),
                            'end' => $oaEnd->endOfDay()
                        ];
                    }
                }

                // Calculate Effective Days
                $period = \Carbon\CarbonPeriod::create($start, $end);
                $effectiveDays = 0;

                foreach ($period as $date) {
                    if ($date->isWeekend()) {
                        continue;
                    }

                    $isBlocked = false;
                    foreach ($blockingRanges as $range) {
                        if ($date->betweenIncluded($range['start'], $range['end'])) {
                            $isBlocked = true;
                            break;
                        }
                    }

                    if (!$isBlocked) {
                        $effectiveDays++;
                    }
                }

                // Use Tarif from JSON
                $tarif = $off->tarif ?? 0;
                $cost = $effectiveDays * $tarif;
                $totalAnggaran += $cost;
            }

            // Format Date Range
            $sDate = Carbon::parse($item->tanggalAwalPenugasan);
            $eDate = Carbon::parse($item->tanggalAkhirPenugasan);

            if ($sDate->format('M Y') == $eDate->format('M Y')) {
                $tanggal = $sDate->format('d') . ' s/d ' . $eDate->translatedFormat('d F Y');
            } else {
                $tanggal = $sDate->translatedFormat('d F Y') . ' s/d ' . $eDate->translatedFormat('d F Y');
            }

            return (object) [
                'noSurat' => "700.1.1/" . $item->noSurat . "/03/" . $this->tahun,
                'jenisPemeriksaan' => $item->jenis_nama,
                'kegiatan' => $item->kegiatan,
                'obrik' => $item->obrik_nama,
                'anggaran' => 'Rp' . number_format($totalAnggaran, 0, ',', '.'),
                'tanggal' => $tanggal,
                'tanggalOriginal' => $item->tanggalAwalPenugasan // Helper for sorting/grouping
            ];
        });

        // Group by Month Index (1-12) for sorting
        $groupedData = $mappedData->groupBy(function ($item) {
            return (int) Carbon::parse($item->tanggalOriginal)->format('n');
        });

        // Ensure groupedData is sorted by keys (1, 2, 3...)
        $groupedData = $groupedData->sortKeys();

        $nama_bulan = $this->bulan ? Carbon::createFromDate(null, $this->bulan)->translatedFormat('F') : 'Tahun ' . $this->tahun;

        return view('exports.rekap_penugasan', [
            'groupedData' => $groupedData,
            'tahun' => $this->tahun,
            'bulan' => strtoupper($nama_bulan),
            'isYearly' => $this->type === 'yearly'
        ]);


    }
}
