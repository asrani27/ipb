<?php

namespace App\Http\Controllers;

use App\Models\Tkrk;
use PDF;
use App\Models\Tpermohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TkrkController extends Controller
{
    public function create($id)
    {
        $data = Tpermohonan::find($id);
        return view('pemohon.krk_kkpr.create', compact('data', 'id'));
    }

    public function store(Request $req, $id)
    {
        $attr = $req->all();
        $attr['t_permohonan_id'] = $id;

        Tkrk::create($attr);
        Session::flash('success', 'Pengajuan KRK/KKPR berhasil Di Simpan');
        return redirect('/pemohon/' . $id . '/berkas');
    }

    public function edit($id, $krk_id)
    {
        $data = Tpermohonan::find($id);
        $krk  = Tkrk::find($krk_id);
        return view('pemohon.krk_kkpr.edit', compact('data', 'id', 'krk', 'krk_id'));
    }

    public function update(Request $req, $id, $krk_id)
    {
        $attr = $req->all();
        $attr['t_permohonan_id'] = $id;

        Tkrk::find($krk_id)->update($attr);
        Session::flash('success', 'Pengajuan KRK/KKPR berhasil Di Update');
        return redirect('/pemohon/' . $id . '/berkas');
    }

    public function pdf($id, $krk_id)
    {
        $data = Tkrk::find($krk_id);
        if ($data->status == 0) {
            Session::flash('error', 'Status Masih di proses belum bisa di print');
            return back();
        } else {

            $pdf = PDF::loadView('admin.krk.pdf', compact('data'))->setPaper('legal');
            return $pdf->stream();
        }
    }
}
