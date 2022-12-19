<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BidangBerandaController extends Controller
{
    public function index()
    {
        $data = null;
        return view('bidang.home', compact('data'));
    }
}
