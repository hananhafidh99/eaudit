<?php

namespace App\Http\Controllers\Fe;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class SuratController extends Controller
{
    const API_URL = "http://127.0.0.1:9000/api/penugasan";

    public function index(Request $request)
    {
        $current_url = url()->current();
        $client = new Client();
        $url = static::API_URL;
        $token = session('ctoken');
        $tahun = session('sdata');

        $params = [
            'token' => $token,
            'tahun' => $tahun,
        ];

        if ($request->input('page') != '') {
            $params['page'] = $request->input('page');
        }

        $url .= '?' . http_build_query($params);
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        foreach ($data['links'] as $key => $value) {
            # code...
            $data['links'][$key]['url2'] = str_replace(static::API_URL, $current_url, $value['url']);
        }
        return view('admin.surat_dalamkota', ['data' => $data]);
    }

    public function create()
    {
        $token = session('ctoken');
        $data = Http::get("http://127.0.0.1:9000/api/kegiatan", ['token' => $token])['data'];
        $pegawai = Http::get("http://127.0.0.1:9000/api/pegawai", ['token' => $token, 'N' => 'alldata'])['data'];
        $peran = Http::get("http://127.0.0.1:9000/api/peran", ['token' => $token])['data'];
        $jenisPengawasan = Http::get("http://127.0.0.1:9000/api/jenisPengawasan", ['token' => $token])['data'];
        $obrik = Http::get("http://127.0.0.1:9000/api/obrik", ['token' => $token])['data'];
        $kelompokPenugasan = Http::get("http://127.0.0.1:9000/api/k_penugasan", ['token' => $token])['data'];
        return view('admin.surat_dalamkota_create', ['data' => $data, 'kelompokPenugasan' => $kelompokPenugasan, 'jenisPengawasan' => $jenisPengawasan, 'obrik' => $obrik, 'peran' => $peran, 'pegawai' => $pegawai]);
    }

    public function store(Request $request)
    {
        $noSurat = $request->noSurat;
        $id_jenisPengawasan = $request->id_jenisPengawasan;
        $id_kelompokPenugasan = $request->id_kelompokPenugasan;
        $id_obrik = $request->id_obrik;
        $tanggalAwalPenugasan = $request->tanggalAwalPenugasan;
        $id_anggaran = $request->id_anggaran;
        $tanggalAkhirPenugasan = $request->tanggalAkhirPenugasan;
        $tanggalTerbitPenugasan = $request->tanggalTerbitPenugasan;
        $tugas = $request->tugas;
        $anggota = $request->anggota;

        $penugasan = [
            'noSurat' => $noSurat,
            'id_jenisPengawasan' => $id_jenisPengawasan,
            'id_kelompokPenugasan' => $id_kelompokPenugasan,
            'id_obrik' => $id_obrik,
            'tanggalTerbitPenugasan' => $tanggalTerbitPenugasan,
            'id_anggaran' => $id_anggaran,
            'tanggalAwalPenugasan' => $tanggalAwalPenugasan,
            'tanggalAkhirPenugasan' => $tanggalAkhirPenugasan,
        ];
        if (is_array($tugas)) {
            $tugas = array_filter($tugas, function ($item) {
                return isset($item['id_pegawai']) && $item['id_pegawai'] !== null;
            });
        }

        if (is_array($anggota)) {
            $anggota = array_filter($anggota[8], function ($item) {
                return isset($item['id_pegawai']) && $item['id_pegawai'] !== null;
            });
        }



        $surattugas = [
            'tugas' => $tugas,
            'anggota' => $anggota,
        ];


        $parameter = [
            'penugasan' => json_encode($penugasan),
            'surattugas' => json_encode($surattugas)
        ];

        $token = session('ctoken');
        $url = "http://127.0.0.1:9000/api/penugasan/store?token=" . $token;
        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post($url, $parameter);
        $contentArray = $response->json();
        if (isset($contentArray['status']) && $contentArray['status'] != true) {
            $error = $contentArray['data'] ?? 'Terjadi kesalahan.';
            return redirect()->to('surat_dalamKota')->withErrors($error)->withInput();
        } else {
            return redirect()->to('surat_dalamKota')->with('success', 'Berhasil Memasukkan Data');
        }
    }

    public function getPenugasanDetail($id)
    {
        $penugasan = DB::table('penugasans')->where('id', $id)->first();

        $suratTugas = DB::table('surat_tugas')
            ->where('id_penugasan', $id)
            ->join('pegawais', 'surat_tugas.id_pegawai', '=', 'pegawais.id')
            ->join('perans', 'surat_tugas.id_peran', '=', 'perans.id')
            ->select(
                'surat_tugas.*',
                'pegawais.nama_pegawai',
                'perans.nama_peran'
            )
            ->get();

        $tugas = $suratTugas->filter(function($item) {
            return $item->nama_peran != 'Anggota';
        })->values();
        $anggota = $suratTugas->filter(function($item) {
            return $item->nama_peran == 'Anggota';
        })->values();

        $resetindex = [];
        foreach ($tugas as $key => $value) {
            $resetindex[$value->id_peran] = $value;
        }
        $tugas = $resetindex;

        return [
            'penugasan' => $penugasan,
            'surattugas' => [
                'tugas' => $tugas,
                'anggota' => $anggota,
            ]
        ];
    }

    public function edit(Request $request, $id)
    {

        $datatersimpan = $this->getPenugasanDetail($id);
        $token = session('ctoken');
        $penugasanedit = Http::get("http://127.0.0.1:9000/api/penugasan-editbaru/$id", ['token' => $token])['data'];
        $jenisPengawasan = Http::get("http://127.0.0.1:9000/api/jenisPengawasan", ['token' => $token])['data'];
        $obrik = Http::get("http://127.0.0.1:9000/api/obrik", ['token' => $token])['data'];
        $kegiatan = Http::get("http://127.0.0.1:9000/api/kegiatan", ['token' => $token])['data'];
        $peran = Http::get("http://127.0.0.1:9000/api/peran", ['token' => $token])['data'];
        $pegawai = Http::get("http://127.0.0.1:9000/api/pegawai", ['token' => $token, 'N' => 'alldata'])['data'];
        // dump(['penugasanedit'=>$penugasanedit,'jenisPengawasan'=>$jenisPengawasan,'obrik'=>$obrik,'kegiatan'=>$kegiatan, 'peran'=>$peran,'pegawai'=>$pegawai,'suratTugas'=>$datatersimpan['surattugas']]);
        // dd($datatersimpan);
        return view('admin.surat_dalamkota_edit', ['penugasanedit' => $penugasanedit, 'jenisPengawasan' => $jenisPengawasan, 'obrik' => $obrik, 'kegiatan' => $kegiatan, 'peran' => $peran, 'pegawai' => $pegawai, 'suratTugas' => $datatersimpan['surattugas']]);
    }

    public function suratTugas($id)
    {
        $token = session('ctoken');
        $penugasan = Http::get("http://127.0.0.1:9000/api/penugasan-edit/$id", ['token' => $token])['data'];
        $data = Http::get("http://127.0.0.1:9000/api/skpd", ['token' => $token])['data'][0];
        // dd(session('nama_pemimpin'));
        return view('admin.template_surat', ['penugasan' => $penugasan, 'data' => $data]);
    }

    public function buktipenerimaan($id)
    {
        $token = session('ctoken');
        $penugasan = Http::get("http://127.0.0.1:9000/api/penugasan-bukti/$id", ['token' => $token])['data'];
        return view('admin.bukti', ['penugasan' => $penugasan]);
    }

    public function suratDinas($id)
    {
        $token = session('ctoken');
        $penugasan = Http::get("http://127.0.0.1:9000/api/penugasan-suratdinas/$id", ['token' => $token])['data'];
        $data = Http::get("http://127.0.0.1:9000/api/skpd", ['token' => $token])['data'][0];
        return view('admin.suratDinas', ['penugasan' => $penugasan, 'data' => $data]);

    }

    public function sppd($id)
    {
        $token = session('ctoken');
        $penugasan = Http::get("http://127.0.0.1:9000/api/penugasan-edit/$id", ['token' => $token])['data'];
        return view('admin.sppd', ['penugasan' => $penugasan]);

    }

    public function arsip(Request $request)
    {
        $client = new Client();
        $token = session('ctoken');
        $tahun = session('sdata');
        $url = "http://127.0.0.1:9000/api/penugasanArsip?token=" . $token . "&tahun=" . $tahun;
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];

        // // return view('admin.arsip', ['data'=>$data]);

        $data['data'] = $data;

        return view('admin.arsip', ['data' => $data]);

    }

    public function arsipCari(Request $request)
    {
        $params = $request->except(['_token', '_method']);
        $filteredParams = array_filter($params, function ($value) {
            return !is_null($value) && $value !== '';
        });

        // Query langsung ke database sesuai pola arsipobrik
        $query = DB::table('v_demo3');

        // Filter bulan jika ada
        if ($request->has('tanggalAwalPenugasan') && !empty($request->tanggalAwalPenugasan)) {
            $query->whereRaw('MONTH(tanggalAwalPenugasan) = ?', [$request->tanggalAwalPenugasan]);
        }
        // Filter lain
        foreach ($filteredParams as $key => $value) {
            if ($key !== 'tanggalAwalPenugasan') {
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
        return view('admin.arsip_cari', ['data' => $penugasan]);
    }

    public function update(Request $request, $id)
    {
        try {
            $apiUrl = "http://127.0.0.1:9000/api/penugasan_update";
            $payload = $request->all();
            $payload['id'] = $id;

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])->put($apiUrl, $payload);

            if ($response->successful()) {
                return redirect('/surat_dalamKota')->with('success', 'Data berhasil disimpan');
            }
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengupdate data di API',
                'error' => $response->json()
            ], $response->status());
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function checkOverlap(Request $request)
    {
        // Proxy ke API
        $token = session('ctoken');
        $url = "http://127.0.0.1:9000/api/penugasan/check-overlap?token=" . $token;

        $response = Http::post($url, $request->all());

        return $response->json();
    }
}
