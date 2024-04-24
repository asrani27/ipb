<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminKelurahanController extends Controller
{
    public function index()
    {
        $data = Kelurahan::where('skpd_id', Auth::user()->skpd->id)->get();
        return view('admin.kelurahan.index', compact('data'));
    }

    public function create()
    {
        return view('admin.kelurahan.create');
    }

    public function store(Request $req)
    {
        $n = new Kelurahan;
        $n->nama = $req->nama;
        $n->skpd_id = Auth::user()->skpd->id;
        $n->save();

        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/admin/kelurahan');
    }

    public function edit($id)
    {
        $data = Kelurahan::find($id);
        return view('admin.kelurahan.edit', compact('data'));
    }

    public function resetpass($id)
    {
        Kelurahan::find($id)->user->update([
            'password' => bcrypt('123456'),
        ]);
        Session::flash('success', 'Password Baru : 123456');
        return back();
    }
    public function delete($id)
    {
        try {
            Kelurahan::find($id)->delete();
            Session::flash('success', 'berhasil di hapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena memiliki Data terkait');
            return back();
        }
    }

    public function update(Request $req, $id)
    {
        $n = Kelurahan::find($id);
        $n->nama = $req->nama;
        $n->save();

        Session::flash('success', 'berhasil di update');
        return redirect('/admin/kelurahan');
    }
}
