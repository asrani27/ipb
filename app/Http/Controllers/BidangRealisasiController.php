<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BidangRealisasiController extends Controller
{
    public function index()
    {
        return view('bidang.realisasi.index');
    }
}
