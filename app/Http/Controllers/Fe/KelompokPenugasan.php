<?php

namespace App\Http\Controllers\Fe;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KelompokPenugasan extends Controller
{
    public function index()
    {
        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:8000/api/k_penugasan?token=".$token;
        $response     = $client->request('GET',$url);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data         = $contentArray['data'];
        return view('admin.k_penugasan',['data'=>$data]);
    }
    public function create()
    {
        return view('admin.k_penugasan_create');
    }

    public function store(Request $request)
    {
        $kelompokPenugasan = $request->kelompokPenugasan;

        $parameter = [
            'kelompokPenugasan'   => $kelompokPenugasan,
        ];

        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:8000/api/k_penugasan?token=".$token;
        $response     = $client->request('POST',$url, [
            'headers' => ['Content-type' => 'application/json'],
            'body'    => json_encode($parameter)
        ]);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('k_penugasan')->withErrors($error)->withInput();
        }else {
            return redirect()->to('k_penugasan')->with("success", "Berhasil Memasukkan Data");
        }
    }

    public function edit ($id)
    {
        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:8000/api/k_penugasan/$id?token=".$token;
        $response     = $client->request('GET',$url);

        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status']!=true) {
            # code...
            $error = $contentArray['message'];
            return redirect()->to('k_penugasan')->withErrors($error);
        }else{
            $data = $contentArray['data'];
            return view('admin.k_penugasan_edit',['data' => $data]);
        }
    }

    public function update(Request $request,$id)
    {
        $kelompokPenugasan = $request->kelompokPenugasan;

        $parameter = [
            'kelompokPenugasan'   => $kelompokPenugasan
        ];

        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:8000/api/k_penugasan/$id?token=".$token;
        $response     = $client->request('PUT',$url, [
            'headers' => ['Content-type' => 'application/json'],
            'body'    => json_encode($parameter)
        ]);

        $response     = $client->request('GET',$url);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('k_penugasan')->withErrors($error)->withInput();
        }else {
            return redirect()->to('k_penugasan')->with("success", "Berhasil Update Data");
        }
    }

    public function destroy($id)
    {
        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:8000/api/k_penugasan/$id?token=".$token;
        $response     = $client->request('DELETE',$url);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('k_penugasan')->withErrors($error)->withInput();
        }else {
            return redirect()->to('k_penugasan')->with("success", "Berhasil Hapus Data");
        }
    }
}
