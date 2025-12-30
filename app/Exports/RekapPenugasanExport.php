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

    public function __construct($tahun, $bulan)
    {
        $this->tahun = $tahun;
        $this->bulan = $bulan;
    }

    public function view(): View
    {
        $data = DB::table('penugasans')
            ->leftJoin('jenis__pengawasans', 'penugasans.id_jenisPengawasan', '=', 'jenis__pengawasans.id')
            ->leftJoin('obriks', 'penugasans.id_obrik', '=', 'obriks.id')
            ->leftJoin('kegiatans', 'penugasans.id_anggaran', '=', 'kegiatans.id')

            ->select(
                'penugasans.*',
                'jenis__pengawasans.nama_jenispengawasan',
                'obriks.nama_obrik',
                'kegiatans.kegiatan'
            )

            ->whereYear('penugasans.tanggalAwalPenugasan', $this->tahun)
            ->whereMonth('penugasans.tanggalAwalPenugasan', $this->bulan)
            ->orderBy('penugasans.tanggalAwalPenugasan', 'ASC')
            ->get();

        // Transform data mostly for date formatting
        $mappedData = $data->map(function ($item) {
            $start = Carbon::parse($item->tanggalAwalPenugasan)->translatedFormat('d');
            $end = Carbon::parse($item->tanggalAkhirPenugasan)->translatedFormat('d F Y');
            // If same month/year, maybe shorthand? 
            // User example: "02 s/d 15 Januari 2025"
            // If full strings: "02 Januari 2025 s/d 15 Januari 2025" -> maybe too long.
            // Logic: if same month/year, just dd - dd Month YYYY.

            // Replicating example format: "02 s/d 15 Januari 2025"
            $sDate = Carbon::parse($item->tanggalAwalPenugasan);
            $eDate = Carbon::parse($item->tanggalAkhirPenugasan);

            if ($sDate->format('M Y') == $eDate->format('M Y')) {
                $tanggal = $sDate->format('d') . ' s/d ' . $eDate->translatedFormat('d F Y');
            } else {
                $tanggal = $sDate->translatedFormat('d F Y') . ' s/d ' . $eDate->translatedFormat('d F Y');
            }

            // No Surat format: 094/003/03/2025 (Example)
            // Existing logic in index: "700.1.1/{$item->noSurat}/03/" . year
            // User Example in Excel: "094/003/03/2025"
            // I'll stick to what is in DB or standard Format. 
            // Let's use the field `noSurat` from DB and append/prepend if necessary. 
            // The `index` view did this: "700.1.1/".$item->noSurat."/03/".session('sdata')
            // I'll assume standard format is required.

            return (object) [
                'noSurat' => "700.1.1/" . $item->noSurat . "/03/" . $this->tahun,
                'jenisPemeriksaan' => $item->nama_jenispengawasan,
                'kegiatan' => $item->kegiatan,
                'obrik' => $item->nama_obrik,
                'anggaran' => 'Rp0', // Placeholder as per request
                'tanggal' => $tanggal
            ];
        });

        $nama_bulan = Carbon::createFromDate(null, $this->bulan)->translatedFormat('F');

        return view('exports.rekap_penugasan', [
            'data' => $mappedData,
            'tahun' => $this->tahun,
            'bulan' => strtoupper($nama_bulan)
        ]);
    }
}
