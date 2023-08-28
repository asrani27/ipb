<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_subkegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminSubKegiatanController extends Controller
{
    public function index()
    {
        $data = M_subkegiatan::where('skpd_id', Auth::user()->skpd->id)->orderBy('id', 'DESC')->paginate(15);
        return view('admin.subkegiatan.index', compact('data'));
    }
    public function edit($id)
    {
        $data = M_subkegiatan::find($id);
        return view('admin.subkegiatan.edit', compact('data'));
    }

    public function update(Request $req, $id)
    {
        $n = M_subkegiatan::find($id);
        $n->kode = $req->kode;
        $n->nama = $req->nama;
        $n->save();

        Session::flash('success', 'Berhasil Di Update');
        return redirect('/admin/subkegiatan');
    }
}
