<?php

namespace App\Http\Controllers;

use App\Models\Tpermohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TpermohonanController extends Controller
{
    public function store(Request $req)
    {
        $attr = $req->all();
        $attr['pemohon_id'] = Auth::user()->pemohon->id;
        Tpermohonan::create($attr);
        Session::flash('success', 'Berhasil Di Simpan');
        return redirect('/pemohon');
    }
    public function update(Request $req)
    {
        $u = Tpermohonan::find($req->permohonan_id);
        $u->update($req->all());
        Session::flash('success', 'Berhasil Di Update');
        return redirect('/pemohon');
    }

    public function berkas($id)
    {
        $data = Tpermohonan::find($id);

        return view('pemohon.berkas.index', compact('data', 'id'));
    }
}
