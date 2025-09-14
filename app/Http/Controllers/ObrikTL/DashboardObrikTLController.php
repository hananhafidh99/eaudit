<?php

namespace App\Http\Controllers\ObrikTL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardObrikTLController extends Controller
{
    public function index()
    {
        return view('ObrikTL.index');
    }
}
