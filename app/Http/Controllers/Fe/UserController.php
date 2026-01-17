<?php

namespace App\Http\Controllers\Fe;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $client = new Client();
        $url = "http://127.0.0.1:9000/api/obrik?token=";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
    }
    public function login(Request $request)
    {

        $username = $request->username;
        $password = $request->password;

        $request->validate([
            'username' => "required",
            'password' => "required",
        ]);

        $params = [
            'username' => $username,
            'password' => $password
        ];

        $response = Http::post("http://127.0.0.1:9000" . ('/api/login'), $params);
        $json = $response->json();

        // Debug: uncomment line below to see API response
        // dd($json);

        $token = $json['token'] ?? null;
        $redirectUrl = $json['data'] ?? '/';

        if (!$token) {
            $message = $json['message'] ?? 'Username atau Password salah.';
            return back()->withErrors(['login' => $message]);
        }

        session(['ctoken' => $token, 'sdata' => date('Y')]);
        return redirect(url($redirectUrl));
    }
    public function logout(Request $request)
    {
        $request->session()->forget(['id', 'name', 'username', 'level']);
        $request->session()->flush();

        return redirect('/');
    }

    public function ubahtahun(Request $request)
    {
        $request->session()->put("sdata", $request->input('tahun'));

        return redirect()->back();

    }



}
