<?php

namespace App\Http\Controllers\Fe;

use GuzzleHttp\Client;
use App\Models\Pangkat;
use Illuminate\Http\Request;
use App\Exports\PegawaiExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class PegawaiController extends Controller
{
    //

    const API_URL = "http://127.0.0.1:9000/api/pegawai";
    public function index(Request $request)
    {

        $current_url  = url()->current();
        $client       = new Client();
        $url          = static::API_URL;
        $token        = session('ctoken');
        // $url          = "http://127.0.0.1:9000/api/pegawai?token=".$token;
        if ($request->input('page') != '') {
            # code...
            $url .= "?page=".$request->input('page').'&token='.$token;
        }else{
            $url .= '?token='.$token;
        }
        $response     = $client->request('GET',$url);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data         = $contentArray['data'];
        foreach ($data['links'] as $key => $value) {
            # code...
            $data['links'][$key]['url2'] = str_replace(static::API_URL, $current_url, $value['url']);
        }
        return view('admin.pegawai',['data'=>$data]);
    }
    public function create()
    {
        $token    = session('ctoken');
        $data     = Http::get("http://127.0.0.1:9000/api/pangkat", ['token' => $token])['data'];
        $jabatan  = Http::get("http://127.0.0.1:9000/api/jabatan", ['token' => $token])['data'];
        $eselon   = Http::get("http://127.0.0.1:9000/api/eselon", ['token' => $token])['data'];
        return view('admin.pegawai_create', ['data'=>$data,'jabatan'=>$jabatan,'eselon'=>$eselon]);
    }

    public function store(Request $request)
    {
        $nama_pegawai       = $request->nama_pegawai;
        $nip        = $request->nip;
        $id_pangkat         = $request->id_pangkat;
        $id_jabatan         = $request->id_jabatan;
        $id_eselon          = $request->id_eselon;
        $rekening_pegawai   = $request->rekening_pegawai;
        $status_pegawai     = $request->status_pegawai;

        $parameter = [
            'nama_pegawai'  => $request->nama_pegawai,
            'id_pangkat'    => $request->id_pangkat,
            'nip'   => $request->nip,
            'id_jabatan'  => $request->id_jabatan,
            'id_eselon'    => $request->id_eselon,
            'rekening_pegawai'   => $request->rekening_pegawai,
            'status_pegawai'   => $request->status_pegawai
        ];

        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:9000/api/pegawai?token=".$token;
        $response     = $client->request('POST',$url, [
            'headers' => ['Content-type' => 'application/json'],
            'body'    => json_encode($parameter)
        ]);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('pegawai')->withErrors($error)->withInput();
        }else {
            return redirect()->to('pegawai')->with("success", "Berhasil Memasukkan Data");
        }
    }

    public function edit($id)
    {

        $token   = session('ctoken');
        $pegawai    = Http::get("http://127.0.0.1:9000/api/pegawai-edit/$id", ['token' => $token])['data'];
        $pangkat = Http::get("http://127.0.0.1:9000/api/pangkat", ['token' => $token])['data'];
        $jabatan = Http::get("http://127.0.0.1:9000/api/jabatan", ['token' => $token])['data'];
        $eselon = Http::get("http://127.0.0.1:9000/api/eselon", ['token' => $token])['data'];
        return view('admin.pegawai_edit', ['pegawai'=>$pegawai,'pangkat'=>$pangkat,'jabatan'=>$jabatan,'eselon'=>$eselon]);

    }

    public function update(Request $request,$id)
     {
        $nama_pegawai       = $request->nama_pegawai;
        $nip_pegawai        = $request->nip;
        $id_pangkat         = $request->id_pangkat;
        $id_jabatan         = $request->id_jabatan;
        $id_eselon          = $request->id_eselon;
        $rekening_pegawai   = $request->rekening_pegawai;
        $status_pegawai     = $request->status_pegawai;

        $parameter = [
            'nama_pegawai'  => $request->nama_pegawai,
            'id_pangkat'    => $request->id_pangkat,
            'nip'   => $request->nip,
            'id_jabatan'  => $request->id_jabatan,
            'id_eselon'    => $request->id_eselon,
            'rekening_pegawai'   => $request->rekening_pegawai,
            'status_pegawai'   => $request->status_pegawai
        ];

        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:9000/api/pegawai/$id?token=".$token;
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
            return redirect()->to('pegawai')->withErrors($error)->withInput();
        }else {
            return redirect()->to('pegawai')->with("success", "Berhasil Update Data");
        }
     }

}
