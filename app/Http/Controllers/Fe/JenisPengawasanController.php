<?php

namespace App\Http\Controllers\Fe;

use App\Exports\JenisPengawasanExport;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class JenisPengawasanController extends Controller
{
    //
        public function index(Request $request)
    {
        $data = null;
        if ($request->nama_jenisPengawasan) {
                # code...
                $client       = new Client();
                $token        = session('ctoken');
                $url          = "http://127.0.0.1:9000/api/datajenisPengawasan/search?token=".$token.'&nama_jenisPengawasan='.$request->nama_jenisPengawasan;
                $response     = $client->request('GET',$url);
                $content      = $response->getBody()->getContents();
                $contentArray = json_decode($content,true);
                $data         = $contentArray;
        }else{
                $client       = new Client();
                $token        = session('ctoken');
                $url          = "http://127.0.0.1:9000/api/jenisPengawasan?token=".$token;
                $response     = $client->request('GET',$url);
                $content      = $response->getBody()->getContents();
                $contentArray = json_decode($content,true);
                $data         = $contentArray['data'];
        }
        return view('admin.jenisPengawasan',['data'=>$data]);
    }
    public function create()
    {
        return view('admin.jenisPengawasan_create');
    }

    public function store(Request $request)
    {
        $nama_jenispengawasan = $request->nama_jenispengawasan;

        $parameter = [
            'nama_jenispengawasan'   => $nama_jenispengawasan,
        ];

        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:9000/api/jenisPengawasan?token=".$token;
        $response     = $client->request('POST',$url, [
            'headers' => ['Content-type' => 'application/json'],
            'body'    => json_encode($parameter)
        ]);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('jenisPengawasan')->withErrors($error)->withInput();
        }else {
            return redirect()->to('jenisPengawasan')->with("success", "Berhasil Memasukkan Data");
        }
    }

    public function edit ($id)
    {
        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:9000/api/jenisPengawasan/$id?token=".$token;
        $response     = $client->request('GET',$url);

        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status']!=true) {
            # code...
            $error = $contentArray['message'];
            return redirect()->to('jenisPengawasan')->withErrors($error);
        }else{
            $data = $contentArray['data'];
            return view('admin.jenisPengawasan_edit',['data' => $data]);
        }
    }

    public function update(Request $request,$id)
    {
        $nama_jenispengawasan = $request->nama_jenispengawasan;

        $parameter = [
            'nama_jenispengawasan'   => $nama_jenispengawasan,
        ];

        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:9000/api/jenisPengawasan/$id?token=".$token;
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
            return redirect()->to('jenisPengawasan')->withErrors($error)->withInput();
        }else {
            return redirect()->to('jenisPengawasan')->with("success", "Berhasil Update Data");
        }
    }

    public function destroy($id)
    {
        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:9000/api/jenisPengawasan/$id?token=".$token;
        $response     = $client->request('DELETE',$url);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('jenisPengawasan')->withErrors($error)->withInput();
        }else {
            return redirect()->to('jenisPengawasan')->with("success", "Berhasil Hapus Data");
        }
    }

    function export()
    {
        return Excel::download(new JenisPengawasanExport, 'JenisPengawasan.xlsx');
    }
}
