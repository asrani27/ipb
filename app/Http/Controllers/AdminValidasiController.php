<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminValidasiController extends Controller
{
    public function index()
    {
        return view('admin.validasi.index');
    }
}
