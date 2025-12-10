<?php

namespace App\Http\Controllers\Api;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class KegiatanController extends Controller
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
        $kegiatan = DB::table('v_kegiatan')->get();
        return response()->json([
            'status' => true,
            'message' => 'data di temukan',
            'data' => $kegiatan
        ], 200);
    }

    public function store(Request $request)
    {
        $dataKegiatan = new Kegiatan;

        $rules = [
            'norek' => 'required',
            'kegiatan' => 'required',
            'id_pptk' => 'required',
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

        $dataKegiatan->norek = $request->norek;
        $dataKegiatan->kegiatan = $request->kegiatan;
        $dataKegiatan->id_pptk = $request->id_pptk;

        $eselon = $dataKegiatan->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses Memasukkan data'
        ]);
    }

    public function editKegiatan(Request $request, $id)
    {
        $kegiatan = DB::table('kegiatans')->join('pegawais', 'kegiatans.id_pptk', '=', 'pegawais.id')
            ->select('kegiatans.*', 'pegawais.nama_pegawai')->where('kegiatans.id', $id)->first();

        return response()->json([
            'status' => true,
            'message' => 'Data  ditemukan',
            'data' => $kegiatan
        ]);
    }

    public function update(Request $request, $id)
    {
        $dataKegiatan = Kegiatan::find($id);
        if (empty($dataKegiatan)) {
            # code...
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $rules = [
            'norek' => 'required',
            'kegiatan' => 'required',
            'id_pptk' => 'required'
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

        $dataKegiatan->norek = $request->norek;
        $dataKegiatan->kegiatan = $request->kegiatan;
        $dataKegiatan->id_pptk = $request->id_pptk;

        $kegiatan = $dataKegiatan->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses Melakukan Update data1'
        ]);
    }
}
