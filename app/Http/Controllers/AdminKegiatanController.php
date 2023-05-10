<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminKegiatanController extends Controller
{
    public function index()
    {
        if (statusRFK() == 'murni') {
            $data = Kegiatan::where('skpd_id', Auth::user()->skpd->id)->orderBy('id', 'DESC')->paginate(15);
            return view('admin.kegiatan.index', compact('data'));
        } else {
            Session::flash('info', 'Murni Belum Di Buka / Atau Telah Di Tutup');
            return back();
        }
    }

    public function create()
    {
        $program = Program::where('skpd_id', Auth::user()->skpd->id)->get();
        return view('admin.kegiatan.create', compact('program'));
    }

    public function store(Request $req)
    {
        $n = new Kegiatan;
        $n->tahun = Program::find($req->program_id)->tahun;
        $n->program_id = $req->program_id;
        $n->nama = $req->nama;
        $n->skpd_id = Auth::user()->skpd->id;
        $n->save();

        Session::flash('success', 'Berhasil Di Simpan');
        return redirect('/admin/kegiatan');
    }

    public function edit($id)
    {
        $data = Kegiatan::find($id);
        $program = Program::where('skpd_id', Auth::user()->skpd->id)->get();
        return view('admin.kegiatan.edit', compact('data', 'program'));
    }


    public function delete($id)
    {
        try {
            Kegiatan::find($id)->delete();
            Session::flash('success', 'Berhasil Di Hapus');
            return back();
        } catch (\Exception $e) {
            Session::flash('error', 'Tidak bisa di hapus karena memiliki kegiatan');
            return back();
        }
    }

    public function update(Request $req, $id)
    {
        $n = Kegiatan::find($id);
        $n->program_id = $req->program_id;
        $n->nama = $req->nama;
        $n->save();

        Session::flash('success', 'Berhasil Di Update');
        return redirect('/admin/kegiatan');
    }
}
