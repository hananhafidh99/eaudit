<?php

namespace App\Http\Controllers\Api;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class JabatanController extends Controller
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
        $jabatan = Jabatan::orderBy('id', 'asc')->get();
        return response()->json([
            'status'     => true,
            'message'    => 'data di temukan',
            'data'       => $jabatan
        ],200);
    }

    public function store(Request $request)
    {
        $dataJabatan = new Jabatan;

        $rules = [
            'nama_jabatan'   => 'required',
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

        $dataJabatan->nama_jabatan = $request->nama_jabatan;

        $jabatan = $dataJabatan->save();

        return response()->json([
            'status'  => true,
            'message' => 'Sukses Memasukkan data'
        ]);
    }

    public function update(Request $request,$id)
    {
        $dataJabatan = Jabatan::find($id);
        if (empty($dataJabatan)) {
            # code...
            return response()->json([
                'status'  => false,
                'message' => 'Data tidak ditemukan'
            ],404);
        }

        $rules = [
            'nama_jabatan'   => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            # code...
            return response()->json([
                'status'  => false,
                'message' => 'Gagal Melakukan Update data',
                'data'    => $validator->errors()
            ]);
        }

            $dataJabatan->nama_jabatan = $request->nama_jabatan;

            $jabatan = $dataJabatan->save();

        return response()->json([
            'status'  => true,
            'message' => 'Sukses Melakukan Update data'
        ]);
    }

    public function destroy($id)
    {
        $dataJabatan = Jabatan::find($id);
        if (empty($dataJabatan)) {
            # code...
            return response()->json([
                'status'  => false,
                'message' => 'Data tidak ditemukan'
            ],404);
        }

        $jabatan = $dataJabatan->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Sukses Melakukan Hapus data'
        ]);
    }

    public function show($id)
    {
        $jabatan = Jabatan::find($id);
        if ($jabatan) {
            # code...
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $jabatan
            ],200);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

}
