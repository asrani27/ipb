<?php

namespace App\Http\Controllers;

use App\Models\M_program;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminProgramController extends Controller
{
    public function index()
    {
        $data = M_program::where('skpd_id', Auth::user()->skpd->id)->orderBy('id', 'DESC')->paginate(15);
        return view('admin.program.index', compact('data'));
    }

    public function create()
    {
        return view('admin.program.create');
    }

    public function store(Request $req)
    {
        $n = new M_program;
        $n->tahun = $req->tahun;
        $n->nama = $req->nama;
        $n->kode = $req->kode;
        $n->skpd_id = Auth::user()->skpd->id;
        //$n->jenis_rfk = 'murni';
        $n->save();

        Session::flash('success', 'Berhasil Di Simpan');
        return redirect('/admin/program');
    }

    public function edit($id)
    {
        $data = M_program::find($id);
        return view('admin.program.edit', compact('data'));
    }


    public function delete($id)
    {
        try {
            M_program::find($id)->delete();
            Session::flash('success', 'Berhasil Di Hapus');
            return back();
        } catch (\Exception $e) {
            Session::flash('error', 'Tidak bisa di hapus karena memiliki kegiatan');
            return back();
        }
    }

    public function update(Request $req, $id)
    {
        //dd($req->all());
        $n = M_program::find($id);
        $n->tahun = $req->tahun;
        $n->kode = $req->kode;
        $n->nama = $req->nama;
        $n->save();

        Session::flash('success', 'Berhasil Di Update');
        return redirect('/admin/program');
    }
}
