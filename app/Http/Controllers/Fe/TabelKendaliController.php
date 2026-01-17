<?php

namespace App\Http\Controllers\Fe;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class TabelKendaliController extends Controller
{
    public function index()
    {
        $client = new Client();
        $token = session('ctoken');
        $tahun = session('sdata');
        $url = "http://127.0.0.1:9000/api/tabelkendali?token=" . $token . "&tahun=" . $tahun;
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        return view('admin.tabel_kendali', ['data' => $data]);

    }
    public function create()
    {
        $token = session('ctoken');
        $tabelkendali = Http::get("http://127.0.0.1:9000/api/pegawai", ['token' => $token, 'N' => 'alldata'])['data'];
        return view('admin.tabel_kendaliCreate', ['tabelkendali' => $tabelkendali]);
    }

    public function store(Request $request)
    {
        $id_pegawai = $request->id_pegawai;
        $tanggal_awal_pemeriksaan = $request->tanggal_awal_pemeriksaan;
        $tanggal_akhir_pemeriksaan = $request->tanggal_akhir_pemeriksaan;

        $parameter = [
            'id_pegawai' => $id_pegawai,
            'tanggal_awal_pemeriksaan' => $tanggal_awal_pemeriksaan,
            'tanggal_akhir_pemeriksaan' => $tanggal_akhir_pemeriksaan,
        ];

        $client = new Client();
        $token = session('ctoken');
        $url = "http://127.0.0.1:9000/api/tabelkendali?token=" . $token;
        $response = $client->request('POST', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($parameter)
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('tabel_kendali')->withErrors($error)->withInput();
        } else {
            return redirect()->to('tabel_kendali')->with("success", "Berhasil Memasukkan Data");
        }
    }

    public function destroy($id)
    {
        $client = new Client();
        $token = session('ctoken');
        $url = "http://127.0.0.1:9000/api/tabelkendali/$id?token=" . $token;
        $response = $client->request('DELETE', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('tabel_kendali')->withErrors($error)->withInput();
        } else {
            return redirect()->to('tabel_kendali')->with("success", "Berhasil Hapus Data");
        }
    }
}
