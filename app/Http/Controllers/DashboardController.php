<?php

namespace App\Http\Controllers;

use App\Models\Skpd;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $skpd = Skpd::where('is_aktif', 1)->get();
        return view('dashboard', compact('skpd'));
    }
}
