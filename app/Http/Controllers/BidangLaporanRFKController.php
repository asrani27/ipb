<?php

namespace App\Http\Controllers;

use App\Models\Uraian;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\Subkegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidangLaporanRFKController extends Controller
{
    public function index()
    {
        return view('bidang.laporan.index');
    }

    public function tahun($tahun)
    {
        return view('bidang.laporan.bulan', compact('tahun'));
    }

    public function bulan($tahun, $bulan)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;
        $data = Program::where('bidang_id', $bidang_id)->where('tahun', $tahun)->get();

        return view('bidang.laporan.program', compact('tahun', 'bulan', 'nama_bulan', 'data'));
    }

    public function program($tahun, $bulan, $program_id)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;
        $data = Kegiatan::where('program_id', $program_id)->get();
        $program = Program::find($program_id);

        return view('bidang.laporan.kegiatan', compact('data', 'tahun', 'bulan', 'nama_bulan', 'program'));
    }

    public function kegiatan($tahun, $bulan, $program_id, $kegiatan_id)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;
        $data = Subkegiatan::where('kegiatan_id', $kegiatan_id)->get();
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);

        return view('bidang.laporan.subkegiatan', compact('data', 'tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan'));
    }
    public function subkegiatan($tahun, $bulan, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;
        $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->get();
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

        return view('bidang.laporan.rfk', compact('data', 'tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan'));
    }
    public function input($tahun, $bulan, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;
        $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->get();
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        return view('bidang.laporan.rfk_input', compact('data', 'tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan'));
    }

    public function pbj($tahun, $bulan, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        return view('bidang.laporan.rfk_pbj', compact('tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan'));
    }

    public function st($tahun, $bulan, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        return view('bidang.laporan.rfk_st', compact('tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan'));
    }

    public function m($tahun, $bulan, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        return view('bidang.laporan.rfk_m', compact('tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan'));
    }

    public function v($tahun, $bulan, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        return view('bidang.laporan.rfk_v', compact('tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan'));
    }
    public function fiskeu($tahun, $bulan, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;
        $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->get();
        $totalDPA = $data->sum('dpa');

        $data->map(function ($item) use ($bulan, $totalDPA) {
            $item->persenDPA = ($item->dpa / $totalDPA) * 100;
            $item->r_januari_keuangan   = (int)$bulan >= 1 ? $item->r_januari_keuangan : 0;
            $item->r_februari_keuangan  = (int)$bulan >= 2 ? $item->r_februari_keuangan : 0;
            $item->r_maret_keuangan     = (int)$bulan >= 3 ? $item->r_maret_keuangan : 0;
            $item->r_april_keuangan     = (int)$bulan >= 4 ? $item->r_april_keuangan : 0;
            $item->r_mei_keuangan       = (int)$bulan >= 5 ? $item->r_mei_keuangan : 0;
            $item->r_juni_keuangan      = (int)$bulan >= 6 ? $item->r_juni_keuangan : 0;
            $item->r_juli_keuangan      = (int)$bulan >= 7 ? $item->r_juli_keuangan : 0;
            $item->r_agustus_keuangan   = (int)$bulan >= 8 ? $item->r_agustus_keuangan : 0;
            $item->r_september_keuangan = (int)$bulan >= 9 ? $item->r_september_keuangan : 0;
            $item->r_oktober_keuangan   = (int)$bulan >= 10 ? $item->r_oktober_keuangan : 0;
            $item->r_november_keuangan  = (int)$bulan >= 11 ? $item->r_november_keuangan : 0;
            $item->r_desember_keuangan  = (int)$bulan >= 12 ? $item->r_desember_keuangan : 0;

            $item->k_januari        = $item->p_januari_fisik * $item->persenDPA / 100;
            $item->k_februari       = $item->p_februari_fisik * $item->persenDPA / 100;
            $item->k_maret          = $item->p_maret_fisik * $item->persenDPA / 100;
            $item->k_april          = $item->p_april_fisik * $item->persenDPA / 100;
            $item->k_mei            = $item->p_mei_fisik * $item->persenDPA / 100;
            $item->k_juni           = $item->p_juni_fisik * $item->persenDPA / 100;
            $item->k_juli           = $item->p_juli_fisik * $item->persenDPA / 100;
            $item->k_agustus        = $item->p_agustus_fisik * $item->persenDPA / 100;
            $item->k_september      = $item->p_september_fisik * $item->persenDPA / 100;
            $item->k_oktober        = $item->p_oktober_fisik * $item->persenDPA / 100;
            $item->k_november       = $item->p_november_fisik * $item->persenDPA / 100;
            $item->k_desember       = $item->p_desember_fisik * $item->persenDPA / 100;
            $item->k_jumlah         = $item->k_januari + $item->k_februari + $item->k_maret + $item->k_april + $item->k_mei + $item->k_juni + $item->k_juli + $item->k_agustus + $item->k_september + $item->k_oktober + $item->k_november + $item->k_desember;
            $item->jumlah_renc_keuangan = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan + $item->p_juli_keuangan + $item->p_agustus_keuangan + $item->p_september_keuangan + $item->p_oktober_keuangan + $item->p_november_keuangan + $item->p_desember_keuangan;
            $item->jumlah_real_keuangan = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan + $item->r_mei_keuangan + $item->r_juni_keuangan + $item->r_juli_keuangan + $item->r_agustus_keuangan + $item->r_september_keuangan + $item->r_oktober_keuangan + $item->r_november_keuangan + $item->r_desember_keuangan;
            $item->jumlah_renc_fisik = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik + $item->p_mei_fisik + $item->p_juni_fisik + $item->p_juli_fisik + $item->p_agustus_fisik + $item->p_september_fisik + $item->p_oktober_fisik + $item->p_november_fisik + $item->p_desember_fisik;
            $item->jumlah_real_fisik = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik + $item->r_mei_fisik + $item->r_juni_fisik + $item->r_juli_fisik + $item->r_agustus_fisik + $item->r_september_fisik + $item->r_oktober_fisik + $item->r_november_fisik + $item->r_desember_fisik;
            return $item;
        });

        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        return view('bidang.laporan.rfk_fiskeu', compact('data', 'tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan'));
    }


    public function rfk($tahun, $bulan, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);
        $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->get();
        $totalDPA = $data->sum('dpa');

        $data->map(function ($item) use ($totalDPA, $bulan) {
            $item->persenDPA = ($item->dpa / $totalDPA) * 100;
            $item->rencanaRP = totalRencana($bulan, $item);
            $item->rencanaKUM = ($item->rencanaRP / $item->dpa) * 100;
            $item->rencanaTTB = ($item->persenDPA * $item->rencanaKUM) / 100;
            $item->realisasiRP = totalRealisasi($bulan, $item);
            $item->realisasiKUM = ($item->realisasiRP / $item->dpa) * 100;
            $item->realisasiTTB = ($item->persenDPA * $item->realisasiKUM) / 100;
            $item->deviasiKUM = $item->rencanaKUM - $item->realisasiKUM;
            $item->deviasiTTB = $item->rencanaTTB - $item->realisasiTTB;
            $item->sisaAnggaran = $item->dpa - $item->realisasiRP;

            $item->fisikRencanaKUM = fisikRencana($bulan, $item);
            $item->fisikRencanaTTB = $item->fisikRencanaKUM * $item->persenDPA / 100;
            $item->fisikRealisasiKUM = fisikRealisasi($bulan, $item);
            $item->fisikRealisasiTTB = $item->fisikRealisasiKUM * $item->persenDPA / 100;
            $item->fisikDeviasiKUM = $item->fisikRencanaKUM - $item->fisikRealisasiKUM;
            $item->fisikDeviasiTTB = $item->fisikRencanaTTB - $item->fisikRealisasiTTB;
            return $item;
        });

        return view('bidang.laporan.rfk_rfk', compact('data', 'tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan'));
    }

    public function srp($tahun, $bulan, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);
        $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->get();
        $totalDPA = $data->sum('dpa');

        $data->map(function ($item) use ($totalDPA, $bulan) {
            $item->persenDPA = ($item->dpa / $totalDPA) * 100;
            $item->rencanaRP = totalRencana($bulan, $item);
            $item->rencanaKUM = ($item->rencanaRP / $item->dpa) * 100;
            $item->rencanaTTB = ($item->persenDPA * $item->rencanaKUM) / 100;
            $item->realisasiRP = totalRealisasi($bulan, $item);
            $item->realisasiKUM = ($item->realisasiRP / $item->dpa) * 100;
            $item->realisasiTTB = ($item->persenDPA * $item->realisasiKUM) / 100;
            $item->deviasiKUM = $item->rencanaKUM - $item->realisasiKUM;
            $item->deviasiTTB = $item->rencanaTTB - $item->realisasiTTB;
            $item->sisaAnggaran = $item->dpa - $item->realisasiRP;

            $item->fisikRencanaKUM = fisikRencana($bulan, $item);
            $item->fisikRencanaTTB = $item->fisikRencanaKUM * $item->persenDPA / 100;
            $item->fisikRealisasiKUM = fisikRealisasi($bulan, $item);
            $item->fisikRealisasiTTB = $item->fisikRealisasiKUM * $item->persenDPA / 100;
            $item->fisikDeviasiKUM = $item->fisikRencanaKUM - $item->fisikRealisasiKUM;
            $item->fisikDeviasiTTB = $item->fisikRencanaTTB - $item->fisikRealisasiTTB;
            return $item;
        });

        return view('bidang.laporan.rfk_srp', compact('data', 'tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan'));
    }
}
