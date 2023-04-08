<?php

namespace App\Http\Controllers;

use App\Models\M_akun;
use App\Models\Uraian;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\Subkegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BidangBerandaController extends Controller
{
    public function sortir()
    {
        $bidang_id = Auth::user()->bidang->id;
        $data = Uraian::where('bidang_id', $bidang_id)->get();
        $data->map(function ($item) {
            $check = M_akun::where('kode_akun', $item->kode_rekening)->first();

            if ($check == null) {
            } else {
                $item->m_akun_id = $check->id;
                $item->save();
            }
            return $item;
        });

        Session::flash('success', 'Berhasil Di Sortir');
        return redirect('/bidang/beranda/uraian');
    }
    public function index()
    {
        //status rfk
        $status = statusRFK();
        $result = $status;
        $data = null;

        $t_program = Program::where('bidang_id', Auth::user()->bidang->id)->count();
        $t_kegiatan = Kegiatan::where('bidang_id', Auth::user()->bidang->id)->count();
        $t_subkegiatan = Subkegiatan::where('bidang_id', Auth::user()->bidang->id)->where('tahun', \Carbon\Carbon::today()->format('Y'))->count();
        $t_uraian = Uraian::where('bidang_id', Auth::user()->bidang->id)->where('jenis_rfk', $result)->where('tahun', \Carbon\Carbon::today()->format('Y'))->count();

        $subkegiatan = Subkegiatan::where('bidang_id', Auth::user()->bidang->id)->where('tahun', \Carbon\Carbon::today()->format('Y'))->get();

        $subkegiatan->map(function ($item) use ($result) {
            $item->uraian = $item->uraian->where('jenis_rfk', $result);
            $item->totalsubkegiatan = $item->uraian->where('jenis_rfk', $result)->sum('dpa');
            return $item;
        });

        return view('bidang.home', compact('data', 't_program', 't_kegiatan', 't_subkegiatan', 't_uraian', 'subkegiatan'));
    }

    public function uraian()
    {
        //status rfk
        $status = statusRFK();
        $result = $status;

        $data = null;

        $t_program = Program::where('bidang_id', Auth::user()->bidang->id)->count();
        $t_kegiatan = Kegiatan::where('bidang_id', Auth::user()->bidang->id)->count();
        $t_subkegiatan = Subkegiatan::where('bidang_id', Auth::user()->bidang->id)->where('tahun', \Carbon\Carbon::today()->format('Y'))->count();
        $t_uraian = Uraian::where('bidang_id', Auth::user()->bidang->id)->where('jenis_rfk', $result)->where('tahun', \Carbon\Carbon::today()->format('Y'))->count();


        $uraian = Uraian::where('bidang_id', Auth::user()->bidang->id)->where('jenis_rfk', $result)->where('tahun', \Carbon\Carbon::today()->format('Y'))->orderBy('m_akun_id', 'ASC')->get();
        $uraian->map(function ($item) {
            $item->angkas = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan + $item->p_juli_keuangan + $item->p_agustus_keuangan + $item->p_september_keuangan + $item->p_oktober_keuangan + $item->p_november_keuangan + $item->p_desember_keuangan;
            return $item;
        });
        return view('bidang.home_uraian', compact('data', 't_program', 't_kegiatan', 't_subkegiatan', 't_uraian', 'uraian'));
    }

    public function angkas($id)
    {
        $uraian = Uraian::find($id);

        return redirect('/bidang/program/angkas/' . $uraian->program_id . '/' . $uraian->kegiatan_id . '/' . $uraian->subkegiatan_id . '/' . $uraian->id);
    }

    public function realisasi($id)
    {
        $subkegiatan = Subkegiatan::find($id);
        return redirect('/bidang/realisasi/' . $subkegiatan->tahun . '/' . $subkegiatan->program_id . '/' . $subkegiatan->kegiatan_id . '/' . $subkegiatan->id);
    }
}
