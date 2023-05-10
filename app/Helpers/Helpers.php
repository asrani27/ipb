<?php

use App\Models\JenisRfk;
use Illuminate\Support\Facades\Auth;

function statusRFK()
{
    if (Auth::user()->hasRole('admin')) {
        if (Auth::user()->skpd->murni == 1) {
            $result = 'murni';
        } elseif (Auth::user()->skpd->pergeseran == 1) {
            $result = 'pergeseran';
        } elseif (Auth::user()->skpd->perubahan == 1) {
            $result = 'perubahan';
        } else {
            $result = null;
        }
    } elseif (Auth::user()->hasRole('pptk')) {
        if (Auth::user()->pptk->skpd->murni == 1) {
            $result = 'murni';
        } elseif (Auth::user()->pptk->skpd->pergeseran == 1) {
            $result = 'pergeseran';
        } elseif (Auth::user()->pptk->skpd->perubahan == 1) {
            $result = 'perubahan';
        } else {
            $result = null;
        }
    } else {
        if (Auth::user()->bidang->skpd->murni == 1) {
            $result = 'murni';
        } elseif (Auth::user()->bidang->skpd->pergeseran == 1) {
            $result = 'pergeseran';
        } elseif (Auth::user()->bidang->skpd->perubahan == 1) {
            $result = 'perubahan';
        } else {
            $result = null;
        }
    }

    return $result;
}

function jenisRFK($bulan, $tahun)
{

    $result = JenisRfk::where('tahun', $tahun)->where('skpd_id', Auth::user()->skpd->id)->first()[$bulan];
    return $result;
}

function namaBulan($bulan)
{
    if ($bulan == '01') {
        $nama_bulan = 'Januari';
    }
    if ($bulan == '02') {
        $nama_bulan = 'Februari';
    }
    if ($bulan == '03') {
        $nama_bulan = 'Maret';
    }
    if ($bulan == '04') {
        $nama_bulan = 'April';
    }
    if ($bulan == '05') {
        $nama_bulan = 'Mei';
    }
    if ($bulan == '06') {
        $nama_bulan = 'Juni';
    }
    if ($bulan == '07') {
        $nama_bulan = 'Juli';
    }
    if ($bulan == '08') {
        $nama_bulan = 'Agustus';
    }
    if ($bulan == '09') {
        $nama_bulan = 'September';
    }
    if ($bulan == '10') {
        $nama_bulan = 'Oktober';
    }
    if ($bulan == '11') {
        $nama_bulan = 'November';
    }
    if ($bulan == '12') {
        $nama_bulan = 'Desember';
    }
    return $nama_bulan;
}


function rencanaSKPD($bulan, $item, $jenisrfk)
{
    $uraian = $item->uraian->where('jenis_rfk', $jenisrfk);
    if ($bulan == 'januari') {
        $total = $uraian->sum('p_januari_keuangan');
    }
    if ($bulan == 'februari') {
        $total = $uraian->sum('p_januari_keuangan') + $uraian->sum('p_februari_keuangan');
    }
    if ($bulan == 'maret') {
        $total = $uraian->sum('p_januari_keuangan') + $uraian->sum('p_februari_keuangan') + $uraian->sum('p_maret_keuangan');
    }
    if ($bulan == 'april') {
        $total = $uraian->sum('p_januari_keuangan') + $uraian->sum('p_februari_keuangan') + $uraian->sum('p_maret_keuangan') + $uraian->sum('p_april_keuangan');
    }
    if ($bulan == 'mei') {
        $total = $uraian->sum('p_januari_keuangan') + $uraian->sum('p_februari_keuangan') + $uraian->sum('p_maret_keuangan') + $uraian->sum('p_april_keuangan') + $uraian->sum('p_mei_keuangan');
    }
    if ($bulan == 'juni') {
        $total = $uraian->sum('p_januari_keuangan') + $uraian->sum('p_februari_keuangan') + $uraian->sum('p_maret_keuangan') + $uraian->sum('p_april_keuangan') + $uraian->sum('p_mei_keuangan') + $uraian->sum('p_juni_keuangan');
    }
    if ($bulan == 'juli') {
        $total = $uraian->sum('p_januari_keuangan') + $uraian->sum('p_februari_keuangan') + $uraian->sum('p_maret_keuangan') + $uraian->sum('p_april_keuangan') + $uraian->sum('p_mei_keuangan') + $uraian->sum('p_juni_keuangan') + $uraian->sum('p_juli_keuangan');
    }
    if ($bulan == 'agustus') {
        $total = $uraian->sum('p_januari_keuangan') + $uraian->sum('p_februari_keuangan') + $uraian->sum('p_maret_keuangan') + $uraian->sum('p_april_keuangan') + $uraian->sum('p_mei_keuangan') + $uraian->sum('p_juni_keuangan') + $uraian->sum('p_juli_keuangan') + $uraian->sum('p_agustus_keuangan');
    }
    if ($bulan == 'september') {
        $total = $uraian->sum('p_januari_keuangan') + $uraian->sum('p_februari_keuangan') + $uraian->sum('p_maret_keuangan') + $uraian->sum('p_april_keuangan') + $uraian->sum('p_mei_keuangan') + $uraian->sum('p_juni_keuangan') + $uraian->sum('p_juli_keuangan') + $uraian->sum('p_agustus_keuangan') + $uraian->sum('p_september_keuangan');
    }
    if ($bulan == 'oktober') {
        $total = $uraian->sum('p_januari_keuangan') + $uraian->sum('p_februari_keuangan') + $uraian->sum('p_maret_keuangan') + $uraian->sum('p_april_keuangan') + $uraian->sum('p_mei_keuangan') + $uraian->sum('p_juni_keuangan') + $uraian->sum('p_juli_keuangan') + $uraian->sum('p_agustus_keuangan') + $uraian->sum('p_september_keuangan') + $uraian->sum('p_oktober_keuangan');
    }
    if ($bulan == 'november') {
        $total = $uraian->sum('p_januari_keuangan') + $uraian->sum('p_februari_keuangan') + $uraian->sum('p_maret_keuangan') + $uraian->sum('p_april_keuangan') + $uraian->sum('p_mei_keuangan') + $uraian->sum('p_juni_keuangan') + $uraian->sum('p_juli_keuangan') + $uraian->sum('p_agustus_keuangan') + $uraian->sum('p_september_keuangan') + $uraian->sum('p_oktober_keuangan') + $uraian->sum('p_november_keuangan');
    }
    if ($bulan == 'desember') {
        $total = $uraian->sum('p_januari_keuangan') + $uraian->sum('p_februari_keuangan') + $uraian->sum('p_maret_keuangan') + $uraian->sum('p_april_keuangan') + $uraian->sum('p_mei_keuangan') + $uraian->sum('p_juni_keuangan') + $uraian->sum('p_juli_keuangan') + $uraian->sum('p_agustus_keuangan') + $uraian->sum('p_september_keuangan') + $uraian->sum('p_oktober_keuangan') + $uraian->sum('p_november_keuangan') + $uraian->sum('p_desember_keuangan');
    }
    return $total;
}
function realisasiSKPD($bulan, $item, $jenisrfk)
{
    $uraian = $item->uraian->where('jenis_rfk', $jenisrfk);
    if ($bulan == 'januari') {
        $total = $uraian->sum('r_januari_keuangan');
    }
    if ($bulan == 'februari') {
        $total = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan');
    }
    if ($bulan == 'maret') {
        $total = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan');
    }
    if ($bulan == 'april') {
        $total = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan') + $uraian->sum('r_april_keuangan');
    }
    if ($bulan == 'mei') {
        $total = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan') + $uraian->sum('r_april_keuangan') + $uraian->sum('r_mei_keuangan');
    }
    if ($bulan == 'juni') {
        $total = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan') + $uraian->sum('r_april_keuangan') + $uraian->sum('r_mei_keuangan') + $uraian->sum('r_juni_keuangan');
    }
    if ($bulan == 'juli') {
        $total = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan') + $uraian->sum('r_april_keuangan') + $uraian->sum('r_mei_keuangan') + $uraian->sum('r_juni_keuangan') + $uraian->sum('r_juli_keuangan');
    }
    if ($bulan == 'agustus') {
        $total = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan') + $uraian->sum('r_april_keuangan') + $uraian->sum('r_mei_keuangan') + $uraian->sum('r_juni_keuangan') + $uraian->sum('r_juli_keuangan') + $uraian->sum('r_agustus_keuangan');
    }
    if ($bulan == 'september') {
        $total = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan') + $uraian->sum('r_april_keuangan') + $uraian->sum('r_mei_keuangan') + $uraian->sum('r_juni_keuangan') + $uraian->sum('r_juli_keuangan') + $uraian->sum('r_agustus_keuangan') + $uraian->sum('r_september_keuangan');
    }
    if ($bulan == 'oktober') {
        $total = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan') + $uraian->sum('r_april_keuangan') + $uraian->sum('r_mei_keuangan') + $uraian->sum('r_juni_keuangan') + $uraian->sum('r_juli_keuangan') + $uraian->sum('r_agustus_keuangan') + $uraian->sum('r_september_keuangan') + $uraian->sum('r_oktober_keuangan');
    }
    if ($bulan == 'november') {
        $total = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan') + $uraian->sum('r_april_keuangan') + $uraian->sum('r_mei_keuangan') + $uraian->sum('r_juni_keuangan') + $uraian->sum('r_juli_keuangan') + $uraian->sum('r_agustus_keuangan') + $uraian->sum('r_september_keuangan') + $uraian->sum('r_oktober_keuangan') + $uraian->sum('r_november_keuangan');
    }
    if ($bulan == 'desember') {
        $total = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan') + $uraian->sum('r_april_keuangan') + $uraian->sum('r_mei_keuangan') + $uraian->sum('r_juni_keuangan') + $uraian->sum('r_juli_keuangan') + $uraian->sum('r_agustus_keuangan') + $uraian->sum('r_september_keuangan') + $uraian->sum('r_oktober_keuangan') + $uraian->sum('r_november_keuangan') + $uraian->sum('r_desember_keuangan');
    }
    return $total;
}

function fisikRencanaSKPD($bulan, $item, $jenisrfk)
{
    $uraian = $item->uraian->where('jenis_rfk', $jenisrfk);
    if ($bulan == 'januari') {
        $total = $uraian->sum('p_januari_fisik');
    }
    if ($bulan == 'februari') {
        $total = $uraian->sum('p_januari_fisik') + $uraian->sum('p_februari_fisik');
    }
    if ($bulan == 'maret') {
        $total = $uraian->sum('p_januari_fisik') + $uraian->sum('p_februari_fisik') + $uraian->sum('p_maret_fisik');
    }
    if ($bulan == 'april') {
        $total = $uraian->sum('p_januari_fisik') + $uraian->sum('p_februari_fisik') + $uraian->sum('p_maret_fisik') + $uraian->sum('p_april_fisik');
    }
    if ($bulan == 'mei') {
        $total = $uraian->sum('p_januari_fisik') + $uraian->sum('p_februari_fisik') + $uraian->sum('p_maret_fisik') + $uraian->sum('p_april_fisik') + $uraian->sum('p_mei_fisik');
    }
    if ($bulan == 'juni') {
        $total = $uraian->sum('p_januari_fisik') + $uraian->sum('p_februari_fisik') + $uraian->sum('p_maret_fisik') + $uraian->sum('p_april_fisik') + $uraian->sum('p_mei_fisik') + $uraian->sum('p_juni_fisik');
    }
    if ($bulan == 'juli') {
        $total = $uraian->sum('p_januari_fisik') + $uraian->sum('p_februari_fisik') + $uraian->sum('p_maret_fisik') + $uraian->sum('p_april_fisik') + $uraian->sum('p_mei_fisik') + $uraian->sum('p_juni_fisik') + $uraian->sum('p_juli_fisik');
    }
    if ($bulan == 'agustus') {
        $total = $uraian->sum('p_januari_fisik') + $uraian->sum('p_februari_fisik') + $uraian->sum('p_maret_fisik') + $uraian->sum('p_april_fisik') + $uraian->sum('p_mei_fisik') + $uraian->sum('p_juni_fisik') + $uraian->sum('p_juli_fisik') + $uraian->sum('p_agustus_fisik');
    }
    if ($bulan == 'september') {
        $total = $uraian->sum('p_januari_fisik') + $uraian->sum('p_februari_fisik') + $uraian->sum('p_maret_fisik') + $uraian->sum('p_april_fisik') + $uraian->sum('p_mei_fisik') + $uraian->sum('p_juni_fisik') + $uraian->sum('p_juli_fisik') + $uraian->sum('p_agustus_fisik') + $uraian->sum('p_september_fisik');
    }
    if ($bulan == 'oktober') {
        $total = $uraian->sum('p_januari_fisik') + $uraian->sum('p_februari_fisik') + $uraian->sum('p_maret_fisik') + $uraian->sum('p_april_fisik') + $uraian->sum('p_mei_fisik') + $uraian->sum('p_juni_fisik') + $uraian->sum('p_juli_fisik') + $uraian->sum('p_agustus_fisik') + $uraian->sum('p_september_fisik') + $uraian->sum('p_oktober_fisik');
    }
    if ($bulan == 'november') {
        $total = $uraian->sum('p_januari_fisik') + $uraian->sum('p_februari_fisik') + $uraian->sum('p_maret_fisik') + $uraian->sum('p_april_fisik') + $uraian->sum('p_mei_fisik') + $uraian->sum('p_juni_fisik') + $uraian->sum('p_juli_fisik') + $uraian->sum('p_agustus_fisik') + $uraian->sum('p_september_fisik') + $uraian->sum('p_oktober_fisik') + $uraian->sum('p_november_fisik');
    }
    if ($bulan == 'desember') {
        $total = $uraian->sum('p_januari_fisik') + $uraian->sum('p_februari_fisik') + $uraian->sum('p_maret_fisik') + $uraian->sum('p_april_fisik') + $uraian->sum('p_mei_fisik') + $uraian->sum('p_juni_fisik') + $uraian->sum('p_juli_fisik') + $uraian->sum('p_agustus_fisik') + $uraian->sum('p_september_fisik') + $uraian->sum('p_oktober_fisik') + $uraian->sum('p_november_fisik') + $uraian->sum('p_desember_fisik');
    }
    return $total;
}
function fisikRealisasiSKPD($bulan, $item, $jenisrfk)
{
    $uraian = $item->uraian->where('jenis_rfk', $jenisrfk);
    if ($bulan == 'januari') {
        $total = $uraian->sum('r_januari_fisik');
    }
    if ($bulan == 'februari') {
        $total = $uraian->sum('r_januari_fisik') + $uraian->sum('r_februari_fisik');
    }
    if ($bulan == 'maret') {
        $total = $uraian->sum('r_januari_fisik') + $uraian->sum('r_februari_fisik') + $uraian->sum('r_maret_fisik');
    }
    if ($bulan == 'april') {
        $total = $uraian->sum('r_januari_fisik') + $uraian->sum('r_februari_fisik') + $uraian->sum('r_maret_fisik') + $uraian->sum('r_april_fisik');
    }
    if ($bulan == 'mei') {
        $total = $uraian->sum('r_januari_fisik') + $uraian->sum('r_februari_fisik') + $uraian->sum('r_maret_fisik') + $uraian->sum('r_april_fisik') + $uraian->sum('r_mei_fisik');
    }
    if ($bulan == 'juni') {
        $total = $uraian->sum('r_januari_fisik') + $uraian->sum('r_februari_fisik') + $uraian->sum('r_maret_fisik') + $uraian->sum('r_april_fisik') + $uraian->sum('r_mei_fisik') + $uraian->sum('r_juni_fisik');
    }
    if ($bulan == 'juli') {
        $total = $uraian->sum('r_januari_fisik') + $uraian->sum('r_februari_fisik') + $uraian->sum('r_maret_fisik') + $uraian->sum('r_april_fisik') + $uraian->sum('r_mei_fisik') + $uraian->sum('r_juni_fisik') + $uraian->sum('r_juli_fisik');
    }
    if ($bulan == 'agustus') {
        $total = $uraian->sum('r_januari_fisik') + $uraian->sum('r_februari_fisik') + $uraian->sum('r_maret_fisik') + $uraian->sum('r_april_fisik') + $uraian->sum('r_mei_fisik') + $uraian->sum('r_juni_fisik') + $uraian->sum('r_juli_fisik') + $uraian->sum('r_agustus_fisik');
    }
    if ($bulan == 'september') {
        $total = $uraian->sum('r_januari_fisik') + $uraian->sum('r_februari_fisik') + $uraian->sum('r_maret_fisik') + $uraian->sum('r_april_fisik') + $uraian->sum('r_mei_fisik') + $uraian->sum('r_juni_fisik') + $uraian->sum('r_juli_fisik') + $uraian->sum('r_agustus_fisik') + $uraian->sum('r_september_fisik');
    }
    if ($bulan == 'oktober') {
        $total = $uraian->sum('r_januari_fisik') + $uraian->sum('r_februari_fisik') + $uraian->sum('r_maret_fisik') + $uraian->sum('r_april_fisik') + $uraian->sum('r_mei_fisik') + $uraian->sum('r_juni_fisik') + $uraian->sum('r_juli_fisik') + $uraian->sum('r_agustus_fisik') + $uraian->sum('r_september_fisik') + $uraian->sum('r_oktober_fisik');
    }
    if ($bulan == 'november') {
        $total = $uraian->sum('r_januari_fisik') + $uraian->sum('r_februari_fisik') + $uraian->sum('r_maret_fisik') + $uraian->sum('r_april_fisik') + $uraian->sum('r_mei_fisik') + $uraian->sum('r_juni_fisik') + $uraian->sum('r_juli_fisik') + $uraian->sum('r_agustus_fisik') + $uraian->sum('r_september_fisik') + $uraian->sum('r_oktober_fisik') + $uraian->sum('r_november_fisik');
    }
    if ($bulan == 'desember') {
        $total = $uraian->sum('r_januari_fisik') + $uraian->sum('r_februari_fisik') + $uraian->sum('r_maret_fisik') + $uraian->sum('r_april_fisik') + $uraian->sum('r_mei_fisik') + $uraian->sum('r_juni_fisik') + $uraian->sum('r_juli_fisik') + $uraian->sum('r_agustus_fisik') + $uraian->sum('r_september_fisik') + $uraian->sum('r_oktober_fisik') + $uraian->sum('r_november_fisik') + $uraian->sum('r_desember_fisik');
    }
    return $total;
}

function totalRencana($bulan, $item)
{
    if ($bulan == '01') {
        $total = $item->p_januari_keuangan;
    }
    if ($bulan == '02') {
        $total = $item->p_januari_keuangan + $item->p_februari_keuangan;
    }
    if ($bulan == '03') {
        $total = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan;
    }
    if ($bulan == '04') {
        $total = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan;
    }
    if ($bulan == '05') {
        $total = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan;
    }
    if ($bulan == '06') {
        $total = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan;
    }
    if ($bulan == '07') {
        $total = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan + $item->p_juli_keuangan;
    }
    if ($bulan == '08') {
        $total = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan + $item->p_juli_keuangan + $item->p_agustus_keuangan;
    }
    if ($bulan == '09') {
        $total = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan + $item->p_juli_keuangan + $item->p_agustus_keuangan + $item->p_september_keuangan;
    }
    if ($bulan == '10') {
        $total = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan + $item->p_juli_keuangan + $item->p_agustus_keuangan + $item->p_september_keuangan + $item->p_oktober_keuangan;
    }
    if ($bulan == '11') {
        $total = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan + $item->p_juli_keuangan + $item->p_agustus_keuangan + $item->p_september_keuangan + $item->p_oktober_keuangan + $item->p_november_keuangan;
    }
    if ($bulan == '12') {
        $total = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan + $item->p_juli_keuangan + $item->p_agustus_keuangan + $item->p_september_keuangan + $item->p_oktober_keuangan + $item->p_november_keuangan + $item->p_desember_keuangan;
    }
    return $total;
}


function totalRealisasi($bulan, $item)
{
    if ($bulan == '01') {
        $total = $item->r_januari_keuangan;
    }
    if ($bulan == '02') {
        $total = $item->r_januari_keuangan + $item->r_februari_keuangan;
    }
    if ($bulan == '03') {
        $total = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan;
    }
    if ($bulan == '04') {
        $total = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan;
    }
    if ($bulan == '05') {
        $total = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan + $item->r_mei_keuangan;
    }
    if ($bulan == '06') {
        $total = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan + $item->r_mei_keuangan + $item->r_juni_keuangan;
    }
    if ($bulan == '07') {
        $total = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan + $item->r_mei_keuangan + $item->r_juni_keuangan + $item->r_juli_keuangan;
    }
    if ($bulan == '08') {
        $total = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan + $item->r_mei_keuangan + $item->r_juni_keuangan + $item->r_juli_keuangan + $item->r_agustus_keuangan;
    }
    if ($bulan == '09') {
        $total = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan + $item->r_mei_keuangan + $item->r_juni_keuangan + $item->r_juli_keuangan + $item->r_agustus_keuangan + $item->r_september_keuangan;
    }
    if ($bulan == '10') {
        $total = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan + $item->r_mei_keuangan + $item->r_juni_keuangan + $item->r_juli_keuangan + $item->r_agustus_keuangan + $item->r_september_keuangan + $item->r_oktober_keuangan;
    }
    if ($bulan == '11') {
        $total = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan + $item->r_mei_keuangan + $item->r_juni_keuangan + $item->r_juli_keuangan + $item->r_agustus_keuangan + $item->r_september_keuangan + $item->r_oktober_keuangan + $item->r_november_keuangan;
    }
    if ($bulan == '12') {
        $total = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan + $item->r_mei_keuangan + $item->r_juni_keuangan + $item->r_juli_keuangan + $item->r_agustus_keuangan + $item->r_september_keuangan + $item->r_oktober_keuangan + $item->r_november_keuangan + $item->r_desember_keuangan;
    }
    return $total;
}

function fisikRencana($bulan, $item)
{
    if ($bulan == '01') {
        $total = $item->p_januari_fisik;
    }
    if ($bulan == '02') {
        $total = $item->p_januari_fisik + $item->p_februari_fisik;
    }
    if ($bulan == '03') {
        $total = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik;
    }
    if ($bulan == '04') {
        $total = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik;
    }
    if ($bulan == '05') {
        $total = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik + $item->p_mei_fisik;
    }
    if ($bulan == '06') {
        $total = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik + $item->p_mei_fisik + $item->p_juni_fisik;
    }
    if ($bulan == '07') {
        $total = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik + $item->p_mei_fisik + $item->p_juni_fisik + $item->p_juli_fisik;
    }
    if ($bulan == '08') {
        $total = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik + $item->p_mei_fisik + $item->p_juni_fisik + $item->p_juli_fisik + $item->p_agustus_fisik;
    }
    if ($bulan == '09') {
        $total = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik + $item->p_mei_fisik + $item->p_juni_fisik + $item->p_juli_fisik + $item->p_agustus_fisik + $item->p_september_fisik;
    }
    if ($bulan == '10') {
        $total = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik + $item->p_mei_fisik + $item->p_juni_fisik + $item->p_juli_fisik + $item->p_agustus_fisik + $item->p_september_fisik + $item->p_oktober_fisik;
    }
    if ($bulan == '11') {
        $total = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik + $item->p_mei_fisik + $item->p_juni_fisik + $item->p_juli_fisik + $item->p_agustus_fisik + $item->p_september_fisik + $item->p_oktober_fisik + $item->p_november_fisik;
    }
    if ($bulan == '12') {
        $total = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik + $item->p_mei_fisik + $item->p_juni_fisik + $item->p_juli_fisik + $item->p_agustus_fisik + $item->p_september_fisik + $item->p_oktober_fisik + $item->p_november_fisik + $item->p_desember_fisik;
    }
    return $total;
}
function fisikRealisasi($bulan, $item)
{
    if ($bulan == '01') {
        $total = $item->r_januari_fisik;
    }
    if ($bulan == '02') {
        $total = $item->r_januari_fisik + $item->r_februari_fisik;
    }
    if ($bulan == '03') {
        $total = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik;
    }
    if ($bulan == '04') {
        $total = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik;
    }
    if ($bulan == '05') {
        $total = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik + $item->r_mei_fisik;
    }
    if ($bulan == '06') {
        $total = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik + $item->r_mei_fisik + $item->r_juni_fisik;
    }
    if ($bulan == '07') {
        $total = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik + $item->r_mei_fisik + $item->r_juni_fisik + $item->r_juli_fisik;
    }
    if ($bulan == '08') {
        $total = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik + $item->r_mei_fisik + $item->r_juni_fisik + $item->r_juli_fisik + $item->r_agustus_fisik;
    }
    if ($bulan == '09') {
        $total = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik + $item->r_mei_fisik + $item->r_juni_fisik + $item->r_juli_fisik + $item->r_agustus_fisik + $item->r_september_fisik;
    }
    if ($bulan == '10') {
        $total = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik + $item->r_mei_fisik + $item->r_juni_fisik + $item->r_juli_fisik + $item->r_agustus_fisik + $item->r_september_fisik + $item->r_oktober_fisik;
    }
    if ($bulan == '11') {
        $total = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik + $item->r_mei_fisik + $item->r_juni_fisik + $item->r_juli_fisik + $item->r_agustus_fisik + $item->r_september_fisik + $item->r_oktober_fisik + $item->r_november_fisik;
    }
    if ($bulan == '12') {
        $total = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik + $item->r_mei_fisik + $item->r_juni_fisik + $item->r_juli_fisik + $item->r_agustus_fisik + $item->r_september_fisik + $item->r_oktober_fisik + $item->r_november_fisik + $item->r_desember_fisik;
    }
    return $total;
}
