<?php

namespace App\Http\Controllers\Api;

use App\Models\SKPD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Skpd as ModelsSkpd;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class SKPDController extends Controller
{

    public function __construct(Request $request)
    {
        $user = DB::table('users')->where('remember_token', $request->token)->first();

        if (!$user) {
            abort(response()->json([
                'messsage' => 'Token Not Valid',
            ], 401));
        }

    }
    public function index()
    {
        //get all posts
        $skpd = SKPD::latest()->get();
        return response()->json([
            'status' => true,
            'message' => 'data di temukan',
            'data' => $skpd
        ], 200);
    }

    public function show($id)
    {
        $skpd = SKPD::find($id);

        if (!$skpd) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $skpd
        ]);
    }

    public function store(Request $request)
    {
        $dataSkpd = new SKPD;

        $rules = [
            'instansi' => 'required',
            'skpd' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'website' => 'required',
            'email' => 'required',
            'kodepos' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nomorsurat' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            # code...
            return response()->json([
                'status' => false,
                'message' => 'Gagal Memasukkan data',
                'data' => $validator->errors()
            ]);
        }
        $logo = $request->file('logo');
        $logo->storeAs('public/logo', $logo->hashName());

        $dataSkpd->instansi = $request->instansi;
        $dataSkpd->skpd = $request->skpd;
        $dataSkpd->alamat = $request->alamat;
        $dataSkpd->telp = $request->telp;
        $dataSkpd->website = $request->website;
        $dataSkpd->email = $request->email;
        $dataSkpd->kodepos = $request->kodepos;
        $dataSkpd->logo = $logo->hashName();
        $dataSkpd->nomorsurat = $request->nomorsurat;



        $skpd = $dataSkpd->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses Memasukkan data'
        ]);
    }

   public function update(Request $request)
    {
        try {
            // Debug: Log incoming request
            Log::info('API SKPD Update received:', [
                'id' => $request->id,
                'all_data' => $request->all(),
                'token' => $request->token
            ]);

            $id = $request->id;

            $dataSkpd = Skpd::where('id', $id)->first();
            if (empty($dataSkpd)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan dari id ' . $id
                ], 404);
            }

            // Buat rules dinamis berdasarkan field yang dikirim
            $rules = [];

            if ($request->filled('instansi'))
                $rules['instansi'] = 'required';
            if ($request->filled('skpd'))
                $rules['skpd'] = 'required';
            if ($request->filled('alamat'))
                $rules['alamat'] = 'required';
            if ($request->filled('telp'))
                $rules['telp'] = 'required';
            if ($request->filled('website'))
                $rules['website'] = 'required';
            if ($request->filled('email'))
                $rules['email'] = 'required';
            if ($request->has('nomorsurat'))
                $rules['nomorsurat'] = 'nullable';
            if ($request->filled('kodepos'))
                $rules['kodepos'] = 'required';
            if ($request->filled('id_pemimpin'))
                $rules['id_pemimpin'] = 'required';
            if ($request->filled('id_bendahara'))
                $rules['id_bendahara'] = 'required';

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal Melakukan Update data',
                    'data' => $validator->errors()
                ]);
            }

            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logo->storeAs('public/logo', $logo->hashName());

                if ($dataSkpd->logo) {
                    Storage::delete('public/logo/' . basename($dataSkpd->logo));
                }

                $dataSkpd->logo = $logo->hashName();
            }

            // Update field berdasarkan data yang dikirim
            if ($request->has('instansi'))
                $dataSkpd->instansi = $request->instansi;
            if ($request->has('skpd'))
                $dataSkpd->skpd = $request->skpd;
            if ($request->has('alamat'))
                $dataSkpd->alamat = $request->alamat;
            if ($request->has('telp'))
                $dataSkpd->telp = $request->telp;
            if ($request->has('website'))
                $dataSkpd->website = $request->website;
            if ($request->has('email'))
                $dataSkpd->email = $request->email;
            if ($request->has('kodepos'))
                $dataSkpd->kodepos = $request->kodepos;
            if ($request->has('nomorsurat'))
                $dataSkpd->nomorsurat = $request->nomorsurat;
            if ($request->has('id_pemimpin'))
                $dataSkpd->id_pemimpin = $request->id_pemimpin;
            if ($request->has('id_bendahara'))
                $dataSkpd->id_bendahara = $request->id_bendahara;
            $dataSkpd->save();

            return response()->json([
                'status' => true,
                'message' => 'Sukses Melakukan Update data'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Melakukan Update data',
                'error' => $e->getMessage()
            ]);
        }
    }


    public function destroy($id)
    {
        $dataSkpd = SKPD::find($id);
        if (empty($dataSkpd)) {
            # code...
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        Storage::delete('public/logo/' . basename($dataSkpd->logo));

        $skpd = $dataSkpd->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses Melakukan Hapus data'
        ]);
    }

    public function showDataSKPD()
    {
        $dataSkpd = SKPD::first();

        $value = $dataSkpd;

        $response = [
            'instansi' => $value->instansi,
            'skpd' => $value->skpd,
            'alamat' => $value->alamat,
            'telp' => $value->telp,
            'website' => $value->website,
            'email' => $value->email,
            'kodepos' => $value->kodepos,
            'logo' => $value->logo,
            'bendahara' => $value->id_bendahara,
            'pemimpin' => $value->id_pemimpin,
        ];

        return response()->json([
            'status' => true,
            'message' => 'data di temukan',
            'data' => $response
        ], 200);
    }


}
