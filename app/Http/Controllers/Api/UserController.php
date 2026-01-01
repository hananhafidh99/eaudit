<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        //get all posts
        $user = User::latest()->get();
        return response()->json([
            'status' => true,
            'message' => 'data di temukan',
            'data' => $user
        ], 200);
    }

    public function login(Request $request)
    {

        $username = $request->username;
        $password = $request->password;

        $path = '';
        $token = null;


        $cekuser = User::where("username", $username)->first();
        if (!$cekuser) {
            return response()->json([
                'code' => 404,
                'message' => 'User tidak ditemukan',
                'data' => null
            ], 404);
        }
        // Cek password
        if (!Hash::check($password, $cekuser->password)) {
            // Password salah
            return response()->json([
                'code' => 401,
                'message' => 'Password salah',
                'data' => null
            ], 401);
        }

        // Generate token
        $token = Hash::make(Carbon::now()->toDayDateTimeString() . $cekuser->username);
        $cekuser->remember_token = $token;
        $cekuser->save();

        // Tentukan path berdasarkan level user
        // Tentukan path berdasarkan level user
        $levelPaths = [
            'admineaudit' => 'skpd',
            'admin' => 'skpd', // Added support for 'admin' role
            'adminTL' => 'adminTL',
            'pemeriksa' => 'PemeriksaTL',
            'OpdTL' => 'skpd', // Added based on screenshot
            'obrik' => 'divisionHead',
        ];

        // Use 'level' if available, otherwise fallback to 'role'
        $userLevel = $cekuser->level ?? $cekuser->role ?? 'obrik';

        $path = $levelPaths[$userLevel] ?? '/';

        // Response sukses
        return response()->json([
            'code' => 200,
            'token' => $token,
            'data' => $path
        ]);
    }

}
