<?php

namespace App\Http\Controllers;

use App\Models\JenisRfk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPeriodeController extends Controller
{
    public function index()
    {
        $data = JenisRfk::where('skpd_id', Auth::user()->skpd->id)->get();
        return view('admin.perioderfk.index', compact('data'));
    }

    public function create()
    {
        return view('admin.perioderfk.create');
    }

    public function store(Request $req)
    {
        $check = JenisRfk::where('tahun', $req->tahun)->where('skpd_id', Auth::user()->skpd->id)->first();
        if ($check == null) {
            $param = $req->all();
            $param['skpd_id'] = Auth::user()->skpd->id;
            JenisRfk::create($param);
            Session::flash('success', 'Berhasil Di Simpan');
            return redirect('/admin/perioderfk');
        } else {
            Session::flash('error', 'Tahun Sudah ada');
            return back();
        }
    }
    public function edit($id)
    {
        $data = JenisRfk::find($id);
        return view('admin.perioderfk.edit', compact('data'));
    }

    public function update(Request $req, $id)
    {
        JenisRfk::find($id)->update($req->all());
        Session::flash('success', 'Berhasil Di Update');
        return redirect('/admin/perioderfk');
    }
    public function delete($id)
    {
        $data = JenisRfk::find($id)->delete();
        return back();
    }
}
