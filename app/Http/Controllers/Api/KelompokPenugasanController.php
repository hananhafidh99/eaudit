<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\KelompokPenugasan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class KelompokPenugasanController extends Controller
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
        $eselon = KelompokPenugasan::orderBy('id', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'data di temukan',
            'data' => $eselon
        ], 200);
    }

    public function store(Request $request)
    {
        $dataEselon = new KelompokPenugasan;

        $rules = [
            'kelompokPenugasan' => 'required',
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

        $dataEselon->kelompokPenugasan = $request->kelompokPenugasan;

        $eselon = $dataEselon->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses Memasukkan data'
        ]);
    }

    public function update(Request $request, $id)
    {
        $dataEselon = KelompokPenugasan::find($id);
        if (empty($dataEselon)) {
            # code...
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $rules = [
            'kelompokPenugasan' => 'required'
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

        $dataEselon->kelompokPenugasan = $request->kelompokPenugasan;

        $eselon = $dataEselon->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses Melakukan Update data'
        ]);
    }

    public function destroy($id)
    {
        $dataEselon = KelompokPenugasan::find($id);
        if (empty($dataEselon)) {
            # code...
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $eselon = $dataEselon->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses Melakukan Hapus data'
        ]);
    }

    public function show($id)
    {
        $eselon = KelompokPenugasan::find($id);
        if ($eselon) {
            # code...
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $eselon
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }
}
