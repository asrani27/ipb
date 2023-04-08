<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BidangKegiatanController extends Controller
{
    public function index($id)
    {
        $data = Kegiatan::where('program_id', $id)->where('jenis_rfk', 'murni')->orderBy('id', 'DESC')->paginate(15);
        $program = Program::find($id);
        return view('bidang.kegiatan.index', compact('data', 'program'));
    }

    public function create($id)
    {
        $program = Program::find($id);
        return view('bidang.kegiatan.create', compact('program'));
    }

    public function edit($program_id, $kegiatan_id)
    {
        $program = Program::find($program_id);
        $data = Kegiatan::find($kegiatan_id);
        return view('bidang.kegiatan.edit', compact('program', 'data'));
    }

    public function store(Request $req, $id)
    {
        $n = new Kegiatan;
        $n->program_id = $id;
        $n->nama = $req->nama;
        $n->bidang_id = Auth::user()->bidang->id;
        $n->skpd_id = Auth::user()->bidang->skpd->id;
        $n->tahun = $req->tahun;
        $n->jenis_rfk = 'murni';
        $n->save();
        Session::flash('success', 'Berhasil Di Simpan');
        return redirect('/bidang/program/kegiatan/' . $id);
    }

    public function update(Request $req, $program_id, $kegiatan_id)
    {
        $n = Kegiatan::find($kegiatan_id);
        $n->nama = $req->nama;
        $n->save();
        Session::flash('success', 'Berhasil Di Update');
        return redirect('/bidang/program/kegiatan/' . $program_id);
    }
    public function delete($program_id, $kegiatan_id)
    {
        try {
            Kegiatan::find($kegiatan_id)->delete();
            Session::flash('success', 'Berhasil Di Hapus');
            return back();
        } catch (\Exception $e) {
            Session::flash('error', 'Tidak bisa di hapus karena memiliki Sub kegiatan');
            return back();
        }
    }
}
