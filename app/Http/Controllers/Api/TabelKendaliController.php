<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Tabel_kendali;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TabelKendaliController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = DB::table('users')->where('remember_token', $request->token)->first();

            if (!$user) {
                abort(response()->json([
                    'messsage' => 'Token Not Valid',
                ], 401));
            }

            return $next($request);
        });
    }

    public function index()
    {
        //get all posts
        $dataTabelKendali = DB::table('v_tabelKendali')->get();
        return response()->json([
            'status' => true,
            'message' => 'data di temukan',
            'data' => $dataTabelKendali
        ], 200);
    }

    public function store(Request $request)
    {
        $dataTabelKendali = new Tabel_kendali;

        $rules = [
            'id_pegawai'               => 'required',
            'tanggal_awal_pemeriksaan' => 'required',
            'tanggal_akhir_pemeriksaan' => 'required',
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

        $dataTabelKendali->id_pegawai               = $request->id_pegawai;
        $dataTabelKendali->tanggal_awal_pemeriksaan = $request->tanggal_awal_pemeriksaan;
        $dataTabelKendali->tanggal_akhir_pemeriksaan = $request->tanggal_akhir_pemeriksaan;

        $eselon = $dataTabelKendali->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses Memasukkan data'
        ]);
    }

        public function destroy($id)
    {
        $dataTabelKendali = Tabel_kendali::find($id);
        if (empty($dataTabelKendali)) {
            # code...
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $eselon = $dataTabelKendali->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses Melakukan Hapus data'
        ]);
    }
}
