<?php

namespace App\Http\Controllers\Fe;

use App\Models\Eselon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Exports\EselonExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class EselonController extends Controller
{
    //
     public function index()
    {
        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:9000/api/eselon?token=".$token;
        $response     = $client->request('GET',$url);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data         = $contentArray['data'];
        return view('admin.eselon',['data'=>$data]);
    }
    public function create()
    {
        return view('admin.eselon_create');
    }

    public function store(Request $request)
    {
        $nama_eselon = $request->nama_eselon;

        $parameter = [
            'nama_eselon'   => $nama_eselon,
        ];

        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:9000/api/eselon?token=".$token;
        $response     = $client->request('POST',$url, [
            'headers' => ['Content-type' => 'application/json'],
            'body'    => json_encode($parameter)
        ]);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('eselon')->withErrors($error)->withInput();
        }else {
            return redirect()->to('eselon')->with("success", "Berhasil Memasukkan Data");
        }
    }

    public function edit ($id)
    {
        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:9000/api/eselon/$id?token=".$token;
        $response     = $client->request('GET',$url);

        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status']!=true) {
            # code...
            $error = $contentArray['message'];
            return redirect()->to('eselon')->withErrors($error);
        }else{
            $data = $contentArray['data'];
            return view('admin.eselon_edit',['data' => $data]);
        }
    }

    public function update(Request $request,$id)
    {
        $nama_eselon = $request->nama_eselon;

        $parameter = [
            'nama_eselon'   => $nama_eselon
        ];

        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:9000/api/eselon/$id?token=".$token;
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
            return redirect()->to('eselon')->withErrors($error)->withInput();
        }else {
            return redirect()->to('eselon')->with("success", "Berhasil Update Data");
        }
    }

    public function destroy($id)
    {
        $client       = new Client();
        $token        = session('ctoken');
        $url          = "http://127.0.0.1:9000/api/eselon/$id?token=".$token;
        $response     = $client->request('DELETE',$url);
        $content      = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('eselon')->withErrors($error)->withInput();
        }else {
            return redirect()->to('eselon')->with("success", "Berhasil Hapus Data");
        }
    }

    public function export()
    {
        $eselon = Eselon::all();
        return Excel::download(new EselonExport($eselon), 'eselon.xlsx');
    }
}
