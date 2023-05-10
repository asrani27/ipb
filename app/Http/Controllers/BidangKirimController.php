<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Program;
use App\Models\BatasInput;
use App\Models\Subkegiatan;
use App\Models\Uraian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BidangKirimController extends Controller
{
    public function index()
    {
        $tahun = Carbon::now()->format('Y');
        $data = Subkegiatan::where('bidang_id', Auth::user()->bidang->id)->where('tahun', $tahun)->get();
        $program = Program::where('bidang_id', Auth::user()->bidang->id)->get();
        return view('bidang.kirim.index', compact('data', 'program'));
    }

    public function kirimAngkas($id)
    {
        $tahun = Carbon::now()->format('Y');
        $status_rfk = statusRFK();
        $deadline = BatasInput::where('tahun', $tahun)->where('skpd_id', Auth::user()->bidang->skpd_id)->first();
        $uraian = Uraian::where('subkegiatan_id', $id)->where('jenis_rfk', $status_rfk)->where('tahun', $tahun)->get()->map(function ($item) {
            $item->sisa_dpa = $item->dpa - $item->p_januari_keuangan - $item->p_februari_keuangan - $item->p_maret_keuangan - $item->p_april_keuangan - $item->p_mei_keuangan - $item->p_juni_keuangan - $item->p_juli_keuangan - $item->p_agustus_keuangan - $item->p_september_keuangan - $item->p_oktober_keuangan - $item->p_november_keuangan - $item->p_desember_keuangan;
            return $item;
        })->where('sisa_dpa', '!=', 0)->count();
        if ($uraian != 0) {
            Session::flash('warning', 'Terdapat uraian kegiatan yang perencanaan tidak sesuai dengan angkas, silahkan check di uraian di menu dashboard');
            return back();
        }

        if ($deadline == null) {
            Session::flash('error', 'Batas Input Angkas Belum Dibuat oleh Admin SKPD');
        } else {
            if (Carbon::now()->format('Y-m-d') > $deadline->angkas) {
                Session::flash('error', 'Batas Input Angkas Sudah Lewat');
            } else {
                Subkegiatan::find($id)->update(['kirim_angkas' => 1]);
                Session::flash('success', 'Berhasil Disimpan');
            }
        }
        return back();
    }
}
