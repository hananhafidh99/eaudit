<?php

namespace App\Http\Controllers\Api;

use App\Models\Obrik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ObrikController extends Controller
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
        $obrik = Obrik::latest()->get();
        return response()->json([
            'status' => true,
            'message' => 'data di temukan',
            'data' => $obrik
        ], 200);
    }

    public function store(Request $request)
    {
        $dataJP = new Obrik;

        $rules = [
            'nama_obrik' => 'required',
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

        $dataJP->nama_obrik = $request->nama_obrik;

        $obrik = $dataJP->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses Memasukkan data'
        ]);
    }

    public function update(Request $request, $id)
    {
        $dataJP = Obrik::find($id);
        if (empty($dataJP)) {
            # code...
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $rules = [
            'nama_obrik' => 'required'
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

        $dataJP->nama_obrik = $request->nama_obrik;

        $obrik = $dataJP->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses Melakukan Update data'
        ]);
    }

    public function destroy($id)
    {
        $dataJP = Obrik::find($id);
        if (empty($dataJP)) {
            # code...
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $obrik = $dataJP->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses Melakukan Hapus data'
        ]);
    }
    public function show($id)
    {
        $obrik = Obrik::find($id);
        if ($obrik) {
            # code...
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $obrik
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function search(Request $request)
    {
        $nama_obrik = $request->nama_obrik;
        $obrik = Obrik::where("nama_obrik", 'LIKE', '%' . $nama_obrik . '%')->get();
        return response()->json($obrik);
    }

    public function search2(Request $request)
    {
        $nama_obrik = $request->nama_obrik;
        $obrik = Obrik::where("nama_obrik", 'LIKE', '%' . $nama_obrik . '%')->get();
        return response()->json($obrik);
    }
}
