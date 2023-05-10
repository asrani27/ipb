<?php

namespace App\Http\Controllers;

use App\Models\BatasInput;
use App\Models\Uraian;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\Subkegiatan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BidangRealisasiController extends Controller
{
    public function index()
    {
        return view('bidang.realisasi.index');
    }

    public function tahun($tahun)
    {
        $bidang_id = Auth::user()->bidang->id;
        $data = Program::where('bidang_id', $bidang_id)->where('tahun', $tahun)->where('jenis_rfk', statusRFK())->get();
        //dd(statusRFK());
        return view('bidang.realisasi.program', compact('data', 'tahun'));
    }

    public function program($tahun, $program_id)
    {
        $bidang_id = Auth::user()->bidang->id;
        $data = Kegiatan::where('program_id', $program_id)->get();
        $program = Program::find($program_id);

        return view('bidang.realisasi.kegiatan', compact('data', 'tahun', 'program'));
    }

    public function kegiatan($tahun, $program_id, $kegiatan_id)
    {
        $bidang_id = Auth::user()->bidang->id;
        $data = Subkegiatan::where('kegiatan_id', $kegiatan_id)->get();
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);

        return view('bidang.realisasi.subkegiatan', compact('data', 'tahun', 'program', 'kegiatan'));
    }
    public function subkegiatan($tahun, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $bidang_id = Auth::user()->bidang->id;
        $jenis = statusRFK();

        $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('jenis_rfk', $jenis)->get();


        $data->map(function ($item) {
            $item->jumlah_renc_keuangan = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan + $item->p_juli_keuangan + $item->p_agustus_keuangan + $item->p_september_keuangan + $item->p_oktober_keuangan + $item->p_november_keuangan + $item->p_desember_keuangan;
            $item->jumlah_real_keuangan = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan + $item->r_mei_keuangan + $item->r_juni_keuangan + $item->r_juli_keuangan + $item->r_agustus_keuangan + $item->r_september_keuangan + $item->r_oktober_keuangan + $item->r_november_keuangan + $item->r_desember_keuangan;
            $item->jumlah_renc_fisik = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik + $item->p_mei_fisik + $item->p_juni_fisik + $item->p_juli_fisik + $item->p_agustus_fisik + $item->p_september_fisik + $item->p_oktober_fisik + $item->p_november_fisik + $item->p_desember_fisik;
            $item->jumlah_real_fisik = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik + $item->r_mei_fisik + $item->r_juni_fisik + $item->r_juli_fisik + $item->r_agustus_fisik + $item->r_september_fisik + $item->r_oktober_fisik + $item->r_november_fisik + $item->r_desember_fisik;
            return $item;
        });

        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        return view('bidang.realisasi.uraian', compact('data', 'tahun', 'program', 'kegiatan', 'subkegiatan', 'jenis'));
    }

    public function store(Request $req)
    {
        //check status angkas
        $check = Uraian::find($req->uraian_id);
        if ($check->subkegiatan->kirim_angkas == null) {
            Session::flash('warning', 'Rencana / Angkas Perlu di kirim terlebih dahulu');
            return back();
        }
        //check status laporan telah di kirim
        $kirim_rfk = 'kirim_rfk_' . $req->bulan;

        if ($check->subkegiatan[$kirim_rfk] == 1) {
            Session::flash('warning', 'Laporan RFK Bulan ' . $req->bulan . ' Sudah terkirim, jadi tidak bisa edit realisasi');
            return back();
        }

        //check batas input
        $bt = BatasInput::where('skpd_id', Auth::user()->bidang->skpd->id)->where('tahun', $check->tahun)->first();
        if (Carbon::now()->format('Y-m-d') > $bt[$req->bulan]) {
            Session::flash('warning', 'Batas Penginputan Realisasi ' . Carbon::parse($bt[$req->bulan])->format('d-m-Y'));
            return back();
        }

        $data = Uraian::find($req->uraian_id);
        // if ($data['p_' . $req->bulan . '_keuangan'] < $req->real_realisasi) {
        //     Session::flash('info', 'Tidak bisa melebihi angka yang di rencanakan');
        //     return back();
        // }
        //hitung persen 
        //rumus (real / dpa) * 100

        $persen = ($req->real_realisasi / $data->dpa) * 100;

        Uraian::find($req->uraian_id)->update([
            'r_' . $req->bulan . '_keuangan' => $req->real_realisasi,
            'r_' . $req->bulan . '_fisik' => $persen,
        ]);

        Session::flash('success', 'Berhasil Di Simpan');
        return back();
    }

    public function storeFisik(Request $req)
    {
        $check = Uraian::find($req->uraian_id);
        if ($check->subkegiatan->kirim_angkas == null) {
            Session::flash('warning', 'Rencana / Angkas Perlu di kirim terlebih dahulu');
            return back();
        }
        $kirim_rfk = 'kirim_rfk_' . $req->bulan;

        if ($check->subkegiatan[$kirim_rfk] == 1) {
            Session::flash('warning', 'Laporan RFK Bulan ' . $req->bulan . ' Sudah terkirim, jadi tidak bisa edit realisasi');
            return back();
        }

        //check batas input
        $bt = BatasInput::where('skpd_id', Auth::user()->bidang->skpd->id)->where('tahun', $check->tahun)->first();
        if (Carbon::now()->format('Y-m-d') > $bt[$req->bulan]) {
            Session::flash('warning', 'Batas Penginputan Realisasi ' . Carbon::parse($bt[$req->bulan])->format('d-m-Y'));
            return back();
        }

        Uraian::find($req->uraian_id)->update([
            'r_' . $req->bulan . '_fisik' => $req->real_realisasi,
        ]);

        Session::flash('success', 'Berhasil Di Simpan');
        return back();
    }
}
