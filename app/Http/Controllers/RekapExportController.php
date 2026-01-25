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
            'type' => 'required|in:yearly,monthly',
            'bulan' => 'required_if:type,monthly',
        ]);

        $tahun = $request->tahun;
        $type = $request->type;
        $bulan = $type === 'monthly' ? $request->bulan : null;

        if ($type === 'monthly') {
            $nama_bulan = \Carbon\Carbon::createFromDate(null, $bulan)->translatedFormat('F');
            $filename = 'Rekap_Perjalanan_Dinas_' . $nama_bulan . '_' . $tahun . '.xlsx';
        } else {
            $filename = 'Rekap_Perjalanan_Dinas_Tahun_' . $tahun . '.xlsx';
        }

        return Excel::download(new RekapPenugasanExport($tahun, $bulan, $type), $filename);
    }

    public function indexExportPerSubKegiatan()
    {
        return view('admin.rekap_export_Persubkegiatan');
    }

}
