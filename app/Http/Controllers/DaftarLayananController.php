<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DaftarLayananController extends Controller
{
    public function index()
    {
        return view('pemohon.daftar-layanan.index');
    }
}
