<?php

namespace App\Http\Controllers\Fe;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class KegiatanController extends Controller
{
    //
    public function index()
    {

        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:9000/api/kegiatan?token=".$token;
        $response     = $client->request('GET',$url);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data         = $contentArray['data'];
        return view('admin.kegiatan',['data'=>$data]);
    }
        public function create()
    {
        $token    = session('ctoken');
        $pegawai     = Http::get("http://127.0.0.1:9000/api/pegawai", ['token' => $token, 'N' => 'alldata'])['data'];
        return view('admin.kegiatan_create',['pegawai'=>$pegawai]);
    }

    public function store(Request $request)
    {
        $norek = $request->norek;
        $kegiatan = $request->kegiatan;
        $id_pptk = $request->id_pptk;

        $parameter = [
            'norek'   => $norek,
            'kegiatan'   => $kegiatan,
            'id_pptk'   => $id_pptk,
        ];

        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:9000/api/kegiatan?token=".$token;
        $response     = $client->request('POST',$url, [
            'headers' => ['Content-type' => 'application/json'],
            'body'    => json_encode($parameter)
        ]);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('kegiatan')->withErrors($error)->withInput();
        }else {
            return redirect()->to('kegiatan')->with("success", "Berhasil Memasukkan Data");
        }
    }

    public function edit($id)
    {

        $token    = session('ctoken');
        $kegiatan = Http::get("http://127.0.0.1:9000/api/kegiatan-edit/$id", ['token' => $token])['data'];
        $pegawai  = Http::get("http://127.0.0.1:9000/api/pegawai", ['token' => $token, 'N' => 'alldata'])['data'];
        return view('admin.kegiatan_edit', ['pegawai'=>$pegawai,'kegiatan'=>$kegiatan]);

    }

    public function update(Request $request,$id)
     {
        $norek           = $request->norek;
        $kegiatan        = $request->kegiatan;
        $id_pptk         = $request->id_pptk;

        $parameter = [
            'norek'      => $norek,
            'kegiatan'   => $kegiatan,
            'id_pptk'    => $id_pptk,
        ];

        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:9000/api/kegiatan/$id?token=".$token;
        $response     = $client->request('PUT',$url, [
            'headers' => ['Content-type' => 'application/json'],
            'body'    => json_encode($parameter)
        ]);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('kegiatan')->withErrors($error)->withInput();
        }else {
            return redirect()->to('kegiatan')->with("success", "Berhasil Update Data");
        }
     }
}
