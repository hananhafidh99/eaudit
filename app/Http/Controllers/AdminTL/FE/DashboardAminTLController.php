<?php

namespace App\Http\Controllers\AdminTL\FE;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DashboardAminTLController extends Controller
{
    public function index()
    {
        return view('adminTL.index');
    }


    public function pkpt(Request $request)
    {
        $client = new Client();
        $token = session('ctoken');
        $url = "http://127.0.0.1:8000/api/penugasanArsip?token=" . $token;
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        $data['data'] = $data;

        $url2 = "http://127.0.0.1:8000/api/pengawasan?token=" . $token;
        $response = $client->request('GET', $url2);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data2 = $contentArray['data'];

        $datanew = $data2;


        return view('adminTL.pkpt', ['data' => $data, 'datanew' => $datanew]);
    }

    public function pkptedit($id)
    {
        $token = session('ctoken');
        $pengawasan = Http::get("http://127.0.0.1:8000/api/pengawasan-edit/$id", ['token' => $token])['data'];
        return view('adminTL.pkpt_edit', compact('pengawasan'));
    }

    public function arsipCari(Request $request)
    {
        $params = $request->except(['_token', '_method']);
        $filteredParams = array_filter($params, function ($value) {
            return !is_null($value) && $value !== '';
        });

        // dd($filteredParams);

        // Query langsung ke database sesuai pola arsipobrik
        $query = DB::table('v_demo3');

        // Filter bulan jika ada
        if ($request->has('tanggalAwalPenugasan') && !empty($request->tanggalAwalPenugasan)) {
            $query->whereRaw('MONTH(tanggalAwalPenugasan) = ?', [$request->tanggalAwalPenugasan]);
        }

        // Filter Tahun jika ada
        if ($request->has('tanggalAwalPenugasan_tahun') && !empty($request->tanggalAwalPenugasan_tahun)) {
            $query->whereRaw('YEAR(tanggalAwalPenugasan) = ?', [$request->tanggalAwalPenugasan_tahun]);
        }

        // Filter lain
        foreach ($filteredParams as $key => $value) {
            if (($key !== 'tanggalAwalPenugasan') && ($key !== 'tanggalAwalPenugasan_tahun')) {
                $query->where($key, 'LIKE', '%' . $value . '%');
            }
        }

        $penugasan = $query->orderBy('tanggalAwalPenugasan', 'DESC')
            ->orderBy('noSurat', 'DESC')
            ->get()->toArray();

        foreach ($penugasan as $key => $st) {
            # code...
            $st->detail_petugas = json_decode($st->detail_petugas);
        }
        $penugasan['data'] = $penugasan;


        // Kirim data ke view
        // return view('admin.arsip_cari', ['data' =>$penugasan]);
        return response()->json(['data' => $penugasan]);
    }

    public function pkptcreate($id)
    {
        $token = session('ctoken');
        $penugasan = Http::get("http://127.0.0.1:8000/api/penugasan-edit/$id", ['token' => $token])['data'];
        return view('adminTL.pkpt_create', compact('penugasan'));
    }

    public function pkptstore(Request $request, $id)
    {
        $parameter = [
            'id_penugasan' => $request->id_penugasan,
            'tglkeluar' => $request->tglkeluar,
            'tipe' => $request->tipe,
            'jenis' => $request->jenis,
            'wilayah' => $request->wilayah,
            'pemeriksa' => $request->pemeriksa,
            'status_LHP' => 'Belum Jadi'
        ];

        $client = new Client();
        $token = session('ctoken');
        $url = "http://127.0.0.1:8000/api/pengawasan?token=" . $token;
        $response = $client->request('POST', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($parameter)
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('adminTL/pkpt')->withErrors($error)->withInput();
        } else {
            return redirect()->to('adminTL/pkpt')->with("success", "Berhasil Memasukkan Data");
        }


    }

    public function pkptupdate(Request $request, $id)
    {
        $parameter = [
            'tglkeluar' => $request->tglkeluar,
            'tipe' => $request->tipe,
            'jenis' => $request->jenis,
            'wilayah' => $request->wilayah,
            'pemeriksa' => $request->pemeriksa,
        ];

        $client = new Client();
        $token = session('ctoken');
        $url = "http://127.0.0.1:8000/api/pengawasan/$id?token=" . $token;
        $response = $client->request('PUT', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($parameter)
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('adminTL/pkpt')->withErrors($error)->withInput();
        } else {
            return redirect()->to('adminTL/pkpt')->with("success", "Berhasil Update Data");
        }
    }


    public function rekom()
    {
        $client = new Client();
        $token = session('ctoken');
        $url = "http://127.0.0.1:8000/api/rekom?token=" . $token;
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        $data['data'] = $data;

        return view('AdminTL.rekom', ['data' => $data]);
    }

    public function rekomEdit($id)
    {
        $token = session('ctoken');
        $pengawasan = Http::get("http://127.0.0.1:8000/api/pengawasan-edit/$id", ['token' => $token])['data'];

        try {
            $getparent = DB::table('jenis_temuans')
                ->where('id_parent', DB::raw('id'))
                ->where('id_pengawasan', $id)
                ->get();

            foreach ($getparent as $key => $value) {
                $value->sub = DB::table('jenis_temuans')
                    ->where('id_parent', $value->id)
                    ->where('id', '!=', $value->id)
                    ->get();

                foreach ($value->sub as $subKey => $subValue) {
                    $subValue->sub = DB::table('jenis_temuans')
                        ->where('id_parent', $subValue->id)
                        ->where('id', '!=', $subValue->id)
                        ->get();
                }
            }
            return view('AdminTL.rekom_edit', ['pengawasan' => $pengawasan, 'data' => $getparent]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        return view('AdminTL.rekom_edit', ['pengawasan' => $pengawasan]);
    }

    public function rekomStore(Request $request)
    {

        $token = session('ctoken');

        $response = Http::post(
                // ('http://localhost:8000').('/api/rekom/store') . '?token=' . $token,
            ('http://localhost:8000') . ('/api/rekom/store') . '?token=' . $token,
            $request->all()
        );
        // dd($response->json());
        // try{
        //     DB::table('jenis_temuans')->where('id_pengawasan', $request->id_pengawasan)->delete();
        // }catch(\Exception $e){

        // }
        // $tipeAData = $request->input('tipeA')?$request->input('tipeA'):$request->input('ubahTipeA');
        // foreach ($tipeAData as $item) {
        //      $id_parent = DB::table('jenis_temuans')->insertGetId([
        //         'rekomendasi' => $item['rekomendasi'],
        //         'keterangan' => $item['keterangan'],
        //         'id_pengawasan' => $request->id_pengawasan,
        //         'id_penugasan' => $request->id_penugasan,
        //         'pengembalian' => str_replace('.', '', $item['pengembalian']),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);

        //     DB::table('jenis_temuans')
        //         ->where('id', $id_parent)
        //         ->update(['id_parent' => $id_parent]);

        //     if (isset($item['sub']) && is_array($item['sub'])) {
        //         foreach ($item['sub'] as $subItem) {
        //             $id_child = DB::table('jenis_temuans')->insertGetId([
        //                 'id_parent' => $id_parent,
        //                 'rekomendasi' => $subItem['rekomendasi'],
        //                 'keterangan' => $subItem['keterangan'],
        //                 'id_pengawasan' => $request->id_pengawasan,
        //                 'id_penugasan' => $request->id_penugasan,
        //                 'pengembalian' => str_replace('.', '', $subItem['pengembalian']),
        //                 'created_at' => now(),
        //                 'updated_at' => now(),
        //             ]);

        //             if (isset($subItem['sub']) && is_array($subItem['sub'])) {
        //                 foreach ($subItem['sub'] as $nestedSubItem) {
        //                     DB::table('jenis_temuans')->insert([
        //                         'id_parent' => $id_child,
        //                         'rekomendasi' => $nestedSubItem['rekomendasi'],
        //                         'keterangan' => $nestedSubItem['keterangan'],
        //                         'id_pengawasan' => $request->id_pengawasan,
        //                         'id_penugasan' => $request->id_penugasan,
        //                         'pengembalian' => str_replace('.', '', $nestedSubItem['pengembalian']),
        //                         'created_at' => now(),
        //                         'updated_at' => now(),
        //                     ]);
        //                 }
        //             }
        //         }
        //     }

        //     // return response()->json(['message' => 'Data berhasil disimpan.']);
        // }
        return back()->with('success', 'Data berhasil disimpan!');

    }

    public function temurekom()
    {
        $client = new Client();
        $token = session('ctoken');
        $url = "http://127.0.0.1:8000/api/temuan?token=" . $token;
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        $data['data'] = $data;

        return view('AdminTL.temuan_rekom', ['data' => $data]);
    }

    public function temuanStore(Request $request)
    {
        // Validate request
        $request->validate([
            'id_pengawasan' => 'required',
            'id_penugasan' => 'required',
            'temuan' => 'required|array|min:1',
            'temuan.*.kode_temuan' => 'required|string|max:255',
            'temuan.*.nama_temuan' => 'required|string|max:255',
            'temuan.*.rekomendasi' => 'required|array|min:1',
            'temuan.*.rekomendasi.*.rekomendasi' => 'required|string',
        ], [
            'temuan.required' => 'Data temuan harus diisi',
            'temuan.*.kode_temuan.required' => 'Kode temuan harus diisi',
            'temuan.*.nama_temuan.required' => 'Nama temuan harus diisi',
            'temuan.*.rekomendasi.required' => 'Rekomendasi harus diisi',
            'temuan.*.rekomendasi.*.rekomendasi.required' => 'Isi rekomendasi harus diisi',
        ]);

        $data = $request->all();

        // Debug: Log request data (only in development)
        if (config('app.debug')) {
            Log::info('Temuan Store Request Data:', $data);
        }

        try {
            $savedCount = 0;

            foreach ($data['temuan'] as $temuanIndex => $temuan) {
                // Skip completely empty temuan entries
                if (empty(trim($temuan['nama_temuan'] ?? '')) && empty(trim($temuan['kode_temuan'] ?? ''))) {
                    continue;
                }

                // Check if temuan has recommendations
                if (!isset($temuan['rekomendasi']) || !is_array($temuan['rekomendasi'])) {
                    return redirect()->back()->with('error', "Temuan ke-" . ($temuanIndex + 1) . ": Harus memiliki minimal satu rekomendasi!");
                }

                $hasValidRekomendasi = false;

                foreach ($temuan['rekomendasi'] as $rekomIndex => $rekom) {
                    // Skip empty recommendations
                    if (empty(trim($rekom['rekomendasi'] ?? ''))) {
                        continue;
                    }

                    $hasValidRekomendasi = true;

                    // Clean and validate pengembalian value
                    $pengembalian = 0;
                    if (!empty($rekom['pengembalian'])) {
                        // Remove currency formatting: Rp. 1.000.000 -> 1000000
                        $cleanNumber = preg_replace('/[^0-9,.]/', '', $rekom['pengembalian']);
                        $cleanNumber = str_replace(['.', ','], ['', '.'], $cleanNumber);
                        $pengembalian = floatval($cleanNumber);
                    }

                    // Insert data to database
                    DB::table('jenis_temuans')->insert([
                        'id_parent' => null,
                        'id_penugasan' => $data['id_penugasan'],
                        'id_pengawasan' => $data['id_pengawasan'],
                        'nama_temuan' => trim($temuan['nama_temuan']),
                        'kode_temuan' => trim($temuan['kode_temuan']),
                        'rekomendasi' => trim($rekom['rekomendasi']),
                        'pengembalian' => $pengembalian,
                        'keterangan' => trim($rekom['keterangan'] ?? ''),
                        'kode_rekomendasi' => null,
                        'Rawdata' => json_encode($data),
                        'password' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $savedCount++;
                }

                // Validate that temuan has at least one valid rekomendasi
                if (!$hasValidRekomendasi) {
                    return redirect()->back()->with('error', "Temuan ke-" . ($temuanIndex + 1) . ": Harus memiliki minimal satu rekomendasi yang diisi!");
                }
            }

            if ($savedCount === 0) {
                return redirect()->back()->with('error', 'Tidak ada data yang disimpan. Pastikan semua field terisi dengan benar!');
            }

            return redirect()->back()->with('success', "Data temuan berhasil disimpan! ($savedCount rekomendasi tersimpan)");

        } catch (\Exception $e) {
            Log::error('Temuan Store Error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $data ?? null
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function temuanrekomEdit($id)
    {
        $token = session('ctoken');
        $pengawasan = Http::get("http://127.0.0.1:8000/api/pengawasan-edit/$id", ['token' => $token])['data'];

        return view('AdminTL.temuan_rekom_edit', ['pengawasan' => $pengawasan]);
    }

    public function indexdatadukungrekom()
    {
        $client = new Client();
        $token = session('ctoken');
        $url = "http://127.0.0.1:8000/api/rekom?token=" . $token;
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        $data['data'] = $data;
        return view('AdminTL.datadukungrekom', ['data' => $data]);
    }

    public function datadukungrekom($id)
    {
        $token = session('ctoken');
        $pengawasan = Http::get("http://127.0.0.1:8000/api/pengawasan-edit/$id", ['token' => $token])['data'];

        try {
            $getparent = DB::table('jenis_temuans')
                ->where('id_parent', DB::raw('id'))
                ->where('id_pengawasan', $id)
                ->get();

            foreach ($getparent as $key => $value) {
                $value->sub = DB::table('jenis_temuans')
                    ->where('id_parent', $value->id)
                    ->where('id', '!=', $value->id)
                    ->get();

                foreach ($value->sub as $subKey => $subValue) {
                    $subValue->sub = DB::table('jenis_temuans')
                        ->where('id_parent', $subValue->id)
                        ->where('id', '!=', $subValue->id)
                        ->get();
                }
            }
            return view('AdminTL.datadukungrekom_upload', ['pengawasan' => $pengawasan, 'data' => $getparent]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        return view('AdminTL.datadukungrekom_upload', ['pengawasan' => $pengawasan]);
    }

}
