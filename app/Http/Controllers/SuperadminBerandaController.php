<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperadminBerandaController extends Controller
{
    public function index()
    {
        return view('superadmin.home');
    }
}
