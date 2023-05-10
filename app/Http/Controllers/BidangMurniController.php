<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BidangMurniController extends Controller
{
    public function subkegiatan()
    {
        $data = Subkegiatan::where('kegiatan_id', $kegiatan_id)->where('jenis_rfk', 'murni')->orderBy('id', 'DESC')->paginate(25);
        //dd($data);
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        //dd('d');
        return view('bidang.subkegiatan.index', compact('data', 'program', 'kegiatan', 'program_id', 'kegiatan_id'));
    }
}
