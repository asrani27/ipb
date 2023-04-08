<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BidangProgramController extends Controller
{
    public function index()
    {
        if (statusRFK() == 'murni') {
            $data = Program::where('bidang_id', Auth::user()->bidang->id)->where('jenis_rfk', 'murni')->orderBy('id', 'DESC')->paginate(15);
            return view('bidang.program.index', compact('data'));
        } else {
            Session::flash('info', 'Murni Belum Di Buka / Atau Telah Di Tutup');
            return back();
        }
    }

    public function create()
    {
        return view('bidang.program.create');
    }

    public function store(Request $req)
    {
        $n = new Program;
        $n->tahun = $req->tahun;
        $n->nama = $req->nama;
        $n->bidang_id = Auth::user()->bidang->id;
        $n->skpd_id = Auth::user()->bidang->skpd->id;
        $n->jenis_rfk = 'murni';
        $n->save();

        Session::flash('success', 'Berhasil Di Simpan');
        return redirect('/bidang/program');
    }

    public function edit($id)
    {
        $data = Program::find($id);
        return view('bidang.program.edit', compact('data'));
    }


    public function delete($id)
    {
        try {
            Program::find($id)->delete();
            Session::flash('success', 'Berhasil Di Hapus');
            return back();
        } catch (\Exception $e) {
            Session::flash('error', 'Tidak bisa di hapus karena memiliki kegiatan');
            return back();
        }
    }

    public function update(Request $req, $id)
    {
        $n = Program::find($id);
        $n->tahun = $req->tahun;
        $n->nama = $req->nama;
        $n->save();

        Session::flash('success', 'Berhasil Di Update');
        return redirect('/bidang/program');
    }
}
