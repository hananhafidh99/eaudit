<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index()
    {
        $response = Http::get("http://127.0.0.1:8000/api/user");

        $user     = $response->json();
        dd($user);

        return redirect($response->json()['data']);
    }
}
