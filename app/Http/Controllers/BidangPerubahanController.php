<?php

namespace App\Http\Controllers;

use App\Models\Uraian;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\Subkegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BidangPerubahanController extends Controller
{
    public function program()
    {
        Session::flash('info', 'Fix kan Modul Murni Terlebih Dahulu');
        return back();

        $data = Program::where('bidang_id', Auth::user()->bidang->id)->orderBy('id', 'DESC')->paginate(30);
        return view('bidang.perubahan.program', compact('data'));
    }

    public function kegiatan($program_id)
    {
        $data = Kegiatan::where('program_id', $program_id)->orderBy('id', 'DESC')->paginate(30);
        $program = Program::find($program_id);
        return view('bidang.perubahan.kegiatan', compact('data', 'program'));
    }
    public function subKegiatan($program_id, $kegiatan_id)
    {
        $data = Subkegiatan::where('kegiatan_id', $kegiatan_id)->orderBy('id', 'DESC')->paginate(30);
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        return view('bidang.perubahan.subkegiatan', compact('data', 'program', 'kegiatan', 'program_id', 'kegiatan_id'));
    }

    public function uraian($program_id, $kegiatan_id, $subkegiatan_id)
    {
        $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('status', 99)->orderBy('id', 'DESC')->get();

        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);
        return view('bidang.perubahan.uraian', compact('data', 'program', 'kegiatan', 'subkegiatan', 'program_id', 'kegiatan_id', 'subkegiatan_id'));
    }
    public function editUraian($program_id, $kegiatan_id, $subkegiatan_id, $uraian_id)
    {
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);
        $data = Uraian::find($uraian_id);
        return view('bidang.perubahan.edit_uraian', compact('program', 'kegiatan', 'subkegiatan', 'program_id', 'kegiatan_id', 'subkegiatan_id', 'data', 'uraian_id'));
    }
    public function updateUraian(Request $req, $program_id, $kegiatan_id, $subkegiatan_id, $uraian_id)
    {
        $newdpa = (int)str_replace(str_split('Rp.'), '', $req->dpa);
        $n = Uraian::find($uraian_id);

        $n->kode_rekening = $req->kode_rekening;
        $n->nama = $req->nama;
        $n->dpa = $newdpa;
        $n->p_januari_fisik     = ($n->p_januari_keuangan / $newdpa) * 100;
        $n->p_februari_fisik    = ($n->p_februari_keuangan / $newdpa) * 100;
        $n->p_maret_fisik       = ($n->p_maret_keuangan / $newdpa) * 100;
        $n->p_april_fisik       = ($n->p_april_keuangan / $newdpa) * 100;
        $n->p_mei_fisik         = ($n->p_mei_keuangan / $newdpa) * 100;
        $n->p_juni_fisik        = ($n->p_juni_keuangan / $newdpa) * 100;
        $n->p_juli_fisik        = ($n->p_juli_keuangan / $newdpa) * 100;
        $n->p_agustus_fisik     = ($n->p_agustus_keuangan / $newdpa) * 100;
        $n->p_september_fisik   = ($n->p_september_keuangan / $newdpa) * 100;
        $n->p_oktober_fisik     = ($n->p_oktober_keuangan / $newdpa) * 100;
        $n->p_november_fisik    = ($n->p_november_keuangan / $newdpa) * 100;
        $n->p_desember_fisik    = ($n->p_desember_keuangan / $newdpa) * 100;

        $n->save();
        Session::flash('success', 'Berhasil Di Update');
        return redirect('/bidang/perubahan/program/kegiatan/' . $program_id . '/sub/' . $kegiatan_id . '/uraian/' . $subkegiatan_id);
    }
    public function editDPA($program_id, $kegiatan_id, $subkegiatan_id, $uraian_id)
    {
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);
        $uraian = Uraian::find($uraian_id);

        return view('bidang.perubahan.edit_angkas', compact('program', 'kegiatan', 'subkegiatan', 'program_id', 'kegiatan_id', 'subkegiatan_id', 'uraian', 'uraian_id'));
    }

    public function updateDPA(Request $req, $program_id, $kegiatan_id, $subkegiatan_id, $uraian_id)
    {
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);
        $uraian = Uraian::find($uraian_id);

        $jan_keuangan = (int)str_replace(str_split('.'), '', $req->januari_keuangan);
        $feb_keuangan = (int)str_replace(str_split('.'), '', $req->februari_keuangan);
        $mar_keuangan = (int)str_replace(str_split('.'), '', $req->maret_keuangan);
        $apr_keuangan = (int)str_replace(str_split('.'), '', $req->april_keuangan);
        $mei_keuangan = (int)str_replace(str_split('.'), '', $req->mei_keuangan);
        $jun_keuangan = (int)str_replace(str_split('.'), '', $req->juni_keuangan);
        $jul_keuangan = (int)str_replace(str_split('.'), '', $req->juli_keuangan);
        $agu_keuangan = (int)str_replace(str_split('.'), '', $req->agustus_keuangan);
        $sep_keuangan = (int)str_replace(str_split('.'), '', $req->september_keuangan);
        $okt_keuangan = (int)str_replace(str_split('.'), '', $req->oktober_keuangan);
        $nov_keuangan = (int)str_replace(str_split('.'), '', $req->november_keuangan);
        $des_keuangan = (int)str_replace(str_split('.'), '', $req->desember_keuangan);
        $keuangan = $jan_keuangan + $feb_keuangan + $mar_keuangan + $apr_keuangan + $mei_keuangan + $jun_keuangan + $jul_keuangan + $agu_keuangan + $sep_keuangan + $okt_keuangan + $nov_keuangan + $des_keuangan;

        $jan_fisik = (float)str_replace(str_split(','), '.', $req->januari_fisik);
        $feb_fisik = (float)str_replace(str_split(','), '.', $req->februari_fisik);
        $mar_fisik = (float)str_replace(str_split(','), '.', $req->maret_fisik);
        $apr_fisik = (float)str_replace(str_split(','), '.', $req->april_fisik);
        $mei_fisik = (float)str_replace(str_split(','), '.', $req->mei_fisik);
        $jun_fisik = (float)str_replace(str_split(','), '.', $req->juni_fisik);
        $jul_fisik = (float)str_replace(str_split(','), '.', $req->juli_fisik);
        $agu_fisik = (float)str_replace(str_split(','), '.', $req->agustus_fisik);
        $sep_fisik = (float)str_replace(str_split(','), '.', $req->september_fisik);
        $okt_fisik = (float)str_replace(str_split(','), '.', $req->oktober_fisik);
        $nov_fisik = (float)str_replace(str_split(','), '.', $req->november_fisik);
        $des_fisik = (float)str_replace(str_split(','), '.', $req->desember_fisik);
        $fisik = $jan_fisik + $feb_fisik + $mar_fisik + $apr_fisik + $mei_fisik + $jun_fisik + $jul_fisik + $agu_fisik + $sep_fisik + $okt_fisik + $nov_fisik + $des_fisik;

        //dd($keuangan, $fisik, $req->all());
        //dd($fisik, $jan_fisik, $feb_fisik, $mar_fisik, $apr_fisik, $mei_fisik, $jun_fisik, $jul_fisik, $agu_fisik,$sep_fisik,$okt_fisik,$nov_fisik,$des_fisik);
        if ($keuangan != $uraian->dpa) {
            Session::flash('info', 'SISA DPA HARUS 0');

            $req->flash();
            return back();
        }

        // if ((int)$fisik != 100) {
        //     toastr()->error('Jumlah Fisik: ' . $fisik . '%, Tidak 100%, Harap Ulangi');
        //     $req->flash();
        //     return back();
        // }

        $u = $uraian;
        $u->p_januari_keuangan     = $jan_keuangan;
        $u->p_februari_keuangan    = $feb_keuangan;
        $u->p_maret_keuangan       = $mar_keuangan;
        $u->p_april_keuangan       = $apr_keuangan;
        $u->p_mei_keuangan         = $mei_keuangan;
        $u->p_juni_keuangan        = $jun_keuangan;
        $u->p_juli_keuangan        = $jul_keuangan;
        $u->p_agustus_keuangan     = $agu_keuangan;
        $u->p_september_keuangan   = $sep_keuangan;
        $u->p_oktober_keuangan     = $okt_keuangan;
        $u->p_november_keuangan    = $nov_keuangan;
        $u->p_desember_keuangan    = $des_keuangan;

        $u->p_januari_fisik     = $jan_fisik;
        $u->p_februari_fisik    = $feb_fisik;
        $u->p_maret_fisik       = $mar_fisik;
        $u->p_april_fisik       = $apr_fisik;
        $u->p_mei_fisik         = $mei_fisik;
        $u->p_juni_fisik        = $jun_fisik;
        $u->p_juli_fisik        = $jul_fisik;
        $u->p_agustus_fisik     = $agu_fisik;
        $u->p_september_fisik   = $sep_fisik;
        $u->p_oktober_fisik     = $okt_fisik;
        $u->p_november_fisik    = $nov_fisik;
        $u->p_desember_fisik    = $des_fisik;
        $u->save();

        Session::flash('success', 'Berhasil Di Simpan');
        return redirect('/bidang/perubahan/program/kegiatan/' . $program_id . '/sub/' . $kegiatan_id . '/uraian/' . $subkegiatan_id);
    }

    public function addUraian($program_id, $kegiatan_id, $subkegiatan_id)
    {
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        return view('bidang.perubahan.create_uraian', compact('program', 'kegiatan', 'subkegiatan', 'program_id', 'kegiatan_id', 'subkegiatan_id'));
    }

    public function storeUraian(Request $req, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $n                  = new Uraian;
        $n->skpd_id         = Auth::user()->bidang->skpd_id;
        $n->bidang_id       = Auth::user()->bidang->id;
        $n->program_id      = $program_id;
        $n->tahun           = Program::find($program_id)->tahun;
        $n->kegiatan_id     = $kegiatan_id;
        $n->subkegiatan_id  = $subkegiatan_id;
        $n->kode_rekening   = $req->kode_rekening;
        $n->nama            = $req->nama;
        $n->dpa             = (int)str_replace(str_split('Rp.'), '', $req->dpa);
        $n->status            = 99;
        $n->save();
        Session::flash('success', 'Berhasil Di Simpan');
        return redirect('/bidang/perubahan/program/kegiatan/' . $program_id . '/sub/' . $kegiatan_id . '/uraian/' . $subkegiatan_id);
    }
}
