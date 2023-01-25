<?php

namespace App\Http\Controllers;

use App\Models\JenisRfk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SuperadminJenisrfkController extends Controller
{
    public function index()
    {
        $data = JenisRfk::get();
        return view('superadmin.jenis.index', compact('data'));
    }

    public function create()
    {
        return view('superadmin.jenis.create');
    }

    public function store(Request $req)
    {
        $check = JenisRfk::where('tahun', $req->tahun)->first();
        if ($check == null) {
            JenisRfk::create($req->all());
            Session::flash('success', 'Berhasil Di Simpan');
            return redirect('/superadmin/jenisrfk');
        } else {
            Session::flash('error', 'Tahun Sudah ada');
            return back();
        }
    }
    public function edit($id)
    {
        $data = JenisRfk::find($id);
        return view('superadmin.jenis.edit', compact('data'));
    }

    public function update(Request $req, $id)
    {
        JenisRfk::find($id)->update($req->all());
        Session::flash('success', 'Berhasil Di Update');
        return redirect('/superadmin/jenisrfk');
    }
    public function delete($id)
    {
        $data = JenisRfk::find($id)->delete();
        return view('superadmin.jenis.edit', compact('data'));
    }
}
