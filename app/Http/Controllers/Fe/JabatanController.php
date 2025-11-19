<?php

namespace App\Http\Controllers\Fe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class JabatanController extends Controller
{
    //
        public function index()
    {
        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:8000/api/jabatan?token=".$token;
        $response     = $client->request('GET',$url);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data         = $contentArray['data'];
        return view('admin.jabatan',['data'=>$data]);
    }
    public function create()
    {
        return view('admin.jabatan_create');
    }

    public function store(Request $request)
    {
        $nama_jabatan = $request->nama_jabatan;

        $parameter = [
            'nama_jabatan'   => $nama_jabatan,
        ];

        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:8000/api/jabatan?token=".$token;
        $response     = $client->request('POST',$url, [
            'headers' => ['Content-type' => 'application/json'],
            'body'    => json_encode($parameter)
        ]);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('jabatan')->withErrors($error)->withInput();
        }else {
            return redirect()->to('jabatan')->with("success", "Berhasil Memasukkan Data");
        }
    }

    public function edit ($id)
    {
        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:8000/api/jabatan/$id?token=".$token;
        $response     = $client->request('GET',$url);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status']!=true) {
            # code...
            $error = $contentArray['message'];
            return redirect()->to('jabatan')->withErrors($error);
        }else{
            $data = $contentArray['data'];
            return view('admin.jabatan_edit',['data' => $data]);
        }
    }

    public function update(Request $request,$id)
    {
        $nama_jabatan = $request->nama_jabatan;

        $parameter = [
            'nama_jabatan'   => $nama_jabatan,
        ];

        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:8000/api/jabatan/$id?token=".$token;
        $response     = $client->request('PUT',$url, [
            'headers' => ['Content-type' => 'application/json'],
            'body'    => json_encode($parameter)
        ]);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('jabatan')->withErrors($error)->withInput();
        }else {
            return redirect()->to('jabatan')->with("success", "Berhasil Update Data");
        }
    }

    public function destroy($id)
    {
        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:8000/api/jabatan/$id?token=".$token;
        $response     = $client->request('DELETE',$url);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('jabatan')->withErrors($error)->withInput();
        }else {
            return redirect()->to('jabatan')->with("success", "Berhasil Hapus Data");
        }
    }

}
