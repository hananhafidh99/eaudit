<?php

namespace App\Http\Controllers\Api;

use App\Models\SKPD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SKPDController extends Controller
{

    public function __construct(Request $request)
    {
    $user = DB::table('users')->where('remember_token', $request->token)->first();

    if (!$user)
    {
        abort(response()->json([
            'messsage' => 'Token Not Valid',
        ],401));
    }

    }
    public function index()
    {
        //get all posts
        $skpd = SKPD::latest()->get();
        return response()->json([
            'status'     => true,
            'message'    => 'data di temukan',
            'data'       => $skpd
        ],200);
    }

    public function store(Request $request)
    {
        $dataSkpd = new SKPD;

        $rules = [
            'instansi'   => 'required',
            'skpd'       => 'required',
            'alamat'     => 'required',
            'telp'       => 'required',
            'website'    => 'required',
            'email'      => 'required',
            'kodepos'    => 'required',
            'logo'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nomorsurat' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            # code...
            return response()->json([
                'status'  => false,
                'message' => 'Gagal Memasukkan data',
                'data'    => $validator->errors()
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
        $dataSkpd->logo =  $logo->hashName();
        $dataSkpd->nomorsurat = $request->nomorsurat;



        $skpd = $dataSkpd->save();

        return response()->json([
            'status'  => true,
            'message' => 'Sukses Memasukkan data'
        ]);
    }

    public function update(Request $request)
    {
        try{
            $id = $request->id;

            $dataSkpd = SKPD::where('id', $id)->first();
            if (empty($dataSkpd)) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan dari id '.$id
                ], 404);
            }

            $rules = [
                // 'instansi'   => 'required',
                'skpd'       => 'required',
                // 'alamat'     => 'required',
                // 'telp'       => 'required',
                // 'website'    => 'required',
                // 'email'      => 'required',
                // 'nomorsurat' => 'required',
                // 'kodepos'    => 'required',
                // 'id_pemimpin' => 'required',
                // 'id_bendahara' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Gagal Melakukan Update data',
                    'data'    => $validator->errors()
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

            //  $dataSkpd->instansi = $request->instansi;
             $dataSkpd->skpd = $request->skpd;
            //  $dataSkpd->alamat = $request->alamat;
            //  $dataSkpd->telp = $request->telp;
            //  $dataSkpd->website = $request->website;
            //  $dataSkpd->email = $request->email;
            //  $dataSkpd->kodepos = $request->kodepos? $request->kodepos : $dataSkpd->kodepos;
            //  $dataSkpd->nomorsurat = $request->nomorsurat;
            //  $dataSkpd->id_pemimpin = $request->id_pemimpin;
            //  $dataSkpd->id_bendahara = $request->id_bendahara;
             $dataSkpd->save();

            return response()->json([
                'status'  => true,
                'message' => 'Sukses Melakukan Update data'
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Gagal Melakukan Update data',
                'error'   => $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        $dataSkpd = SKPD::find($id);
        if (empty($dataSkpd)) {
            # code...
            return response()->json([
                'status'  => false,
                'message' => 'Data tidak ditemukan'
            ],404);
        }

        Storage::delete('public/logo/'.basename($dataSkpd->logo));

        $skpd = $dataSkpd->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Sukses Melakukan Hapus data'
        ]);
    }

    public function showDataSKPD()
    {
        $dataSkpd = SKPD::first();

        $value = $dataSkpd;

        $response= [
            'instansi'       => $value->instansi,
            'skpd'           => $value->skpd,
            'alamat'         => $value->alamat,
            'telp'           => $value->telp,
            'website'        => $value->website,
            'email'          => $value->email,
            'kodepos'        => $value->kodepos,
            'logo'           => $value->logo,
            'bendahara'      => $value->id_bendahara,
            'pemimpin'       => $value->id_pemimpin,
        ];

        return response()->json([
            'status'     => true,
            'message'    => 'data di temukan',
            'data'       => $response
        ],200);
    }


    }
