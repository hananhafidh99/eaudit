<?php

namespace App\Http\Controllers\Api;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
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
    public function index(Request $request)
{
    $pegawai = Pegawai::with('pangkat')
                ->orderBy('nama_pegawai', 'asc');
                if ($request->N) {
                    # code...
                    $pegawai = $pegawai->get();

                    return response()->json([
                    'status' => true,
                    'message' => 'Data ditemukan',
                    'data' => $pegawai],200);

                }else {
                    $pegawai = $pegawai->paginate(10);
                    $dataTransformed = $pegawai->getCollection()->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'nama_pegawai' => $item->nama_pegawai,
                        'nip' => $item->nip,
                        'status_pegawai' => $item->status_pegawai,
                        'rekening_pegawai' => $item->rekening_pegawai,
                        'pangkat' => $item->pangkat ? $item->pangkat->nama_pangkat : null,
                    ];
                });
                $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
                    $dataTransformed,
                    $pegawai->total(),
                    $pegawai->perPage(),
                    $pegawai->currentPage(),
                    [
                        'path' => request()->url(),
                        'query' => request()->query(),
                    ]
                );

                return response()->json([
                    'status' => true,
                    'message' => 'Data ditemukan',
                    'data' => $paginated],200);
                }
                dd($pegawai);


}

    public function store(Request $request)
    {
        $dataPegawai = new Pegawai;

        $rules = [
            'nama_pegawai'   => 'required',
            'nip'   => 'required',
            'status_pegawai'   => 'required',
            'rekening_pegawai'   => 'required'
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

        $dataPegawai->nama_pegawai = $request->nama_pegawai;
        $dataPegawai->nip = $request->nip;
        $dataPegawai->status_pegawai = $request->status_pegawai;
        $dataPegawai->rekening_pegawai = $request->rekening_pegawai;
        $dataPegawai->id_pangkat = $request->id_pangkat;
        $dataPegawai->id_jabatan = $request->id_jabatan;
        $dataPegawai->id_eselon = $request->id_eselon;


        $pegawai = $dataPegawai->save();

        return response()->json([
            'status'  => true,
            'message' => 'Sukses Memasukkan data'
        ]);
    }

    public function update(Request $request,$id)
    {
        $dataPegawai = Pegawai::find($id);
        if (empty($dataPegawai)) {
            # code...
            return response()->json([
                'status'  => false,
                'message' => 'Data tidak ditemukan'
            ],404);
        }

        $rules = [
            'nama_pegawai'   => 'required',
            'nip'   => 'required',
            'status_pegawai'   => 'required',
            'rekening_pegawai'   => 'required'
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

        $dataPegawai->nama_pegawai = $request->nama_pegawai;
        $dataPegawai->nip = $request->nip;
        $dataPegawai->status_pegawai = $request->status_pegawai;
        $dataPegawai->rekening_pegawai = $request->rekening_pegawai;
        $dataPegawai->id_pangkat = $request->id_pangkat;
        $dataPegawai->id_jabatan = $request->id_jabatan;
        $dataPegawai->id_eselon = $request->id_eselon;


        $pegawai = $dataPegawai->save();

        return response()->json([
            'status'  => true,
            'message' => 'Sukses Melakukan Update data'
        ]);
    }

    public function destroy($id)
    {
        $dataPegawai = Pegawai::find($id);
        if (empty($dataPegawai)) {
            # code...
            return response()->json([
                'status'  => false,
                'message' => 'Data tidak ditemukan'
            ],404);
        }

        $pegawai = $dataPegawai->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Sukses Melakukan Hapus data'
        ]);
    }

    public function show($id)
    {
        $pegawai = Pegawai::find($id);
        if ($pegawai) {
            # code...
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $pegawai
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

        public function editPegawai(Request $request,$id)
    {
     $pegawai = DB::table('pegawais')->join('pangkats', 'pegawais.id_pangkat', '=', 'pangkats.id')
    ->select('pegawais.*', 'pangkats.nama_pangkat')->where('pegawais.id', $id)->first();

    return response()->json([
       'status' => true,
       'message' => 'Data  ditemukan',
       'data' => $pegawai
       ]);
    }

}
