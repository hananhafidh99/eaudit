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
                $client       = new Client();
                $url          = "http://127.0.0.1:8000/api/obrik?token=";
                $response     = $client->request('GET',$url);
                $content      = $response->getBody()->getContents();
                $contentArray = json_decode($content,true);
                $data         = $contentArray['data'];
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

        $response = Http::post("http://127.0.0.1:8000".('/api/login'),$params);
        // dd($response->json());
        $token = $response->json()['token'];

        session(['ctoken' => $token, 'sdata' => date('Y')] );

        // session(['ctoken' => $token, 'sdata' => date('Y'), 'usernamebaru' => $usernamebaru, 'levelbaru' => $levelbaru] );

        return redirect(url($response->json()['data']));
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

    return redirect('skpd');

    }



}
