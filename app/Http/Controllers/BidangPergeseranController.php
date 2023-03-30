<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BidangPergeseranController extends Controller
{
    public function program()
    {
        Session::flash('info', 'Fix kan Modul Murni Terlebih Dahulu');
        return back();
    }
}
