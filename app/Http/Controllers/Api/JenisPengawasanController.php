<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jenis_Pengawasan;
use Illuminate\Http\Request;
use App\Models\JenisPengawasan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class JenisPengawasanController extends Controller
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
        $jp = Jenis_Pengawasan::latest()->get();
        return response()->json([
            'status'     => true,
            'message'    => 'data di temukan',
            'data'       => $jp
        ],200);
    }

    public function store(Request $request)
    {
        $dataJP = new Jenis_Pengawasan;

        $rules = [
            'nama_jenispengawasan'   => 'required',
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

        $dataJP->nama_jenispengawasan = $request->nama_jenispengawasan;

        $jp = $dataJP->save();

        return response()->json([
            'status'  => true,
            'message' => 'Sukses Memasukkan data'
        ]);
    }

    public function update(Request $request,$id)
    {
        $dataJP = Jenis_Pengawasan::find($id);
        if (empty($dataJP)) {
            # code...
            return response()->json([
                'status'  => false,
                'message' => 'Data tidak ditemukan'
            ],404);
        }

        $rules = [
            'nama_jenispengawasan'   => 'required'
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

            $dataJP->nama_jenispengawasan = $request->nama_jenispengawasan;

            $jp = $dataJP->save();

        return response()->json([
            'status'  => true,
            'message' => 'Sukses Melakukan Update data'
        ]);
    }

    public function destroy($id)
    {
        $dataJP = Jenis_Pengawasan::find($id);
        if (empty($dataJP)) {
            # code...
            return response()->json([
                'status'  => false,
                'message' => 'Data tidak ditemukan'
            ],404);
        }

        $jp = $dataJP->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Sukses Melakukan Hapus data'
        ]);
    }
    public function show($id)
    {
        $jp = Jenis_Pengawasan::find($id);
        if ($jp) {
            # code...
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $jp
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

        public function search(Request $request)
    {
        $nama_jenisPengawasan = $request->nama_jenisPengawasan;
        $jenisPengawasan = Jenis_Pengawasan::where("nama_jenispengawasan",'LIKE','%'.$nama_jenisPengawasan.'%')->get();
        return response()->json($jenisPengawasan);
    }

       public function search2(Request $request)
    {
        $nama_jenisPengawasan = $request->nama_jenisPengawasan;
        $jenisPengawasan = Jenis_Pengawasan::where("nama_jenispengawasan",'LIKE','%'.$nama_jenisPengawasan.'%')->get();
        return response()->json($jenisPengawasan);
    }

}
