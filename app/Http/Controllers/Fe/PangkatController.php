<?php

namespace App\Http\Controllers\Fe;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class PangkatController extends Controller
{
    //
        public function index()
    {
        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:8000/api/pangkat?token=".$token;
        $response     = $client->request('GET',$url);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data         = $contentArray['data'];
        return view('admin.pangkat',['data'=>$data]);
    }

    public function create()
    {
        return view('admin.pangkat_create');
    }
    public function store(Request $request)
    {

        $nama_pangkat = $request->nama_pangkat;

        $parameter = [
            'nama_pangkat'   => $nama_pangkat,
        ];

        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:8000/api/pangkat?token=".$token;
        $response     = $client->request('POST',$url, [
            'headers' => ['Content-type' => 'application/json'],
            'body'    => json_encode($parameter)
        ]);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('pangkat')->withErrors($error)->withInput();
        }else {
            return redirect()->to('pangkat')->with("success", "Berhasil Memasukkan Data");
        }
    }

    public function edit ($id)
    {
        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:8000/api/pangkat/$id?token=".$token;
        $response     = $client->request('GET',$url);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status']!=true) {
            # code...
            $error = $contentArray['message'];
            return redirect()->to('pangkat')->withErrors($error);
        }else{
            $data = $contentArray['data'];
            $pangkat = Http::get("http://127.0.0.1:8000/api/pangkat", ['token' => $token])['data'];
        // $pegawai = Pegawai::all();
        return view('admin.pangkat_edit', ['data'=>$data,'pangkat'=>$pangkat]);
        }
    }

    public function update(Request $request,$id)
    {
        $nama_pangkat = $request->nama_pangkat;

        $parameter = [
            'nama_pangkat'   => $nama_pangkat,
        ];

        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:8000/api/pangkat/$id?token=".$token;
        $response     = $client->request('PUT',$url, [
            'headers' => ['Content-type' => 'application/json'],
            'body'    => json_encode($parameter)
        ]);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('pangkat')->withErrors($error)->withInput();
        }else {
            return redirect()->to('pangkat')->with("success", "Berhasil Update Data");
        }
    }

    public function destroy($id)
    {
        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:8000/api/pangkat/$id?token=".$token;
        $response     = $client->request('DELETE',$url);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('pangkat')->withErrors($error)->withInput();
        }else {
            return redirect()->to('pangkat')->with("success", "Berhasil Hapus Data");
        }
    }

}
