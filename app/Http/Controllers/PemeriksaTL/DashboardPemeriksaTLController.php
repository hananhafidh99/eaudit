<?php

namespace App\Http\Controllers\PemeriksaTL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardPemeriksaTLController extends Controller
{
    public function index()
    {
        return view('PemeriksaTL.index');
    }
}
