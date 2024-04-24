<?php

namespace App\Http\Controllers;

use App\Models\Bagian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminBagianController extends Controller
{
    public function index()
    {
        $data = Bagian::where('skpd_id', Auth::user()->skpd->id)->get();
        return view('admin.bagian.index', compact('data'));
    }

    public function create()
    {
        return view('admin.bagian.create');
    }

    public function store(Request $req)
    {
        $n = new Bagian;
        $n->nama = $req->nama;
        $n->skpd_id = Auth::user()->skpd->id;
        $n->save();

        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/admin/bagian');
    }

    public function edit($id)
    {
        $data = Bagian::find($id);
        return view('admin.bagian.edit', compact('data'));
    }

    public function resetpass($id)
    {
        Bagian::find($id)->user->update([
            'password' => bcrypt('123456'),
        ]);
        Session::flash('success', 'Password Baru : 123456');
        return back();
    }
    public function delete($id)
    {
        try {
            Bagian::find($id)->delete();
            Session::flash('success', 'berhasil di hapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena memiliki Data terkait');
            return back();
        }
    }

    public function update(Request $req, $id)
    {
        $n = Bagian::find($id);
        $n->nama = $req->nama;
        $n->save();

        Session::flash('success', 'berhasil di update');
        return redirect('/admin/bagian');
    }
}
