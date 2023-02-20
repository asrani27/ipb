<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Program;
use App\Models\BatasInput;
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
        $tahun = Carbon::now()->format('Y');

        $deadline = BatasInput::where('tahun', $tahun)->where('skpd_id', Auth::user()->bidang->skpd_id)->first();
        if ($deadline == null) {
            Session::flash('error', 'Batas Input Angkas Belum Dibuat oleh Admin SKPD');
        } else {
            if (Carbon::now()->format('Y-m-d') > $deadline->angkas) {
                Session::flash('error', 'Batas Input Angkas Sudah Lewat');
            } else {
                Subkegiatan::find($id)->update(['kirim_angkas' => 1]);
                Session::flash('success', 'Berhasil Disimpan');
            }
        }
        return back();
    }
}
