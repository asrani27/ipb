<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Subkegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PPTKMurniController extends Controller
{
    public function subkegiatan()
    {
        $data = Subkegiatan::where('pptk_id', Auth::user()->pptk->id)->get();

        return view('pptk.murni.subkegiatan.index', compact('data'));
    }
    public function addsubkegiatan()
    {
        $kegiatan = Kegiatan::where('skpd_id', Auth::user()->pptk->skpd_id)->get();
        return view('pptk.murni.subkegiatan.create', compact('kegiatan'));
    }
    public function storesubkegiatan(Request $req)
    {
        $kegiatan = Kegiatan::where('skpd_id', Auth::user()->pptk->skpd_id)->get();
        return view('pptk.murni.subkegiatan.create', compact('kegiatan'));
    }
}
