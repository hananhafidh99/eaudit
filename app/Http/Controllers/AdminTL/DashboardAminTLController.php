<?php

namespace App\Http\Controllers\AdminTL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardAminTLController extends Controller
{
    public function index()
    {
        return view('adminTL.index');
    }

    public function pkpt()
    {
        return view('adminTL.pkpt');
    }

    public function rekom()
    {
        return view('AdminTL.rekom');
    }

        public function temurekom()
    {
        return view('AdminTL.temuanrekom');
    }
}
