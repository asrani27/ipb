<?php

namespace App\Http\Controllers;

use App\Models\Uraian;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\Subkegiatan;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Double;
use Illuminate\Support\Facades\Session;

class BidangAngkasController extends Controller
{
    public function create($program_id, $kegiatan_id, $subkegiatan_id, $uraian_id)
    {
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);
        $uraian = Uraian::find($uraian_id);

        return view('bidang.angkas.create', compact('program', 'kegiatan', 'subkegiatan', 'program_id', 'kegiatan_id', 'subkegiatan_id', 'uraian', 'uraian_id'));
    }

    public function store(Request $req, $program_id, $kegiatan_id, $subkegiatan_id, $uraian_id)
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
        return redirect('/bidang/program/kegiatan/' . $program_id . '/sub/' . $kegiatan_id . '/uraian/' . $subkegiatan_id);
    }
}
