<?php

namespace App\Http\Controllers;

use App\Models\Tpermohonan;
use Illuminate\Http\Request;

class AdminPermohonanController extends Controller
{
    public function index()
    {
        $data = Tpermohonan::orderBy('id', 'DESC')->paginate(15);
        return view('admin.permohonan.index', compact('data'));
    }
}
