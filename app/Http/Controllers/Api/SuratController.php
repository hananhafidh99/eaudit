<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Penugasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SuratController extends Controller
{
     //
   //
   public function index(Request $request)
{
    $tahun = session('tahun');
    $sdata = session('sdata');
    $penugasan = Penugasan::with('jenisPengawasan')->where('tanggalTerbitPenugasan','like','%'.session('tahun').'%')->orderBy('tanggalAwalPenugasan','DESC')->orderBy('noSurat','DESC');
                if ($request->N) {
                    # code...
                    $penugasan = $penugasan->get();

                    return response()->json([
                    'status' => true,
                    'message' => 'Data ditemukan',
                    'data' => $penugasan],200);

                }else {
                    // $penugasan = $penugasan->paginate(10);
                    $penugasan = DB::table('v_demo3')->where('tanggalTerbitPenugasan','like','%'.session('tahun').'%')->orderBy('tanggalAwalPenugasan','DESC')->orderBy('noSurat','DESC')->paginate(10);
                //     $dataTransformed = $penugasan->getCollection()->map(function ($item) {
                //     return [
                //         'id' => $item->id,
                //         'jenisPengawasan' => $item->jenisPengawasan ? $item->jenisPengawasan->nama_jenispengawasan : null,
                //         'obrik' => $item->obrik ? $item->obrik->nama_obrik : null,
                //         'noSurat' => "700.1.1/".$item->noSurat."/03"."/".session('sdata'),
                //         'tanggal' => Carbon::parse($item['tanggalAwalPenugasan'])->translatedFormat('d M Y') .' s/d '. Carbon::parse($item['tanggalAkhirPenugasan'])->translatedFormat('d M Y'),
                //         // 'pegawai' => $item->suratTugas->pegawai ? $item->suratTugas->pegawai->nama_pegawai : null,

                //         // 'nip_pegawai' => $item->nip_pegawai,
                //         // 'status_pegawai' => $item->tanggalAwalPenugasan,
                //         // 'rekening_pegawai' => $item->rekening_pegawai,
                //         // 'pangkat' => $item->pangkat ? $item->pangkat->nama_pangkat : null,
                //     ];
                // });
                $dataTransformed = collect($penugasan->items())->map(function ($item) use ($sdata) {
                            return [
                                'id' => $item->id,
                                'jenisPengawasan' => $item->nama_jenispengawasan ?? null,
                                'obrik' => $item->nama_obrik ?? null,
                                'noSurat' => "700.1.1/{$item->noSurat}/03/".Carbon::parse($item->tanggalAwalPenugasan)->translatedFormat('Y'),
                                'tanggal' => Carbon::parse($item->tanggalAwalPenugasan)->translatedFormat('d M Y') .
                                            ' s/d ' .
                                            Carbon::parse($item->tanggalAkhirPenugasan)->translatedFormat('d M Y'),
                                'pegawai' => $item->daftar_pegawai,
                    ];
                    });
                $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
                    $dataTransformed,
                    $penugasan->total(),
                    $penugasan->perPage(),
                    $penugasan->currentPage(),
                    [
                        'path' => request()->url(),
                        'query' => request()->query(),
                    ]
                );

                return response()->json([
                    'status' => true,
                    'message' => 'Data ditemukan',
                    'data' => $paginated],200);
                }


}


    public function storePenugasan(Request $request)
    {
        $penugasanData = json_decode($request->input('penugasan', '{}'), true);
        $surattugasData = json_decode($request->input('surattugas', '{}'), true);

        $penugasanId = DB::table('penugasans')->insertGetId([
            'noSurat'                => $penugasanData['noSurat'] ?? null,
            'id_jenisPengawasan'     => $penugasanData['id_jenisPengawasan'] ?? null,
            'id_obrik'               => $penugasanData['id_obrik'] ?? null,
            'tanggalTerbitPenugasan' => $penugasanData['tanggalTerbitPenugasan'] ?? null,
            'id_anggaran'            => $penugasanData['id_anggaran'] ?? null,
            'tanggalAwalPenugasan'   => $penugasanData['tanggalAwalPenugasan'] ?? null,
            'tanggalAkhirPenugasan'  => $penugasanData['tanggalAkhirPenugasan'] ?? null,
            'created_at'             => Carbon::now(),
            'updated_at'             => Carbon::now(),
        ]);

        $tugasArr   = isset($surattugasData['tugas']) ? array_values($surattugasData['tugas']) : [];
        $anggotaArr = isset($surattugasData['anggota']) ? array_values($surattugasData['anggota']) : [];

        foreach ($tugasArr as $tugas) {
            DB::table('surat_tugas')->insert([
                'id_penugasan' => $penugasanId,
                'id_pegawai'   => $tugas['id_pegawai'] ?? null,
                'id_peran'     => $tugas['dperan'] ?? null,
                'tanggalAwalPemeriksaan' => $tugas['tanggalAwalPemeriksaan'] ?? null,
                'tanggalAkhirPemeriksaan' => $tugas['tanggalAkhirPemeriksaan'] ?? null,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ]);
        }

        foreach ($anggotaArr as $anggota) {
            DB::table('surat_tugas')->insert([
                'id_penugasan' => $penugasanId,
                'id_pegawai'   => $anggota['id_pegawai'] ?? null,
                'id_peran'     => $anggota['dperan'] ?? null,
                'tanggalAwalPemeriksaan' => $anggota['tanggalAwalPemeriksaan'] ?? null,
                'tanggalAkhirPemeriksaan' => $anggota['tanggalAkhirPemeriksaan'] ?? null,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ]);
        }

        return [
            'status'  => true,
            'message' => 'Data berhasil disimpan.'
        ];

    }

   public function editPenugasan(Request $request,$id)
    {
    $penugasan = DB::table('v_demo3')->where('id', $id)->first();
    $penugasan->detail_petugas = json_decode($penugasan->detail_petugas);
    foreach($penugasan->detail_petugas as $v)
    {
        $v->namapegawai = $this->formatNamaDenganGelar($v->namapegawai);
    }
    return response()->json([
       'status' => true,
       'message' => 'Data  ditemukan',
       'data' => $penugasan
       ]);
    }

    public function buktiPenugasan(Request $request,$id)
    {
    $penugasan = DB::table('v_demo7')->where('id', $id)->first();
    $penugasan->detail_petugas = json_decode($penugasan->detail_petugas);
    $total = 0;
    foreach ($penugasan->detail_petugas as $v => $item) {
    try {
        $totalDayWeekend = $this->hitungSabtuMinggu($item->tanggalPemeriksaanAwal, $item->tanggalPemeriksaanAkhir) - 1;
    } catch (\Throwable $e) {
        $totalDayWeekend = 0;
    }

    $item->Jumlah    = ($item->Hari -= $totalDayWeekend) * $item->tarif;
    $item->terbilang = ucfirst($this->terbilang($item->Jumlah));
    $total += $item->Jumlah;
    }
    $penugasan->terbilang = ucfirst($this->terbilang($total));
    $penugasan->totalJumlah = $total;
    $penugasan->pptk_info = json_decode($penugasan->pptk_info);
    return response()->json([
       'status' => true,
       'message' => 'Data  ditemukan',
       'data' => $penugasan
       ]);

    }

    public function suratdinas(Request $request,$id)
    {
    dd('tes');
    $penugasan = DB::table('v_demo8')->where('id', $id)->first();
    $penugasan->detail_petugas = json_decode($penugasan->detail_petugas);
    $total = 0;
    foreach ($penugasan->detail_petugas as $v => $item) {
    try {
        $totalDayWeekend = $this->hitungSabtuMinggu($item->tanggalPemeriksaanAwal, $item->tanggalPemeriksaanAkhir) - 1;
    } catch (\Throwable $e) {
        $totalDayWeekend = 0;
    }

    $item->Jumlah    = ($item->Hari -= $totalDayWeekend) * $item->tarif;
    $item->terbilang = ucfirst($this->terbilang($item->Jumlah));
    $total += $item->Jumlah;
    }
    return response()->json([
       'status' => true,
       'message' => 'Data  ditemukan',
       'data' => $penugasan
       ]);
    }

    private function penyebut($nilai) {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = $this->penyebut($nilai - 10). " belas";
        } else if ($nilai < 100) {
            $temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . $this->penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . $this->penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
        }
        return $temp;
    }

    private function terbilang($nilai) {
        if($nilai<0) {
            $hasil = "minus ". trim($this->penyebut($nilai));
        } else {
            $hasil = trim($this->penyebut($nilai));
        }
        return $hasil;
    }

    private function hitungSabtuMinggu($tanggalAwal, $tanggalAkhir) {
    $periode = CarbonPeriod::create($tanggalAwal, $tanggalAkhir);

    return collect($periode)->filter(function ($tanggal) {
        return $tanggal->isSaturday() || $tanggal->isSunday();
    })->count();
    }



    public function editBerkas(Request $request,$id)
    {
    $penugasan = DB::table('v_demo5')->where('id', $id)->first();
    $penugasan->detail_petugas = json_decode($penugasan->detail_petugas);
    return response()->json([
       'status' => true,
       'message' => 'Data  ditemukan',
       'data' => $penugasan
       ]);
    }

    private function formatNamaDenganGelar($input, $preserveGelar = true) {
    // Dr. Sutomo, M.Si.
    #inisialisasi gelar
    $gelarKhusus = ['Drs.', 'Dr.', 'Prof.', 'Msi', 'M.Si', 'Ir.', 'H.', 'Hj.', 'S.T.', 'S.Si', 'M.T.', 'M.Kom', 'Mkom'];
    $parts = array_map('trim', explode(',', $input));
    $namaBagian = array_shift($parts);
    $namaWords = explode(' ', $namaBagian);
    $formattedNama = [];
    foreach ($namaWords as $word) {
        if ($preserveGelar && in_array($word, $gelarKhusus)) {
            $formattedNama[] = $word;
        } else {
            $formattedNama[] = strtoupper($word);
        }
    }
    $result = implode(' ', $formattedNama);
    if (count($parts) > 0) {
        $result .= ', ' . implode(', ', $parts);
    }
    return $result;
}

public function arsip()
{
$penugasan = DB::table('v_demo3')->where('tanggalTerbitPenugasan','like','%'.session('tahun').'%')->orderBy('tanggalAwalPenugasan','DESC')->orderBy('noSurat','DESC')->get();
return response()->json([
            'status'     => true,
            'message'    => 'data di temukan',
            'data'       => $penugasan
        ],200);
}

public function arsipobrik(Request $request)
{
    $query = DB::table('v_demo3');
    foreach ($request->all() as $key => $value) {
        if (!in_array($key, ['token']) && !empty($value)) {
            $query->where($key, 'LIKE', '%' . $value . '%');
        }
    }

    $penugasan = $query->orderBy('tanggalAwalPenugasan', 'DESC')
                       ->orderBy('noSurat', 'DESC')
                       ->get();
    return response()->json([
        'status'  => true,
        'message' => 'data ditemukan',
        'data'    => $penugasan
],200);
}

public function update(Request $request)
{
    $id=$request->id;
    // $validated=$request;
    // Validasi input
    $validated = $request->validate([
        'noSurat'                  => 'required|string|max:255',
        'id_jenis_pengawasan'      => 'required|integer',
        'Tanggalsurat'              => 'required|date',
        'TanggalAkhir'              => 'required|date|after_or_equal:Tanggalsurat',
        'tanggalterbitSurat'        => 'required|date',
        'id_anggaran'               => 'required|integer',
        'tugas'                     => 'nullable|array',
        'anggota'                   => 'nullable|array',
        'ubahtugas'                 => 'nullable|array',
        'ubahanggota'               => 'nullable|array',
    ]);
// return response()->json([
//     'data'=>$request->noSurat,
//     'status' => 'success',
//     'message' => 'is valid'
// ], 200);

    try {
        DB::beginTransaction();

        // Cek apakah penugasan ada
        $penugasan = DB::table('penugasans')->where('id', $id)->first();
        if (!$penugasan) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data penugasan tidak ditemukan'
            ], 404);
        }

        // Update penugasan
        DB::table('penugasans')->where('id', $id)->update([
            'noSurat'                => $validated['noSurat'],
            'id_jenisPengawasan'     => $validated['id_jenis_pengawasan'],
            'tanggalTerbitPenugasan' => $validated['tanggalterbitSurat'],
            'id_anggaran'            => $validated['id_anggaran'],
            'tanggalAwalPenugasan'   => $validated['Tanggalsurat'],
            'tanggalAkhirPenugasan'  => $validated['TanggalAkhir'],
            'updated_at'             => now(),
        ]);

        // Update surat tugas yang ada
        if (!empty($validated['ubahtugas'])) {
            foreach ($validated['ubahtugas'] as $idSuratTugas => $tugasData) {
                DB::table('surat_tugas')->where('id', $idSuratTugas)->update([
                    'id_pegawai'              => $tugasData['id_pegawai'] ?? null,
                    'id_peran'                => $tugasData['id_peran'] ?? null,
                    'tanggalAwalPemeriksaan'  => $tugasData['tanggalAwalPemeriksaan'] ?? null,
                    'tanggalAkhirPemeriksaan' => $tugasData['tanggalAkhirPemeriksaan'] ?? null,
                    'updated_at'              => now(),
                ]);
            }
        }

        if (!empty($validated['ubahanggota'])) {
            foreach ($validated['ubahanggota'] as $idSuratTugas => $anggotaData) {
                DB::table('surat_tugas')->where('id', $idSuratTugas)->update([
                    'id_pegawai'              => $anggotaData['id_pegawai'] ?? null,
                    'tanggalAwalPemeriksaan'  => $anggotaData['tanggalAwalPemeriksaan'] ?? null,
                    'tanggalAkhirPemeriksaan' => $anggotaData['tanggalAkhirPemeriksaan'] ?? null,
                    'updated_at'              => now(),
                ]);
            }
        }

        $plit=DB::table('surat_tugas')->whereNull('id_pegawai')->delete();

        // Insert tugas baru
        if (!empty($validated['tugas'])) {
            foreach ($validated['tugas'] as $peranId => $tugasData) {
                if (!empty($tugasData['id_pegawai'])) {
                    DB::table('surat_tugas')->insert([
                        'id_penugasan'            => $id,
                        'id_pegawai'              => $tugasData['id_pegawai'],
                        'id_peran'                => $peranId,
                        'tanggalAwalPemeriksaan'  => $tugasData['tanggalAwalPemeriksaan'] ?? null,
                        'tanggalAkhirPemeriksaan' => $tugasData['tanggalAkhirPemeriksaan'] ?? null,
                        'created_at'              => now(),
                        'updated_at'              => now(),
                    ]);
                }
            }
        }

        // Insert anggota baru
        if (!empty($validated['anggota'][8])) {
            foreach ($validated['anggota'][8] as $anggotaData) {
                if (!empty($anggotaData['id_pegawai'])) {
                    DB::table('surat_tugas')->insert([
                        'id_penugasan'            => $id,
                        'id_pegawai'              => $anggotaData['id_pegawai'],
                        'id_peran'                => 8,
                        'tanggalAwalPemeriksaan'  => $anggotaData['tanggalAwalPemeriksaan'] ?? null,
                        'tanggalAkhirPemeriksaan' => $anggotaData['tanggalAkhirPemeriksaan'] ?? null,
                        'created_at'              => now(),
                        'updated_at'              => now(),
                    ]);
                }
            }
        }

        DB::commit();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data penugasan berhasil diperbarui'
        ], 200);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'status'  => 'error',
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500);
    }
}


public function editPenugasanbaru(Request $request,$id)
    {
     $penugasan = DB::table('penugasans')->join('jenis__pengawasans', 'penugasans.id_jenisPengawasan', '=', 'jenis__pengawasans.id')->join('obriks', 'penugasans.id_obrik', '=', 'obriks.id')
     ->join('kegiatans', 'penugasans.id_anggaran', '=', 'kegiatans.id')
    ->select('penugasans.*', 'jenis__pengawasans.nama_jenispengawasan','obriks.nama_obrik','kegiatans.kegiatan')->where('penugasans.id', $id)->first();


    return response()->json([
       'status' => true,
       'message' => 'Data  ditemukan',
       'data' => $penugasan
       ]);
    }

}
