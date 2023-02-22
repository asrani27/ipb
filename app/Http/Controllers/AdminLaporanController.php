<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\JenisRfk;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\Subkegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function angkas($id)
    {
        $data = Subkegiatan::find($id);
        $uraian = Subkegiatan::find($id)->uraian;
        $uraian->map(function ($item) {
            $item->jumlah_renc_keuangan = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan + $item->p_juli_keuangan + $item->p_agustus_keuangan + $item->p_september_keuangan + $item->p_oktober_keuangan + $item->p_november_keuangan + $item->p_desember_keuangan;
            $item->jumlah_real_keuangan = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan + $item->r_mei_keuangan + $item->r_juni_keuangan + $item->r_juli_keuangan + $item->r_agustus_keuangan + $item->r_september_keuangan + $item->r_oktober_keuangan + $item->r_november_keuangan + $item->r_desember_keuangan;
            $item->jumlah_renc_fisik = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik + $item->p_mei_fisik + $item->p_juni_fisik + $item->p_juli_fisik + $item->p_agustus_fisik + $item->p_september_fisik + $item->p_oktober_fisik + $item->p_november_fisik + $item->p_desember_fisik;
            $item->jumlah_real_fisik = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik + $item->r_mei_fisik + $item->r_juni_fisik + $item->r_juli_fisik + $item->r_agustus_fisik + $item->r_september_fisik + $item->r_oktober_fisik + $item->r_november_fisik + $item->r_desember_fisik;
            return $item;
        });
        return view('admin.laporan.angkas', compact('data', 'uraian'));
    }

    public function laporan($tahun)
    {
        $bidang = Bidang::count();
        $program = Program::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->count();
        $subkegiatan = Subkegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->count();

        $data = Subkegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->get();
        return view('admin.laporan.laporanrfk', compact('bidang', 'program', 'subkegiatan', 'data'));
    }


    public function laporanRfk($tahun, $bulan)
    {

        $statusRFK = JenisRfk::where('skpd_id',  Auth::user()->skpd->id)->where('tahun', $tahun)->first();

        if ($statusRFK[$bulan] == 'murni') {
            $result = null;
        } elseif ($statusRFK[$bulan] == 'perubahan') {
            $result = 99;
        }

        $bidang = Bidang::count();
        $program = Program::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->count();
        $subkegiatan = Subkegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->count();

        $data = Program::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->get();

        $subkeg = Subkegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->get();

        $totalsubkegiatan = $subkeg->map(function ($item) use ($result) {
            $item->kolom3 = $item->uraian->where('status', $result)->sum('dpa');
            return $item;
        })->sum('kolom3');

        $datasubkegiatan = $subkeg->map(function ($item) use ($result, $totalsubkegiatan, $bulan) {
            if ($totalsubkegiatan == 0) {
                $item->kolom3 = 0;
                $item->kolom4 = 0;
                $item->kolom5 = 0;
                $item->kolom6 = 0;
                $item->kolom7 = 0;
                $item->kolom8 = 0;
                $item->kolom9 = 0;
                $item->kolom10 = 0;
                $item->kolom11 = 0;
                $item->kolom12 = 0;
                $item->kolom13 = 0;
                $item->kolom14 = 0;
            } else {
                $item->kolom3 = $item->uraian->where('status', $result)->sum('dpa');
                $item->kolom4 = ($item->kolom3 / $totalsubkegiatan) * 100;
                $rencana = 'p_' . $bulan . '_keuangan';

                $item->kolom5 = rencanaSKPD($bulan, $item, $result);
                $item->kolom6 = ($item->kolom5 / $item->kolom3) * 100;
                $item->kolom7 = ($item->kolom6 * $item->kolom4) / 100;
                $realisasi = 'r_' . $bulan . '_keuangan';
                $item->kolom8 = $item->uraian->where('status', $result)->sum($realisasi);
                $item->kolom9 = ($item->kolom8 / $item->kolom3) * 100;
                $item->kolom10 = ($item->kolom9 * $item->kolom4) / 100;
                if ($item->kolom8 == 0 && $item->kolom5 == 0) {
                    $item->kolom11 = 100;
                } else {
                    $item->kolom11 = ($item->kolom8 / $item->kolom5) * 100;
                }
                $item->kolom12 = $item->kolom3 - $item->kolom8;

                $rencanaFisik = 'p_' . $bulan . '_fisik';
                $item->kolom13 = $item->uraian->where('status', $result)->sum($rencanaFisik);
                $item->kolom14 = ($item->kolom13 * $item->kolom4) / 100;
            }
            return $item;
        });



        return view('admin.laporan.laporanrfk', compact('bidang', 'program', 'subkegiatan', 'data', 'datasubkegiatan', 'totalsubkegiatan'));
    }
}
