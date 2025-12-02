<?php

namespace App\Http\Controllers\Fe;

use GuzzleHttp\Client;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SKPDController extends Controller
{
    //
    //
    public function index()
    {
        $token = session('ctoken');
        $data = Http::get("http://127.0.0.1:8000/api/skpd", ['token' => $token])['data'][0];
        $pegawai = Http::get("http://127.0.0.1:8000/api/pegawai", ['token' => $token, 'N' => true])['data'];
        // $pegawai = Pegawai::all();
        session(['brand_logo' => $data['logo'], 'id_pimpinan' => $data['id_pimpinan'], 'id_bendahara' => $data['id_bendahara']]);


        return view('admin.skpd', compact('data', 'pegawai'));
    }

    public function store(Request $request)
    {
        $instansi = $request->instansi;
        $skpd = $request->skpd;
        $alamat = $request->alamat;
        $telp = $request->telp;
        $website = $request->website;
        $email = $request->email;

        $kodepos = $request->kodepos;
        $logo = $request->logo;
        $nomorsurat = $request->nomorsurat;

        $parameter = [
            'instansi' => $instansi,
            'skpd' => $skpd,
            'alamat' => $alamat,
            'telp' => $telp,
            'website' => $website,
            'email' => $email,
            'kodepos' => $kodepos,
            'logo' => $logo,
            'nomorsurat' => $nomorsurat
        ];

        $client = new Client();
        $token = session('ctoken');
        $url = "http://127.0.0.1:8002/api/skpd?token=" . $token;
        $response = $client->request('POST', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($parameter)
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('skpd')->withErrors($error)->withInput();
        } else {
            return redirect()->to('skpd')->with("success", "Berhasil Memasukkan Data");
        }
    }

    public function edit($id)
    {
        $client = new Client();
        $token = session('ctoken');
        $url = "http://127.0.0.1:8002/api/skpd/$id?token=" . $token;
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['message'];
            return redirect()->to('skpd')->withErrors($error);
        } else {
            $data = $contentArray['data'];
            return view('admin.skpd', ['data' => $data]);
        }
    }

    public function update(Request $request)
    {
        try {
            $id = $request->id;

            // Debug: Log request data
            Log::info('SKPD Update Request:', $request->all());
            $parameter = [
                [
                    'name' => 'id',
                    'contents' => $id
                ],
                [
                    'name' => 'instansi',
                    'contents' => $request->instansi
                ],
                [
                    'name' => 'skpd',
                    'contents' => $request->skpd
                ],
                [
                    'name' => 'alamat',
                    'contents' => $request->alamat
                ],
                [
                    'name' => 'telp',
                    'contents' => $request->telp
                ],
                [
                    'name' => 'website',
                    'contents' => $request->website
                ],
                [
                    'name' => 'email',
                    'contents' => $request->email
                ],
                [
                    'name' => 'kodepos',
                    'contents' => $request->kodepos
                ],
                [
                    'name' => 'nomorsurat',
                    'contents' => $request->nomorsurat
                ],
                [
                    'name' => 'id_pemimpin',
                    'contents' => $request->id_pemimpin
                ],
                [
                    'name' => 'id_bendahara',
                    'contents' => $request->id_bendahara
                ],
            ];

            if ($request->hasFile('logo')) {
                $parameter[] = [
                    'name' => 'logo',
                    'contents' => fopen($request->file('logo')->getPathname(), 'r'),
                    'filename' => $request->file('logo')->getClientOriginalName()
                ];
            }

            //  dd($parameter);

            $client = new Client();
            $token = session('ctoken');
            $url = "http://127.0.0.1:8002/api/skpd/$id?token=" . $token;
            $response = $client->request('POST', $url, [
                'multipart' => $parameter
            ]);

            $content = $response->getBody()->getContents();
            $contentArray = json_decode($content, true);

            // Debug: Log response untuk debugging
            Log::info('SKPD Update Response:', $contentArray);

            // Temporary debug - uncomment to see response
            dd('URL:', $url, 'Parameter sent:', $parameter, 'Response:', $contentArray);

            if ($contentArray['status'] != true) {
                $error = $contentArray['data'] ?? $contentArray['message'] ?? 'Unknown error';
                Log::error('SKPD Update Failed:', $contentArray);
                return redirect()->to('skpd')->withErrors($error)->withInput();
            } else {
                Log::info('SKPD Update Success:', $contentArray);
                return redirect()->to('skpd')->with("success", "Berhasil Update Data");
            }
        } catch (\Exception $e) {
            return redirect()->to('skpd')->withErrors($e->getMessage())->withInput();

        }
    }

    public function destroy($id)
    {
        $client = new Client();
        $token = session('ctoken');
        $url = "http://127.0.0.1:8002/api/skpd/$id?token=" . $token;
        $response = $client->request('DELETE', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] != true) {
            # code...
            $error = $contentArray['data'];
            return redirect()->to('skpd')->withErrors($error)->withInput();
        } else {
            return redirect()->to('skpd')->with("success", "Berhasil Hapus Data");
        }
    }


}
