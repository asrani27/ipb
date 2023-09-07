<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\M_program;
use App\Models\T_capaian;
use App\Models\M_kegiatan;
use Illuminate\Http\Request;
use App\Models\M_subkegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AdminCapaianController extends Controller
{

    public function tarikIndikator()
    {
        $response = Http::get('https://sikap.banjarmasinkota.go.id/api/renstra/target/skpd/1.01.001/2023')->json();
        dd($response);
    }
    public function index()
    {
        $tahun = Carbon::now()->format('Y');
        $program = M_program::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->get()->map(function ($item, $key) use ($tahun) {
            $capaian = T_capaian::where('jenis', 'program')->where('tahun', $tahun)->where('skpd_id', Auth::user()->skpd->id)->where('kode', $item->kode)->first();
            $item->capaian = $capaian == null ? null : $capaian->capaian;

            return $item;
        });


        $count_program = M_program::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->count();
        $count_kegiatan = M_kegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->count();
        $count_subkegiatan = M_subkegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->count();


        return view('admin.capaian.index', compact('program', 'count_program', 'count_kegiatan', 'count_subkegiatan', 'tahun'));
    }

    public function updateCapaian(Request $req)
    {

        $check = T_capaian::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $req->tahun)->where('jenis', $req->jenis)->where('kode', $req->kode)->first();
        $check->update([
            'tw1' => $req->tw1,
            'tw2' => $req->tw2,
            'tw3' => $req->tw3,
            'tw4' => $req->tw4,
        ]);
        Session::flash('success', 'Diupdate');
        return back();
    }

    public function storeCapaian(Request $req)
    {
        if ($req->kode == null) {
            Session::flash('warning', 'Harap Isi Kode terlebih dahulu');
            return back();
        }
        $check = T_capaian::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $req->tahun)->where('jenis', $req->jenis)->where('kode', $req->kode)->first();
        if ($check != null) {
            Session::flash('warning', 'Sudah ada');
            return back();
        } else {
            $n = new T_capaian;
            $n->skpd_id = Auth::user()->skpd->id;
            $n->tahun = $req->tahun;
            $n->jenis = $req->jenis;
            $n->kode = $req->kode;
            $n->nama = $req->uraian;
            $n->tw1 = $req->tw1;
            $n->tw2 = $req->tw2;
            $n->tw3 = $req->tw3;
            $n->tw4 = $req->tw4;
            $n->save();
            Session::flash('success', 'Berhasil Disimpan');
            return back();
        }
    }
    public function capaianProgram(Request $req)
    {
        if ($req->kode == null) {
            Session::flash('warning', 'Harap Isi Kode terlebih dahulu');
            return back();
        }
        $check = T_capaian::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $req->tahun)->where('jenis', 'program')->where('kode', $req->kode)->first();
        if ($check != null) {
            Session::flash('warning', 'Sudah ada');
            return back();
        } else {
            $n = new T_capaian;
            $n->skpd_id = Auth::user()->skpd->id;
            $n->tahun = $req->tahun;
            $n->jenis = $req->jenis;
            $n->kode = $req->kode;
            $n->nama = $req->uraian;
            $n->capaian = $req->capaian;
            $n->save();
            Session::flash('success', 'Berhasil Disimpan');
            return back();
        }
    }
    public function capaianKegiatan(Request $req)
    {
        if ($req->kode == null) {
            Session::flash('warning', 'Harap Isi Kode terlebih dahulu');
            return back();
        }
        $check = T_capaian::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $req->tahun)->where('jenis', 'kegiatan')->where('kode', $req->kode)->first();
        if ($check != null) {
            Session::flash('warning', 'Sudah ada');
            return back();
        } else {
            $n = new T_capaian;
            $n->skpd_id = Auth::user()->skpd->id;
            $n->tahun = $req->tahun;
            $n->jenis = $req->jenis;
            $n->kode = $req->kode;
            $n->nama = $req->uraian;
            $n->capaian = $req->capaian;
            $n->save();
            Session::flash('success', 'Berhasil Disimpan');
            return back();
        }
    }
    public function capaianSubkegiatan(Request $req)
    {
        if ($req->kode == null) {
            Session::flash('warning', 'Harap Isi Kode terlebih dahulu');
            return back();
        }
        $check = T_capaian::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $req->tahun)->where('jenis', 'subkegiatan')->where('kode', $req->kode)->first();
        if ($check != null) {
            Session::flash('warning', 'Sudah ada');
            return back();
        } else {
            $n = new T_capaian;
            $n->skpd_id = Auth::user()->skpd->id;
            $n->tahun = $req->tahun;
            $n->jenis = $req->jenis;
            $n->kode = $req->kode;
            $n->nama = $req->uraian;
            $n->capaian = $req->capaian;
            $n->save();
            Session::flash('success', 'Berhasil Disimpan');
            return back();
        }
    }
}
