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
            // Calculate Budget (Anggaran)
            $suratTugas = DB::table('surat_tugas')
                ->join('perans', 'surat_tugas.id_peran', '=', 'perans.id')
                ->where('surat_tugas.id_penugasan', $item->id)
                ->select('surat_tugas.*', 'perans.tarif')
                ->get();

            $totalAnggaran = 0;
            foreach ($suratTugas as $st) {
                // Determine dates (use row dates or fallback to penugasan dates)
                $start = $st->tanggalAwalPemeriksaan ? Carbon::parse($st->tanggalAwalPemeriksaan) : Carbon::parse($item->tanggalAwalPenugasan);
                $end = $st->tanggalAkhirPemeriksaan ? Carbon::parse($st->tanggalAkhirPemeriksaan) : Carbon::parse($item->tanggalAkhirPenugasan);

                // Calculate days (inclusive)
                $days = $end->diffInDays($start) + 1;
                $cost = $days * $st->tarif;
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

        // Group by Month Name for all types (Unified structure)
        $groupedData = $mappedData->groupBy(function ($item) {
            return Carbon::parse($item->tanggalOriginal)->translatedFormat('F');
        });

        // Sort groups by Month order (since groupBy sorts by key string, which might be alphabetical)
        // We need chronological order. 
        // Better strategy: Sort mappedData by date first (already done by SQL orderBy), 
        // so groupBy should preserve order if using a stable sort, 
        // but groupBy results are keyed by the string.
        // Actually, $mappedData is already sorted by date.
        // The keys of grouped collection will appear in order of appearance.
        // So January comes first, etc.

        $nama_bulan = $this->bulan ? Carbon::createFromDate(null, $this->bulan)->translatedFormat('F') : 'Tahun ' . $this->tahun;

        return view('exports.rekap_penugasan', [
            'groupedData' => $groupedData,
            'tahun' => $this->tahun,
            'bulan' => strtoupper($nama_bulan),
            'isYearly' => $this->type === 'yearly'
        ]);

    }
}
