<?php

namespace App\Http\Controllers\AdminTL\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RekomTLController extends Controller
{
     public function index()
    {

        $pengawasan = DB::table('v_tl1')->where('tipe', '=', 'Rekomendasi')->get();


        return response()->json([
            'status'     => true,
            'message'    => 'data di temukan',
            'data'       => $pengawasan
        ],200);

    }
}
