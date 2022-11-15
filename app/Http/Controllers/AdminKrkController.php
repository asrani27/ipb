<?php

namespace App\Http\Controllers;

use App\Models\Tkrk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PDF;

class AdminKrkController extends Controller
{
    public function index()
    {
        $data = Tkrk::orderBy('status', 'ASC')->paginate(15);
        return view('admin.krk.index', compact('data'));
    }

    public function verifikasi($id)
    {
        $krk = Tkrk::find($id);
        return view('admin.krk.verifikasi', compact('krk', 'id'));
    }

    public function edit($id)
    {
        $krk = Tkrk::find($id);
        return view('admin.krk.edit', compact('krk', 'id'));
    }

    public function update(Request $req, $id)
    {
        Tkrk::find($id)->update($req->all());
        Session::flash('success', 'Berhasil Di Update');
        return redirect('/superadmin/krk');
    }
    public function unverifikasi($id)
    {
        Tkrk::find($id)->update(['status' => 0]);
        Session::flash('success', 'Verifikasi Di Batalkan');
        return back();
    }
    public function verified(Request $req, $id)
    {
        Tkrk::find($id)->update(['status' => 1]);
        Session::flash('success', 'Permohonan Telah Di Verifikasi');
        return redirect('/superadmin/krk');
    }

    public function delete($krk_id)
    {
        Tkrk::find($krk_id)->delete();
        Session::flash('success', 'Pengajuan KRK/KKPR berhasil Di Hapus');
        return back();
    }

    public function pdf($id)
    {
        $data = Tkrk::find($id);
        $pdf = PDF::loadView('admin.krk.pdf', compact('data'))->setPaper('legal');
        return $pdf->stream();
    }
}
