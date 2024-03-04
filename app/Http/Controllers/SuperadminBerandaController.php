<?php

namespace App\Http\Controllers;

use App\Models\BatasInput;
use Illuminate\Http\Request;

class SuperadminBerandaController extends Controller
{
    public function index()
    {
        return view('superadmin.home');
    }
    public function batasinput()
    {
        $data = BatasInput::get();
        return view('superadmin.batasinput.index', compact('data'));
    }
}
