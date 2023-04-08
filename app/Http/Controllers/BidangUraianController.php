<?php

namespace App\Http\Controllers;

use App\Models\Uraian;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\Subkegiatan;
use App\Models\LogBukaTutup;
use App\Models\M_akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BidangUraianController extends Controller
{
    public function uraianMurni($subkegiatan_id)
    {
        $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('jenis_rfk', 'murni')->orderBy('id', 'DESC')->get();
        return $data;
    }
    public function index($program_id, $kegiatan_id, $subkegiatan_id)
    {

        $data = $this->uraianMurni($subkegiatan_id);

        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);
        return view('bidang.uraian.index', compact('data', 'program', 'kegiatan', 'subkegiatan', 'program_id', 'kegiatan_id', 'subkegiatan_id'));
        //}
    }

    public function create($program_id, $kegiatan_id, $subkegiatan_id)
    {
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        $akun = M_akun::get();
        return view('bidang.uraian.create', compact('program', 'kegiatan', 'subkegiatan', 'program_id', 'kegiatan_id', 'subkegiatan_id', 'akun'));
    }

    public function edit($program_id, $kegiatan_id, $subkegiatan_id, $uraian_id)
    {
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);
        $data = Uraian::find($uraian_id);
        $akun = M_akun::get();
        return view('bidang.uraian.edit', compact('program', 'kegiatan', 'subkegiatan', 'program_id', 'kegiatan_id', 'subkegiatan_id', 'data', 'uraian_id', 'akun'));
    }

    public function store(Request $req, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $rekening_belanja   = M_akun::find($req->kode_akun);

        $n                  = new Uraian;
        $n->skpd_id         = Auth::user()->bidang->skpd_id;
        $n->bidang_id       = Auth::user()->bidang->id;
        $n->program_id      = $program_id;
        $n->tahun           = Program::find($program_id)->tahun;
        $n->kegiatan_id     = $kegiatan_id;
        $n->subkegiatan_id  = $subkegiatan_id;
        $n->m_akun_id       = $rekening_belanja->id;
        $n->kode_rekening   = $rekening_belanja->kode_akun;
        $n->nama            = $rekening_belanja->nama_akun;
        $n->keterangan      = $req->keterangan;
        $n->jenis_rfk       = 'murni';
        $n->dpa             = (int)str_replace(str_split('Rp.'), '', $req->dpa);
        $n->save();
        Session::flash('success', 'Berhasil Di Simpan');
        return redirect('/bidang/program/kegiatan/' . $program_id . '/sub/' . $kegiatan_id . '/uraian/' . $subkegiatan_id);
    }

    public function update(Request $req, $program_id, $kegiatan_id, $subkegiatan_id, $uraian_id)
    {
        $rekening_belanja   = M_akun::find($req->kode_akun);
        $n = Uraian::find($uraian_id);
        $n->m_akun_id       = $rekening_belanja->id;
        $n->kode_rekening   = $rekening_belanja->kode_akun;
        $n->nama            = $rekening_belanja->nama_akun;
        $n->keterangan      = $req->keterangan;
        $n->dpa = (int)str_replace(str_split('Rp.'), '', $req->dpa);
        $n->save();
        Session::flash('success', 'Berhasil Di Update');
        return redirect('/bidang/program/kegiatan/' . $program_id . '/sub/' . $kegiatan_id . '/uraian/' . $subkegiatan_id);
    }
    public function delete($program_id, $kegiatan_id, $subkegiatan_id, $uraian_id)
    {
        try {
            Uraian::find($uraian_id)->delete();
            Session::flash('success', 'Berhasil Di Hapus');
            return back();
        } catch (\Exception $e) {
            Session::flash('error', 'Tidak dapat di hapus');
            return back();
        }
    }
}
