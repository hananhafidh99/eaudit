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
    }

    public function rekomStore(Request $request)
    {

        $token = session('ctoken');

        $response = Http::post(
                // ('http://localhost:8000').('/api/rekom/store') . '?token=' . $token,
            ('http://localhost:8000') . ('/api/rekom/store') . '?token=' . $token,
            $request->all()
        );
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

                // Process recommendations recursively (including nested sub-recommendations)
                $savedCount += $this->processRekomendasi(
                    $temuan['rekomendasi'],
                    $data['id_pengawasan'],
                    $data['id_penugasan'],
                    $temuan['nama_temuan'],
                    $temuan['kode_temuan'],
                    null, // parent_id for main recommendations
                    $data
                );
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

    /**
     * Process recommendations recursively to handle nested sub-recommendations
     */
    private function processRekomendasi($rekomendasi, $id_pengawasan, $id_penugasan, $nama_temuan, $kode_temuan, $parent_id = null, $fullData = [])
    {
        $count = 0;

        foreach ($rekomendasi as $rekomIndex => $rekom) {
            // Skip empty recommendations
            if (empty(trim($rekom['rekomendasi'] ?? ''))) {
                continue;
            }

            // Clean and validate pengembalian value
            $pengembalian = 0;
            if (!empty($rekom['pengembalian'])) {
                // Remove currency formatting: Rp. 1.000.000 -> 1000000
                $cleanNumber = preg_replace('/[^0-9,.]/', '', $rekom['pengembalian']);
                $cleanNumber = str_replace(['.', ','], ['', '.'], $cleanNumber);
                $pengembalian = floatval($cleanNumber);
            }

            // Insert main recommendation first
            $rekomId = DB::table('jenis_temuans')->insertGetId([
                'id_parent' => $parent_id, // Will be updated for top-level items
                'id_penugasan' => $id_penugasan,
                'id_pengawasan' => $id_pengawasan,
                'nama_temuan' => $nama_temuan,
                'kode_temuan' => $kode_temuan,
                'rekomendasi' => trim($rekom['rekomendasi']),
                'pengembalian' => $pengembalian,
                'keterangan' => trim($rekom['keterangan'] ?? ''),
                'kode_rekomendasi' => null,
                'Rawdata' => json_encode($fullData),
                'password' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // If this is a top-level recommendation (parent_id is null),
            // update id_parent to point to itself
            if ($parent_id === null) {
                DB::table('jenis_temuans')
                    ->where('id', $rekomId)
                    ->update(['id_parent' => $rekomId]);
            }

            $count++;

            // Process nested sub-recommendations if they exist
            if (isset($rekom['sub']) && is_array($rekom['sub'])) {
                $count += $this->processRekomendasi(
                    $rekom['sub'],
                    $id_pengawasan,
                    $id_penugasan,
                    $nama_temuan,
                    $kode_temuan,
                    $rekomId, // This recommendation becomes parent for sub-recommendations
                    $fullData
                );
            }
        }

        return $count;
    }

    public function temuanrekomEdit(Request $request, $id)
    {
        $token = session('ctoken');
        $pengawasan = Http::get("http://127.0.0.1:8000/api/pengawasan-edit/$id", ['token' => $token])['data'];

        try {
            // Ambil semua data dan kelompokkan berdasarkan kode_temuan dan nama_temuan
            $allData = DB::table('jenis_temuans')
                ->where('id_pengawasan', $id)
                ->orderBy('kode_temuan')
                ->orderBy('id')
                ->get();

            // Kelompokkan berdasarkan kombinasi kode_temuan + nama_temuan
            $groupedData = [];

            foreach ($allData as $item) {
                $key = $item->kode_temuan . '|' . $item->nama_temuan;

                if (!isset($groupedData[$key])) {
                    $groupedData[$key] = [
                        'kode_temuan' => $item->kode_temuan,
                        'nama_temuan' => $item->nama_temuan,
                        'recommendations' => []
                    ];
                }

                // Tambahkan item sebagai rekomendasi
                $groupedData[$key]['recommendations'][] = $item;
            }

            // Convert ke format yang dibutuhkan view dan build hierarchy
            $formattedData = [];
            foreach ($groupedData as $group) {
                $temuan = (object) [
                    'kode_temuan' => $group['kode_temuan'],
                    'nama_temuan' => $group['nama_temuan'],
                    'recommendations' => $this->buildRecommendationHierarchy($group['recommendations'])
                ];
                $formattedData[] = $temuan;
            }

            return view('AdminTL.temuan_rekom_edit', [
                'pengawasan' => $pengawasan,
                'existingData' => collect($formattedData)
            ]);

        } catch (\Exception $e) {
            Log::error('Error loading temuan data:', [
                'error' => $e->getMessage(),
                'id_pengawasan' => $id
            ]);

            return view('AdminTL.temuan_rekom_edit', [
                'pengawasan' => $pengawasan,
                'existingData' => collect([])
            ]);
        }
    }

    /**
     * Build recommendation hierarchy from flat array
     */
    private function buildRecommendationHierarchy($recommendations)
    {
        // Create lookup array
        $lookup = [];
        foreach ($recommendations as $item) {
            $lookup[$item->id] = $item;
            $item->children = [];
        }

        // Build hierarchy
        $roots = [];
        foreach ($recommendations as $item) {
            if ($item->id_parent == $item->id) {
                // This is a root item (self-referencing)
                $roots[] = $item;
            } else {
                // This is a child item
                if (isset($lookup[$item->id_parent])) {
                    $lookup[$item->id_parent]->children[] = $item;
                }
            }
        }

        return $roots;
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

    public function datadukungrekomStore()
    {

    }

    public function datadukungrekomEdit($id)
    {

    }

    /**
     * Update recommendation
     */
    public function updateRekomendasi(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer',
                'rekomendasi' => 'required|string|max:1000',
                'keterangan' => 'nullable|string|max:500',
                'pengembalian' => 'nullable|numeric|min:0'
            ]);

            $updated = DB::table('jenis_temuans')
                ->where('id', $request->id)
                ->update([
                    'rekomendasi' => $request->rekomendasi,
                    'keterangan' => $request->keterangan,
                    'pengembalian' => $request->pengembalian ?: 0,
                    'updated_at' => now()
                ]);

            if ($updated) {
                return response()->json([
                    'success' => true,
                    'message' => 'Rekomendasi berhasil diperbarui'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

        } catch (\Exception $e) {
            Log::error('Error updating rekomendasi:', [
                'error' => $e->getMessage(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete recommendation
     */
    public function deleteRekomendasi($id)
    {
        try {
            Log::info('Delete request received for ID: ' . $id);

            // Validate ID
            if (!is_numeric($id) || $id <= 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'ID tidak valid'
                ], 400);
            }

            // Check if record exists
            $record = DB::table('jenis_temuans')->where('id', $id)->first();
            if (!$record) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            Log::info('Record found for deletion:', ['record' => $record]);

            // Check if this recommendation has children
            $hasChildren = DB::table('jenis_temuans')
                ->where('id_parent', $id)
                ->where('id', '!=', $id)
                ->exists();

            if ($hasChildren) {
                $childrenCount = DB::table('jenis_temuans')
                    ->where('id_parent', $id)
                    ->where('id', '!=', $id)
                    ->count();

                Log::warning('Cannot delete record with children:', ['id' => $id, 'children_count' => $childrenCount]);

                return response()->json([
                    'success' => false,
                    'message' => 'Tidak dapat menghapus rekomendasi yang memiliki ' . $childrenCount . ' sub-rekomendasi. Hapus sub-rekomendasi terlebih dahulu.'
                ], 400);
            }

            // Perform deletion
            $deleted = DB::table('jenis_temuans')
                ->where('id', $id)
                ->delete();

            if ($deleted) {
                Log::info('Record deleted successfully:', ['id' => $id]);
                return response()->json([
                    'success' => true,
                    'message' => 'Rekomendasi berhasil dihapus'
                ]);
            } else {
                Log::error('Delete operation failed for ID: ' . $id);
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus data'
                ], 500);
            }

        } catch (\Exception $e) {
            Log::error('Error deleting rekomendasi:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'id' => $id
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
            ], 500);
        }
    }
}
