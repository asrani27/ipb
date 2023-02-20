<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Program;
use App\Models\Subkegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BidangKirimController extends Controller
{
    public function index()
    {
        $tahun = Carbon::now()->format('Y');
        $data = Subkegiatan::where('bidang_id', Auth::user()->bidang->id)->where('tahun', $tahun)->get();
        $program = Program::where('bidang_id', Auth::user()->bidang->id)->get();
        return view('bidang.kirim.index', compact('data', 'program'));
    }

    public function kirimAngkas($id)
    {
        Subkegiatan::find($id)->update(['kirim_angkas' => 1]);
        Session::flash('success', 'Berhasil Di Kirim');
        return back();
    }
}
