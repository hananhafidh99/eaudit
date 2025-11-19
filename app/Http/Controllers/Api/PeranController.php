<?php

namespace App\Http\Controllers\Api;

use App\Models\Peran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PeranController extends Controller
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
        $peran = Peran::orderBy('id', 'asc')->get();
        return response()->json([
            'status'     => true,
            'message'    => 'data di temukan',
            'data'       => $peran
        ],200);
    }

    public function store(Request $request)
    {
        $dataPeran = new Peran();

        $rules = [
            'nama_peran'   => 'required',
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

        $dataPeran->nama_peran = $request->nama_peran;
        $dataPeran->tarif = $request->tarif;
        $dataPeran->sort_order = $request->sort_order;

        $peran = $dataPeran->save();

        return response()->json([
            'status'  => true,
            'message' => 'Sukses Memasukkan data'
        ]);
    }

    public function update(Request $request,$id)
    {
        $dataPeran = Peran::find($id);
        if (empty($dataPeran)) {
            # code...
            return response()->json([
                'status'  => false,
                'message' => 'Data tidak ditemukan'
            ],404);
        }

        $rules = [
            'nama_peran'   => 'required'
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

            $dataPeran->nama_peran = $request->nama_peran;
            $dataPeran->tarif = $request->tarif;
            $dataPeran->sort_order = $request->sort_order;

            $peran = $dataPeran->save();

        return response()->json([
            'status'  => true,
            'message' => 'Sukses Melakukan Update data'
        ]);
    }

    public function destroy($id)
    {
        $dataPeran = Peran::find($id);
        if (empty($dataPeran)) {
            # code...
            return response()->json([
                'status'  => false,
                'message' => 'Data tidak ditemukan'
            ],404);
        }

        $peran = $dataPeran->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Sukses Melakukan Hapus data'
        ]);
    }

    public function show($id)
    {
        $peran = Peran::find($id);
        if ($peran) {
            # code...
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $peran
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
