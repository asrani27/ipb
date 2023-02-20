<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\Subkegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function laporan($tahun)
    {
        $bidang = Bidang::count();
        $program = Program::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->count();
        $subkegiatan = Subkegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->count();

        $data = Subkegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->get();
        return view('admin.laporan.laporanrfk', compact('bidang', 'program', 'subkegiatan', 'data'));
    }
}
