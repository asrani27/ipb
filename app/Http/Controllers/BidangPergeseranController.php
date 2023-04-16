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

class BidangPergeseranController extends Controller
{
    public function program()
    {
        if (statusRFK() == 'pergeseran') {
            $data = Program::where('bidang_id', Auth::user()->bidang->id)->where('jenis_rfk', 'pergeseran')->orderBy('id', 'DESC')->paginate(15);
            return view('pergeseran.program.index', compact('data'));
        } else {
            Session::flash('info', 'Pergeseran Belum Di Buka');
            return back();
        }
    }
    public function kegiatan($id)
    {
        $data = Kegiatan::where('program_id', $id)->where('jenis_rfk', 'pergeseran')->orderBy('id', 'DESC')->paginate(15);
        $program = Program::find($id);
        return view('pergeseran.kegiatan.index', compact('data', 'program'));
    }

    public function subkegiatan($program_id, $kegiatan_id)
    {
        $data = Subkegiatan::where('kegiatan_id', $kegiatan_id)->where('jenis_rfk', 'pergeseran')->orderBy('id', 'DESC')->paginate(25);
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        return view('pergeseran.subkegiatan.index', compact('data', 'program', 'kegiatan', 'program_id', 'kegiatan_id'));
    }
    public function createsubkegiatan($program_id, $kegiatan_id)
    {
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);

        return view('pergeseran.subkegiatan.create', compact('program', 'kegiatan', 'program_id', 'kegiatan_id'));
    }
    public function storesubkegiatan(Request $req, $program_id, $kegiatan_id)
    {
        $logLatest = LogBukaTutup::where('skpd_id', Auth::user()->bidang->skpd->id)->latest()->first();

        $n              = new Subkegiatan;
        $n->skpd_id     = Auth::user()->bidang->skpd_id;
        $n->bidang_id   = Auth::user()->bidang->id;
        $n->program_id  = $program_id;
        $n->tahun       = Program::find($program_id)->tahun;
        $n->kegiatan_id = $kegiatan_id;
        $n->nama        = $req->nama;
        $n->jenis_rfk   = 'pergeseran';
        $n->ke          = $logLatest->ke;

        $n->save();
        Session::flash('success', 'Sub Kegiatan Berhasil Disimpan');
        return redirect('/bidang/pergeseran/program/kegiatan/' . $program_id . '/sub/' . $kegiatan_id);
    }
    public function deletesubkegiatan($program_id, $kegiatan_id, $subkegiatan_id)
    {
        try {
            Subkegiatan::find($subkegiatan_id)->delete();
            Session::flash('success', 'Berhasil Di Hapus');
            return back();
        } catch (\Exception $e) {
            Session::flash('error', 'Tidak bisa di hapus karena memiliki Uraian kegiatan');
            return back();
        }
    }
    public function editsubkegiatan($program_id, $kegiatan_id, $subkegiatan_id)
    {
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $data = Subkegiatan::find($subkegiatan_id);
        return view('pergeseran.subkegiatan.edit', compact('program', 'data', 'kegiatan', 'program_id', 'kegiatan_id', 'subkegiatan_id'));
    }
    public function updatesubkegiatan(Request $req, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $n = Subkegiatan::find($subkegiatan_id);
        $n->nama = $req->nama;
        $n->save();
        Session::flash('success', 'Berhasil Di Update');
        return redirect('/bidang/pergeseran/program/kegiatan/' . $program_id . '/sub/' . $kegiatan_id);
    }

    public function uraian($program_id, $kegiatan_id, $subkegiatan_id)
    {
        $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('jenis_rfk', 'pergeseran')->orderBy('id', 'DESC')->get();

        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);
        return view('pergeseran.uraian.index', compact('data', 'program', 'kegiatan', 'subkegiatan', 'program_id', 'kegiatan_id', 'subkegiatan_id'));
        //}
    }
    public function createuraian($program_id, $kegiatan_id, $subkegiatan_id)
    {
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        $akun = M_akun::get();
        return view('pergeseran.uraian.create', compact('program', 'kegiatan', 'subkegiatan', 'program_id', 'kegiatan_id', 'subkegiatan_id', 'akun'));
    }

    public function edituraian($program_id, $kegiatan_id, $subkegiatan_id, $uraian_id)
    {
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);
        $data = Uraian::find($uraian_id);
        $akun = M_akun::get();
        return view('pergeseran.uraian.edit', compact('program', 'kegiatan', 'subkegiatan', 'program_id', 'kegiatan_id', 'subkegiatan_id', 'data', 'uraian_id', 'akun'));
    }

    public function storeuraian(Request $req, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $logLatest = LogBukaTutup::where('skpd_id', Auth::user()->bidang->skpd->id)->latest()->first();
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
        $n->jenis_rfk       = 'pergeseran';
        $n->ke              = $logLatest->kel;
        $n->dpa             = (int)str_replace(str_split('Rp.'), '', $req->dpa);
        $n->save();
        Session::flash('success', 'Berhasil Di Simpan');
        return redirect('/bidang/pergeseran/program/kegiatan/' . $program_id . '/sub/' . $kegiatan_id . '/uraian/' . $subkegiatan_id);
    }

    public function updateuraian(Request $req, $program_id, $kegiatan_id, $subkegiatan_id, $uraian_id)
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
        return redirect('/bidang/pergeseran/program/kegiatan/' . $program_id . '/sub/' . $kegiatan_id . '/uraian/' . $subkegiatan_id);
    }
    public function deleteuraian($program_id, $kegiatan_id, $subkegiatan_id, $uraian_id)
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
    public function createangkas($program_id, $kegiatan_id, $subkegiatan_id, $uraian_id)
    {
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);
        $uraian = Uraian::find($uraian_id);

        return view('pergeseran.angkas.create', compact('program', 'kegiatan', 'subkegiatan', 'program_id', 'kegiatan_id', 'subkegiatan_id', 'uraian', 'uraian_id'));
    }

    public function storeangkas(Request $req, $program_id, $kegiatan_id, $subkegiatan_id, $uraian_id)
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
        return redirect('/bidang/pergeseran/program/kegiatan/' . $program_id . '/sub/' . $kegiatan_id . '/uraian/' . $subkegiatan_id);
    }
}
