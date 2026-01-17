<?php

namespace App\Http\Controllers\Fe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ObrikController extends Controller
{
    //
         public function index(Request $request)
     {
            $data = null;
            if ($request->nama_obrik) {
                # code...
                $client       = new Client();
                $token        = session('ctoken');
                $url          = "http://127.0.0.1:9000/api/dataobrik/search?token=".$token.'&nama_obrik='.$request->nama_obrik;
                $response     = $client->request('GET',$url);
                $content      = $response->getBody()->getContents();
                $contentArray = json_decode($content,true);
                $data         = $contentArray;
            }else{
                $client       = new Client();
                $token        = session('ctoken');
                $url          = "http://127.0.0.1:9000/api/obrik?token=".$token;
                $response     = $client->request('GET',$url);
                $content      = $response->getBody()->getContents();
                $contentArray = json_decode($content,true);
                $data         = $contentArray['data'];
            }
         return view('admin.obrik',['data'=>$data]);
     }

     public function create()
     {
         return view('admin.obrik_create');
     }

     public function store(Request $request)
     {
         $nama_obrik = $request->nama_obrik;

         $parameter = [
             'nama_obrik'   => $nama_obrik,
         ];

         $client       = new Client();
         $token        = session('ctoken');
         $url          = "http://127.0.0.1:9000/api/obrik?token=".$token;
         $response     = $client->request('POST',$url, [
             'headers' => ['Content-type' => 'application/json'],
             'body'    => json_encode($parameter)
         ]);
         $content      = $response->getBody()->getContents();
         $contentArray = json_decode($content,true);
         if ($contentArray['status'] != true) {
             # code...
             $error = $contentArray['data'];
             return redirect()->to('obrik')->withErrors($error)->withInput();
         }else {
             return redirect()->to('obrik')->with("success", "Berhasil Memasukkan Data");
         }
     }

     public function edit ($id)
     {
         $client       = new Client();
         $token        = session('ctoken');
         $url          = "http://127.0.0.1:9000/api/obrik/$id?token=".$token;
         $response     = $client->request('GET',$url);

         $content      = $response->getBody()->getContents();
         $contentArray = json_decode($content,true);
         if ($contentArray['status']!=true) {
             # code...
             $error = $contentArray['message'];
             return redirect()->to('obrik')->withErrors($error);
         }else{
             $data = $contentArray['data'];
             return view('admin.obrik_edit',['data' => $data]);
         }
     }

     public function update(Request $request,$id)
     {
         $nama_obrik = $request->nama_obrik;

         $parameter = [
             'nama_obrik'   => $nama_obrik
         ];

         $client       = new Client();
         $token        = session('ctoken');
         $url          = "http://127.0.0.1:9000/api/obrik/$id?token=".$token;
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
             return redirect()->to('obrik')->withErrors($error)->withInput();
         }else {
             return redirect()->to('obrik')->with("success", "Berhasil Update Data");
         }
     }

     public function destroy($id)
     {
         $client       = new Client();
         $token        = session('ctoken');
         $url          = "http://127.0.0.1:9000/api/obrik/$id?token=".$token;
         $response     = $client->request('DELETE',$url);
         $content      = $response->getBody()->getContents();
         $contentArray = json_decode($content,true);
         if ($contentArray['status'] != true) {
             # code...
             $error = $contentArray['data'];
             return redirect()->to('obrik')->withErrors($error)->withInput();
         }else {
             return redirect()->to('obrik')->with("success", "Berhasil Hapus Data");
         }
     }

}
