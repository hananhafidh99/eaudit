<?php

namespace App\Http\Controllers\Api;

use App\Models\Pangkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PangkatController extends Controller
{
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
        $pangkat = Pangkat::orderBy('id', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'data di temukan',
            'data' => $pangkat
        ], 200);
    }

    public function store(Request $request)
    {
        $dataPangkat = new Pangkat;

        $rules = [
            'nama_pangkat' => 'required',
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

        $dataPangkat->nama_pangkat = $request->nama_pangkat;

        $pangkat = $dataPangkat->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses Memasukkan data'
        ]);
    }

    public function update(Request $request, $id)
    {
        $dataPangkat = Pangkat::find($id);
        if (empty($dataPangkat)) {
            # code...
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $rules = [
            'nama_pangkat' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            # code...
            return response()->json([
                'status' => false,
                'message' => 'Gagal Melakukan Update data',
                'data' => $validator->errors()
            ]);
        }

        $dataPangkat->nama_pangkat = $request->nama_pangkat;

        $pangkat = $dataPangkat->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses Melakukan Update data'
        ]);
    }

    public function destroy($id)
    {
        $dataPangkat = Pangkat::find($id);
        if (empty($dataPangkat)) {
            # code...
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $pangkat = $dataPangkat->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses Melakukan Hapus data'
        ]);
    }

    public function show($id)
    {
        $pangkat = Pangkat::find($id);
        if ($pangkat) {
            # code...
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $pangkat
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

}
