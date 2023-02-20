<?php

namespace App\Http\Controllers;

use App\Models\BatasInput;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminBatasInputController extends Controller
{
    public function index()
    {
        $data = BatasInput::where('skpd_id', Auth::user()->skpd->id)->get();
        return view('admin.batasinput.index', compact('data'));
    }

    public function create()
    {
        return view('admin.batasinput.create');
    }

    public function store(Request $req)
    {

        $check = BatasInput::where('tahun', $req->tahun)->where('skpd_id', Auth::user()->skpd->id)->first();
        if ($check == null) {
            $param = $req->all();
            $param['skpd_id'] = Auth::user()->skpd->id;
            BatasInput::create($param);
            Session::flash('success', 'Berhasil Di Simpan');
            return redirect('/admin/batas_input');
        } else {
            Session::flash('error', 'Tahun Sudah ada');
            return back();
        }
    }
    public function edit($id)
    {
        $data = BatasInput::find($id);
        return view('admin.batasinput.edit', compact('data'));
    }

    public function update(Request $req, $id)
    {
        BatasInput::find($id)->update($req->all());
        Session::flash('success', 'Berhasil Di Update');
        return redirect('/admin/batas_input');
    }
    public function delete($id)
    {
        $data = BatasInput::find($id)->delete();
        Session::flash('success', 'Berhasil Di Hapus');
        return back();
    }
}
