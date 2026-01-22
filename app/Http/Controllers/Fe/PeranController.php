<?php

namespace App\Http\Controllers\Fe;

use App\Models\Peran;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PeranController extends Controller
{
       public function index()
    {
        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:9000/api/peran?token=".$token;
        $response     = $client->request('GET',$url);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data         = $contentArray['data'];
        return view('admin.peran',['data'=>$data]);
    }
    public function create()
    {
        $peran = Peran::select("sort_order")->orderBy("sort_order",'desc')->first();
        $sortOrder = $peran['sort_order'] >= 0 ? $peran['sort_order'] + 1 : 0;
        return view('admin.peran_create',compact('sortOrder'));
    }

    public function store(Request $request)
    {
        $nama_peran = $request->nama_peran;
        $sort_order = $request->sort_order;
        $tarif = $request->tarif;

        $parameter = [
            'nama_peran'   => $nama_peran,
            'sort_order'   => $request->sort_order,
            'tarif'        => $request->tarif
        ];

        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:9000/api/peran?token=".$token;
        $response     = $client->request('POST',$url, [
            'headers' => ['Content-type' => 'application/json'],
            'body'    => json_encode($parameter)
        ]);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('peran')->withErrors($error)->withInput();
        }else {
            return redirect()->to('peran')->with("success", "Berhasil Memasukkan Data");
        }
    }

    public function edit ($id)
    {
        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:9000/api/peran/$id?token=".$token;
        $response     = $client->request('GET',$url);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status']!=true) {
            # code...
            $error = $contentArray['message'];
            return redirect()->to('peran')->withErrors($error);
        }else{
            $data = $contentArray['data'];
            return view('admin.peran_edit',['data' => $data]);
        }
    }

    public function update(Request $request,$id)
    {
        $nama_peran = $request->nama_peran;
        $tarif = $request->tarif;
        $sort_order = $request->sort_order;

        $parameter = [
            'nama_peran'   => $nama_peran,
            'tarif'   => $tarif,
            'sort_order' => $sort_order
        ];

        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:9000/api/peran/$id?token=".$token;
        $response     = $client->request('PUT',$url, [
            'headers' => ['Content-type' => 'application/json'],
            'body'    => json_encode($parameter)
        ]);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('peran')->withErrors($error)->withInput();
        }else {
            return redirect()->to('peran')->with("success", "Berhasil Update Data");
        }
    }

    public function destroy($id)
    {
        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:9000/api/peran/$id?token=".$token;
        $response     = $client->request('DELETE',$url);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('peran')->withErrors($error)->withInput();
        }else {
            return redirect()->to('peran')->with("success", "Berhasil Hapus Data");
        }
    }

}
