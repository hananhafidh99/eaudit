<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Penugasan;
use App\Models\Tabel_kendali;
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
        $tahun = $request->input('tahun');
        $sdata = $request->input('tahun');

        $query = Penugasan::with('jenisPengawasan');

        if ($tahun) {
            $query->where('tanggalTerbitPenugasan', 'like', '%' . $tahun . '%');
        }

        $penugasan = $query->orderBy('tanggalAwalPenugasan', 'DESC')->orderBy('noSurat', 'DESC');

        if ($request->N) {
            # code...
            $penugasan = $penugasan->get();

            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $penugasan
            ], 200);

        } else {
            // $penugasan = $penugasan->paginate(10);
            $queryDb = DB::table('v_demo3');

            if ($tahun) {
                $queryDb->where('tanggalTerbitPenugasan', 'like', '%' . $tahun . '%');
            }

            $penugasan = $queryDb->orderBy('tanggalAwalPenugasan', 'DESC')->orderBy('noSurat', 'DESC')->paginate(10);
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
                    'noSurat' => "700.1.1/{$item->noSurat}/03/" . Carbon::parse($item->tanggalAwalPenugasan)->translatedFormat('Y'),
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
                'data' => $paginated
            ], 200);
        }


    }


    public function storePenugasan(Request $request)
    {
        $penugasanData = json_decode($request->input('penugasan', '{}'), true);
        $surattugasData = json_decode($request->input('surattugas', '{}'), true);

        $penugasanId = DB::table('penugasans')->insertGetId([
            'noSurat' => $penugasanData['noSurat'] ?? null,
            'id_jenisPengawasan' => $penugasanData['id_jenisPengawasan'] ?? null,
            'id_kelompokPenugasan' => $penugasanData['id_kelompokPenugasan'] ?? null,
            'id_obrik' => $penugasanData['id_obrik'] ?? null,
            'tanggalTerbitPenugasan' => $penugasanData['tanggalTerbitPenugasan'] ?? null,
            'id_anggaran' => $penugasanData['id_anggaran'] ?? null,
            'tanggalAwalPenugasan' => $penugasanData['tanggalAwalPenugasan'] ?? null,
            'tanggalAkhirPenugasan' => $penugasanData['tanggalAkhirPenugasan'] ?? null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $tugasArr = isset($surattugasData['tugas']) ? array_values($surattugasData['tugas']) : [];
        $anggotaArr = isset($surattugasData['anggota']) ? array_values($surattugasData['anggota']) : [];

        foreach ($tugasArr as $tugas) {
            DB::table('surat_tugas')->insert([
                'id_penugasan' => $penugasanId,
                'id_pegawai' => $tugas['id_pegawai'] ?? null,
                'id_peran' => $tugas['dperan'] ?? null,
                'tanggalAwalPemeriksaan' => $tugas['tanggalAwalPemeriksaan'] ?? null,
                'tanggalAkhirPemeriksaan' => $tugas['tanggalAkhirPemeriksaan'] ?? null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        foreach ($anggotaArr as $anggota) {
            DB::table('surat_tugas')->insert([
                'id_penugasan' => $penugasanId,
                'id_pegawai' => $anggota['id_pegawai'] ?? null,
                'id_peran' => $anggota['dperan'] ?? null,
                'tanggalAwalPemeriksaan' => $anggota['tanggalAwalPemeriksaan'] ?? null,
                'tanggalAkhirPemeriksaan' => $anggota['tanggalAkhirPemeriksaan'] ?? null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        return [
            'status' => true,
            'message' => 'Data berhasil disimpan.'
        ];

    }

    public function editPenugasan(Request $request, $id)
    {
        $penugasan = DB::table('v_demo3')->where('id', $id)->first();
        $penugasan->detail_petugas = json_decode($penugasan->detail_petugas);
        foreach ($penugasan->detail_petugas as $v) {
            $v->namapegawai = $this->formatNamaDenganGelar($v->namapegawai);
        }
        return response()->json([
            'status' => true,
            'message' => 'Data  ditemukan',
            'data' => $penugasan
        ]);
    }

    public function buktiPenugasan(Request $request, $id)
    {

        $penugasan = DB::table('v_demo7')->where('id', $id)->first();
        $penugasan->detail_petugas = json_decode($penugasan->detail_petugas);

        // --- PREPARE DATA PEGAWAI FOR MAPPING ---
        $suratTugasDb = DB::table('surat_tugas')
            ->join('pegawais', 'surat_tugas.id_pegawai', '=', 'pegawais.id')
            ->where('surat_tugas.id_penugasan', $id)
            ->select('surat_tugas.id_pegawai', 'pegawais.nama_pegawai')
            ->get();

        $pegawaiMap = [];
        foreach ($suratTugasDb as $st) {
            $pegawaiMap[$st->nama_pegawai] = $st->id_pegawai;
        }

        $total = 0;
        foreach ($penugasan->detail_petugas as $v => $item) {
            // FIX: Inject id_pegawai based on name matching
            if (isset($pegawaiMap[$item->namapegawai])) {
                $item->id_pegawai = $pegawaiMap[$item->namapegawai];
            } else {
                // Try loose matching if needed, or leave empty
                // Maybe uppercase?
                // The View usually returns exact name from DB.
            }

            // FIX: Recalculate Hari correctly (Inclusive)
            if ($item->tanggalPemeriksaanAwal && $item->tanggalPemeriksaanAkhir) {
                $startD = Carbon::parse($item->tanggalPemeriksaanAwal);
                $endD = Carbon::parse($item->tanggalPemeriksaanAkhir);
                // Reset Hari to correct inclusive duration
                $item->Hari = $startD->diffInDays($endD) + 1;
            }

            try {
                // $totalDayWeekend = $this->hitungSabtuMinggu($item->tanggalPemeriksaanAwal, $item->tanggalPemeriksaanAkhir) - 1;
                $totalDayWeekend = $this->hitungSabtuMinggu($item->tanggalPemeriksaanAwal, $item->tanggalPemeriksaanAkhir);
            } catch (\Throwable $e) {
                $totalDayWeekend = 0;
            }




            // --- LOGIC PENENTUAN HARI EFEKTIF (DAY-BY-DAY) ---
            $finalHari = 0;

            if ($item->tanggalPemeriksaanAwal && $item->tanggalPemeriksaanAkhir && !empty($item->id_pegawai)) {
                $overlaps = Tabel_kendali::where('id_pegawai', $item->id_pegawai)->get();

                $otherAssignments = DB::table('surat_tugas')
                    ->join('penugasans', 'surat_tugas.id_penugasan', '=', 'penugasans.id')
                    ->where('surat_tugas.id_pegawai', $item->id_pegawai)
                    ->where('surat_tugas.id_penugasan', '!=', $id)
                    ->select('surat_tugas.*', 'penugasans.tanggalAwalPenugasan', 'penugasans.tanggalAkhirPenugasan')
                    ->get();

                $blockingRanges = [];

                // 1. Block from Tabel Kendali
                foreach ($overlaps as $ov) {
                    $blockingRanges[] = [
                        'start' => Carbon::parse($ov->tanggal_awal_pemeriksaan)->startOfDay(),
                        'end' => Carbon::parse($ov->tanggal_akhir_pemeriksaan)->endOfDay()
                    ];
                }

                // 2. Block from Newer Assignments
                foreach ($otherAssignments as $oa) {
                    $start = $oa->tanggalAwalPemeriksaan ? Carbon::parse($oa->tanggalAwalPemeriksaan) : Carbon::parse($oa->tanggalAwalPenugasan);
                    $end = $oa->tanggalAkhirPemeriksaan ? Carbon::parse($oa->tanggalAkhirPemeriksaan) : Carbon::parse($oa->tanggalAkhirPenugasan);

                    if ($oa->id_penugasan > $id) {
                        $blockingRanges[] = [
                            'start' => $start->startOfDay(),
                            'end' => $end->endOfDay()
                        ];
                    }
                }

                // Iterate Current Range
                $period = CarbonPeriod::create($item->tanggalPemeriksaanAwal, $item->tanggalPemeriksaanAkhir);
                foreach ($period as $date) {
                    if ($date->isSaturday() || $date->isSunday()) {
                        continue; // Skip Weekend
                    }

                    $isBlocked = false;
                    foreach ($blockingRanges as $range) {
                        if ($date->betweenIncluded($range['start'], $range['end'])) {
                            $isBlocked = true;
                            break;
                        }
                    }

                    if (!$isBlocked) {
                        $finalHari++;
                    }
                }


                // Override Hari with calculated value
                $item->Hari = $finalHari;

            } elseif ($item->tanggalPemeriksaanAwal && $item->tanggalPemeriksaanAkhir) {

                // Fallback if no id_pegawai
                $startD = Carbon::parse($item->tanggalPemeriksaanAwal);
                $endD = Carbon::parse($item->tanggalPemeriksaanAkhir);
                $days = $startD->diffInDays($endD) + 1;
                $weekend = $this->hitungSabtuMinggu($startD, $endD);
                $item->Hari = max(0, $days - $weekend);
            } else {
                $item->Hari = 0;
            }



            $item->Jumlah = $item->Hari * $item->tarif;
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

    public function suratdinas(Request $request, $id)
    {
        $penugasan = DB::table('v_demo8')->where('id', $id)->first();
        $penugasan->detail_petugas = json_decode($penugasan->detail_petugas);
        $total = 0;
        foreach ($penugasan->detail_petugas as $v => $item) {
            try {
                $totalDayWeekend = $this->hitungSabtuMinggu($item->tanggalPemeriksaanAwal, $item->tanggalPemeriksaanAkhir) - 1;
            } catch (\Throwable $e) {
                $totalDayWeekend = 0;
            }

            $item->Jumlah = ($item->Hari -= $totalDayWeekend) * $item->tarif;
            $item->terbilang = ucfirst($this->terbilang($item->Jumlah));
            $total += $item->Jumlah;
        }
        return response()->json([
            'status' => true,
            'message' => 'Data  ditemukan',
            'data' => $penugasan
        ]);
    }

    private function penyebut($nilai)
    {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = $this->penyebut($nilai - 10) . " belas";
        } else if ($nilai < 100) {
            $temp = $this->penyebut($nilai / 10) . " puluh" . $this->penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . $this->penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $this->penyebut($nilai / 100) . " ratus" . $this->penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . $this->penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $this->penyebut($nilai / 1000) . " ribu" . $this->penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = $this->penyebut($nilai / 1000000) . " juta" . $this->penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = $this->penyebut($nilai / 1000000000) . " milyar" . $this->penyebut(fmod($nilai, 1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = $this->penyebut($nilai / 1000000000000) . " trilyun" . $this->penyebut(fmod($nilai, 1000000000000));
        }
        return $temp;
    }

    private function terbilang($nilai)
    {
        if ($nilai < 0) {
            $hasil = "minus " . trim($this->penyebut($nilai));
        } else {
            $hasil = trim($this->penyebut($nilai));
        }
        return $hasil;
    }

    private function hitungSabtuMinggu($tanggalAwal, $tanggalAkhir)
    {
        $periode = CarbonPeriod::create($tanggalAwal, $tanggalAkhir);

        return collect($periode)->filter(function ($tanggal) {
            return $tanggal->isSaturday() || $tanggal->isSunday();
        })->count();
    }



    public function editBerkas(Request $request, $id)
    {
        $penugasan = DB::table('v_demo5')->where('id', $id)->first();
        $penugasan->detail_petugas = json_decode($penugasan->detail_petugas);
        return response()->json([
            'status' => true,
            'message' => 'Data  ditemukan',
            'data' => $penugasan
        ]);
    }

    private function formatNamaDenganGelar($input, $preserveGelar = true)
    {
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

    public function arsip(Request $request)
    {
        $tahun = $request->input('tahun');
        $query = DB::table('v_demo3');

        if ($tahun) {
            $query->where('tanggalTerbitPenugasan', 'like', '%' . $tahun . '%');
        }

        $penugasan = $query->orderBy('tanggalAwalPenugasan', 'DESC')->orderBy('noSurat', 'DESC')->get();
        return response()->json([
            'status' => true,
            'message' => 'data di temukan',
            'data' => $penugasan
        ], 200);
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
            'status' => true,
            'message' => 'data ditemukan',
            'data' => $penugasan
        ], 200);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        // $validated=$request;
        // Validasi input
        $validated = $request->validate([
            'noSurat' => 'required|string|max:255',
            'id_jenis_pengawasan' => 'required|integer',
            'id_obrik' => 'required|integer',
            'Tanggalsurat' => 'required|date',
            'TanggalAkhir' => 'required|date|after_or_equal:Tanggalsurat',
            'tanggalterbitSurat' => 'required|date',
            'id_anggaran' => 'required|integer',
            'tugas' => 'nullable|array',
            'anggota' => 'nullable|array',
            'ubahtugas' => 'nullable|array',
            'ubahanggota' => 'nullable|array',
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
                    'status' => 'error',
                    'message' => 'Data penugasan tidak ditemukan'
                ], 404);
            }

            // Update penugasan
            DB::table('penugasans')->where('id', $id)->update([
                'noSurat' => $validated['noSurat'],
                'id_jenisPengawasan' => $validated['id_jenis_pengawasan'],
                'id_obrik' => $validated['id_obrik'],
                'tanggalTerbitPenugasan' => $validated['tanggalterbitSurat'],
                'id_anggaran' => $validated['id_anggaran'],
                'tanggalAwalPenugasan' => $validated['Tanggalsurat'],
                'tanggalAkhirPenugasan' => $validated['TanggalAkhir'],
                'updated_at' => now(),
            ]);

            // Update surat tugas yang ada
            if (!empty($validated['ubahtugas'])) {
                foreach ($validated['ubahtugas'] as $idSuratTugas => $tugasData) {
                    DB::table('surat_tugas')->where('id', $idSuratTugas)->update([
                        'id_pegawai' => $tugasData['id_pegawai'] ?? null,
                        'id_peran' => $tugasData['id_peran'] ?? null,
                        'tanggalAwalPemeriksaan' => $tugasData['tanggalAwalPemeriksaan'] ?? null,
                        'tanggalAkhirPemeriksaan' => $tugasData['tanggalAkhirPemeriksaan'] ?? null,
                        'updated_at' => now(),
                    ]);
                }
            }

            if (!empty($validated['ubahanggota'])) {
                foreach ($validated['ubahanggota'] as $idSuratTugas => $anggotaData) {
                    DB::table('surat_tugas')->where('id', $idSuratTugas)->update([
                        'id_pegawai' => $anggotaData['id_pegawai'] ?? null,
                        'tanggalAwalPemeriksaan' => $anggotaData['tanggalAwalPemeriksaan'] ?? null,
                        'tanggalAkhirPemeriksaan' => $anggotaData['tanggalAkhirPemeriksaan'] ?? null,
                        'updated_at' => now(),
                    ]);
                }
            }

            $plit = DB::table('surat_tugas')->whereNull('id_pegawai')->delete();

            // Insert tugas baru
            if (!empty($validated['tugas'])) {
                foreach ($validated['tugas'] as $peranId => $tugasData) {
                    if (!empty($tugasData['id_pegawai'])) {
                        DB::table('surat_tugas')->insert([
                            'id_penugasan' => $id,
                            'id_pegawai' => $tugasData['id_pegawai'],
                            'id_peran' => $peranId,
                            'tanggalAwalPemeriksaan' => $tugasData['tanggalAwalPemeriksaan'] ?? null,
                            'tanggalAkhirPemeriksaan' => $tugasData['tanggalAkhirPemeriksaan'] ?? null,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }

            // Insert anggota baru
            if (!empty($validated['anggota'][8])) {
                foreach ($validated['anggota'][8] as $anggotaData) {
                    if (!empty($anggotaData['id_pegawai'])) {
                        DB::table('surat_tugas')->insert([
                            'id_penugasan' => $id,
                            'id_pegawai' => $anggotaData['id_pegawai'],
                            'id_peran' => 8,
                            'tanggalAwalPemeriksaan' => $anggotaData['tanggalAwalPemeriksaan'] ?? null,
                            'tanggalAkhirPemeriksaan' => $anggotaData['tanggalAkhirPemeriksaan'] ?? null,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Data penugasan berhasil diperbarui'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }


    public function editPenugasanbaru(Request $request, $id)
    {
        $penugasan = DB::table('penugasans')->join('jenis__pengawasans', 'penugasans.id_jenisPengawasan', '=', 'jenis__pengawasans.id')->join('obriks', 'penugasans.id_obrik', '=', 'obriks.id')
            ->join('kegiatans', 'penugasans.id_anggaran', '=', 'kegiatans.id')
            ->select('penugasans.*', 'jenis__pengawasans.nama_jenispengawasan', 'obriks.nama_obrik', 'kegiatans.kegiatan')->where('penugasans.id', $id)->first();


        return response()->json([
            'status' => true,
            'message' => 'Data  ditemukan',
            'data' => $penugasan
        ]);
    }

    public function checkOverlap(Request $request)
    {
        $id_pegawai = $request->input('id_pegawai');
        $tanggal_awal = $request->input('tanggal_awal'); // Y-m-d
        $tanggal_akhir = $request->input('tanggal_akhir'); // Y-m-d

        if (!$id_pegawai || !$tanggal_awal || !$tanggal_akhir) {
            return response()->json([
                'status' => false,
                'message' => 'Parameter tidak lengkap',
                'data' => []
            ]);
        }

        $startRequest = Carbon::parse($tanggal_awal);
        $endRequest = Carbon::parse($tanggal_akhir);

        $messages = [];

        // 1. Cek Surat Tugas (Penugasan)
        // Cari surat tugas dimana pegawai terlibat DAN tanggalnya beririsan
        // Logic irisan: (StartA <= EndB) and (EndA >= StartB)
        $conflictingSuratTugas = DB::table('surat_tugas')
            ->join('penugasans', 'surat_tugas.id_penugasan', '=', 'penugasans.id')
            ->leftJoin('obriks', 'penugasans.id_obrik', '=', 'obriks.id')
            ->where('surat_tugas.id_pegawai', $id_pegawai)
            ->where(function ($query) use ($startRequest, $endRequest) {
                // Cek irisan dengan range tanggal di surat_tugas (jika ada) ATAU penugasan global
                // Prioritas: surat_tugas dates -> penugasan dates
    
                // Karena struktur DB bisa mix, kita perlu hati-hati.
                // Asumsi paling aman: cek range efektif.
                // Tapi query builder agak ribet untuk conditional column.
                // Simplifikasi: Cek overlap dengan tanggalPenugasan global dulu (karena itu mandatory biasanya)
                // atau tanggalPemeriksaan di surat_tugas.
    
                // Case A: surat_tugas punya tanggal spesifik
                $query->where(function ($q) use ($startRequest, $endRequest) {
                    $q->whereNotNull('surat_tugas.tanggalAwalPemeriksaan')
                        ->where('surat_tugas.tanggalAwalPemeriksaan', '<=', $endRequest->format('Y-m-d'))
                        ->where('surat_tugas.tanggalAkhirPemeriksaan', '>=', $startRequest->format('Y-m-d'));
                })
                    // Case B: surat_tugas NULL, pakai penugasan global
                    ->orWhere(function ($q) use ($startRequest, $endRequest) {
                    $q->whereNull('surat_tugas.tanggalAwalPemeriksaan')
                        ->where('penugasans.tanggalAwalPenugasan', '<=', $endRequest->format('Y-m-d'))
                        ->where('penugasans.tanggalAkhirPenugasan', '>=', $startRequest->format('Y-m-d'));
                });
            })
            ->select('penugasans.noSurat', 'obriks.nama_obrik', 'penugasans.tanggalAwalPenugasan', 'penugasans.tanggalAkhirPenugasan', 'surat_tugas.tanggalAwalPemeriksaan', 'surat_tugas.tanggalAkhirPemeriksaan')
            ->get();

        foreach ($conflictingSuratTugas as $st) {
            $dateStart = $st->tanggalAwalPemeriksaan ?? $st->tanggalAwalPenugasan;
            $dateEnd = $st->tanggalAkhirPemeriksaan ?? $st->tanggalAkhirPenugasan;
            $messages[] = "Penugasan No: {$st->noSurat} ke {$st->nama_obrik} (" . Carbon::parse($dateStart)->format('d M') . " - " . Carbon::parse($dateEnd)->format('d M') . ")";
        }

        // 2. Cek Tabel Kendali
        $conflictingKendali = Tabel_kendali::where('id_pegawai', $id_pegawai)
            ->where('tanggal_awal_pemeriksaan', '<=', $endRequest->format('Y-m-d'))
            ->where('tanggal_akhir_pemeriksaan', '>=', $startRequest->format('Y-m-d'))
            ->get();

        foreach ($conflictingKendali as $tk) {
            $messages[] = "Tabel Kendali (" . Carbon::parse($tk->tanggal_awal_pemeriksaan)->format('d M') . " - " . Carbon::parse($tk->tanggal_akhir_pemeriksaan)->format('d M') . ")";
        }

        if (count($messages) > 0) {
            return response()->json([
                'status' => true, // Found overlap
                'message' => 'Terdapat penugasan lain pada jadwal ini',
                'data' => $messages
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Tidak ada overlap',
            'data' => []
        ]);
    }

}
