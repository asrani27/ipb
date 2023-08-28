<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\M_kegiatan;
use App\Models\M_program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminKegiatanController extends Controller
{
    public function index()
    {
        $data = M_kegiatan::where('skpd_id', Auth::user()->skpd->id)->orderBy('id', 'DESC')->paginate(15);
        return view('admin.kegiatan.index', compact('data'));
    }

    public function create()
    {
        $program = M_program::where('skpd_id', Auth::user()->skpd->id)->get();
        return view('admin.kegiatan.create', compact('program'));
    }

    public function store(Request $req)
    {
        $n = new M_kegiatan();
        $n->tahun = M_program::find($req->program_id)->tahun;
        $n->m_program_id = $req->program_id;
        $n->kode = $req->kode;
        $n->nama = $req->nama;
        $n->skpd_id = Auth::user()->skpd->id;
        $n->save();

        Session::flash('success', 'Berhasil Di Simpan');
        return redirect('/admin/kegiatan');
    }

    public function edit($id)
    {
        $data = M_kegiatan::find($id);
        $program = M_program::where('skpd_id', Auth::user()->skpd->id)->get();
        return view('admin.kegiatan.edit', compact('data', 'program'));
    }


    public function delete($id)
    {
        try {
            M_kegiatan::find($id)->delete();
            Session::flash('success', 'Berhasil Di Hapus');
            return back();
        } catch (\Exception $e) {
            Session::flash('error', 'Tidak bisa di hapus karena memiliki kegiatan');
            return back();
        }
    }

    public function update(Request $req, $id)
    {
        $n = M_kegiatan::find($id);
        $n->m_program_id = $req->program_id;
        $n->kode = $req->kode;
        $n->nama = $req->nama;
        $n->save();

        Session::flash('success', 'Berhasil Di Update');
        return redirect('/admin/kegiatan');
    }
}
