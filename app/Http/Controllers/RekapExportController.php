<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\RekapPenugasanExport;
use Maatwebsite\Excel\Facades\Excel;

class RekapExportController extends Controller
{
    public function index()
    {
        return view('admin.rekap_export');
    }

    public function export(Request $request)
    {
        $request->validate([
            'tahun' => 'required',
            'bulan' => 'required',
        ]);

        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $nama_bulan = \Carbon\Carbon::createFromDate(null, $bulan)->translatedFormat('F');

        $filename = 'Rekap_Perjalanan_Dinas_' . $nama_bulan . '_' . $tahun . '.xlsx';

        return Excel::download(new RekapPenugasanExport($tahun, $bulan), $filename);
    }
}
