<?php

use App\Models\Uraian;
use App\Models\JenisRfk;
use App\Models\M_indikator;
use App\Models\T_capaian;
use Illuminate\Support\Facades\Auth;

function checkCapaian($skpd_id, $tahun, $kode, $jenis)
{
    $check = T_capaian::where('skpd_id', $skpd_id)->where('tahun', $tahun)->where('kode', $kode)->where('jenis', $jenis)->first();
    return $check;
}

function checkIndikator($kode, $jenis, $tahun)
{
    $check = M_indikator::where('kode', $kode)->where('jenis', $jenis)->where('tahun', $tahun)->get();
    return $check;
}
function tampilCapaian($skpd_id, $tahun, $kode, $jenis)
{
    $check = T_capaian::where('skpd_id', $skpd_id)->where('tahun', $tahun)->where('kode', $kode)->where('jenis', $jenis)->first();
    $data['capaian'] = 'TW 1 : ' . $check->tw1 . ', TW 2 : ' . $check->tw2 . ', TW 3 : ' . $check->tw3 . ', TW 4 : ' . $check->tw4;
    $data['tw1'] = $check->tw1;
    $data['tw2'] = $check->tw2;
    $data['tw3'] = $check->tw3;
    $data['tw4'] = $check->tw4;
    return $data;
}
function checkCapaianProgram($skpd_id, $tahun, $kode)
{
    $check = T_capaian::where('skpd_id', $skpd_id)->where('tahun', $tahun)->where('kode', $kode)->where('jenis', 'program')->first();
    if ($check == null) {
        return false;
    } else {
        return $check->capaian;
    }
}
function checkCapaianKegiatanTW1($skpd_id, $tahun, $kode)
{
    $check = T_capaian::where('skpd_id', $skpd_id)->where('tahun', $tahun)->where('kode', $kode)->where('jenis', 'kegiatan')->where('tw1', '!=', null)->first();

    if ($check == null) {
        return false;
    } else {
        return $check->capaian;
    }
}
function checkCapaianSubkegiatan($skpd_id, $tahun, $kode)
{
    $check = T_capaian::where('skpd_id', $skpd_id)->where('tahun', $tahun)->where('kode', $kode)->where('jenis', 'subkegiatan')->first();
    //dd($check);
    if ($check == null) {
        return false;
    } else {
        return $check->capaian;
    }
}

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

    if ($bulan == '01') {
        $jenisrfk = JenisRfk::where('tahun', $tahun)->first()->januari;
    }
    if ($bulan == '02') {
        $jenisrfk = JenisRfk::where('tahun', $tahun)->first()->februari;
    }
    if ($bulan == '03') {
        $jenisrfk = JenisRfk::where('tahun', $tahun)->first()->maret;
    }
    if ($bulan == '04') {
        $jenisrfk = JenisRfk::where('tahun', $tahun)->first()->april;
    }
    if ($bulan == '05') {
        $jenisrfk = JenisRfk::where('tahun', $tahun)->first()->mei;
    }
    if ($bulan == '06') {
        $jenisrfk = JenisRfk::where('tahun', $tahun)->first()->juni;
    }
    if ($bulan == '07') {
        $jenisrfk = JenisRfk::where('tahun', $tahun)->first()->juli;
    }
    if ($bulan == '08') {
        $jenisrfk = JenisRfk::where('tahun', $tahun)->first()->agustus;
    }
    if ($bulan == '09') {
        $jenisrfk = JenisRfk::where('tahun', $tahun)->first()->september;
    }
    if ($bulan == '10') {
        $jenisrfk = JenisRfk::where('tahun', $tahun)->first()->oktober;
    }
    if ($bulan == '11') {
        $jenisrfk = JenisRfk::where('tahun', $tahun)->first()->november;
    }
    if ($bulan == '12') {
        $jenisrfk = JenisRfk::where('tahun', $tahun)->first()->desember;
    }

    // $result = JenisRfk::where('tahun', $tahun)->where('skpd_id', Auth::user()->skpd->id)->first()[$bulan];
    return $jenisrfk;
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


function nomorBulan($bulan)
{
    if ($bulan == 'Januari') {
        $nama_bulan = '01';
    }
    if ($bulan == 'Februari') {
        $nama_bulan = '02';
    }
    if ($bulan == 'Maret') {
        $nama_bulan = '03';
    }
    if ($bulan == 'April') {
        $nama_bulan = '04';
    }
    if ($bulan == 'Mei') {
        $nama_bulan = '05';
    }
    if ($bulan == 'Juni') {
        $nama_bulan = '06';
    }
    if ($bulan == 'Juli') {
        $nama_bulan = '07';
    }
    if ($bulan == 'Agustus') {
        $nama_bulan = '08';
    }
    if ($bulan == 'September') {
        $nama_bulan = '09';
    }
    if ($bulan == 'Oktober') {
        $nama_bulan = '10';
    }
    if ($bulan == 'November') {
        $nama_bulan = '11';
    }
    if ($bulan == 'Desember') {
        $nama_bulan = '12';
    }
    return $nama_bulan;
}
function superadminRencanaFisik($bulan, $uraian)
{
    if ($bulan == '1') {
        $total = $uraian->p_januari_fisik;
    }
    if ($bulan == '2') {
        $total = $uraian->p_januari_fisik + $uraian->p_februari_fisik;
    }
    if ($bulan == '3') {
        $total = $uraian->p_januari_fisik + $uraian->p_februari_fisik + $uraian->p_maret_fisik;
    }
    if ($bulan == '4') {
        $total = $uraian->p_januari_fisik + $uraian->p_februari_fisik + $uraian->p_maret_fisik + $uraian->p_april_fisik;
    }
    if ($bulan == '5') {
        $total = $uraian->p_januari_fisik + $uraian->p_februari_fisik + $uraian->p_maret_fisik + $uraian->p_april_fisik + $uraian->p_mei_fisik;
    }
    if ($bulan == '6') {
        $total = $uraian->p_januari_fisik + $uraian->p_februari_fisik + $uraian->p_maret_fisik + $uraian->p_april_fisik + $uraian->p_mei_fisik + $uraian->p_juni_fisik;
    }
    if ($bulan == '7') {
        $total = $uraian->p_januari_fisik + $uraian->p_februari_fisik + $uraian->p_maret_fisik + $uraian->p_april_fisik + $uraian->p_mei_fisik + $uraian->p_juni_fisik + $uraian->p_juli_fisik;
    }
    if ($bulan == '8') {
        $total = $uraian->p_januari_fisik + $uraian->p_februari_fisik + $uraian->p_maret_fisik + $uraian->p_april_fisik + $uraian->p_mei_fisik + $uraian->p_juni_fisik + $uraian->p_juli_fisik + $uraian->p_agustus_fisik;
    }
    if ($bulan == '9') {
        $total = $uraian->p_januari_fisik + $uraian->p_februari_fisik + $uraian->p_maret_fisik + $uraian->p_april_fisik + $uraian->p_mei_fisik + $uraian->p_juni_fisik + $uraian->p_juli_fisik + $uraian->p_agustus_fisik + $uraian->p_september_fisik;
    }
    if ($bulan == '10') {
        $total = $uraian->p_januari_fisik + $uraian->p_februari_fisik + $uraian->p_maret_fisik + $uraian->p_april_fisik + $uraian->p_mei_fisik + $uraian->p_juni_fisik + $uraian->p_juli_fisik + $uraian->p_agustus_fisik + $uraian->p_september_fisik + $uraian->p_oktober_fisik;
    }
    if ($bulan == '11') {
        $total = $uraian->p_januari_fisik + $uraian->p_februari_fisik + $uraian->p_maret_fisik + $uraian->p_april_fisik + $uraian->p_mei_fisik + $uraian->p_juni_fisik + $uraian->p_juli_fisik + $uraian->p_agustus_fisik + $uraian->p_september_fisik + $uraian->p_oktober_fisik + $uraian->p_november_fisik;
    }
    if ($bulan == '12') {
        $total = $uraian->p_januari_fisik + $uraian->p_februari_fisik + $uraian->p_maret_fisik + $uraian->p_april_fisik + $uraian->p_mei_fisik + $uraian->p_juni_fisik + $uraian->p_juli_fisik + $uraian->p_agustus_fisik + $uraian->p_september_fisik + $uraian->p_oktober_fisik + $uraian->p_november_fisik + $uraian->p_desember_fisik;
    }
    //dd($uraian, $total, $uraian->sum('p_januari_fisik'), $uraian->sum('p_februari_fisik'), $uraian->sum('p_maret_fisik'), $uraian->sum('p_april_fisik'), $uraian->sum('p_mei_fisik'), $uraian->sum('p_juni_fisik'), $uraian->sum('p_juli_fisik'));
    return $total;
}
function superadminRealisasiFisik($bulan, $uraian)
{
    if ($bulan == '1') {
        $total = $uraian->r_januari_fisik;
    }
    if ($bulan == '2') {
        $total = $uraian->r_januari_fisik + $uraian->r_februari_fisik;
    }
    if ($bulan == '3') {
        $total = $uraian->r_januari_fisik + $uraian->r_februari_fisik + $uraian->r_maret_fisik;
    }
    if ($bulan == '4') {
        $total = $uraian->r_januari_fisik + $uraian->r_februari_fisik + $uraian->r_maret_fisik + $uraian->r_april_fisik;
    }
    if ($bulan == '5') {
        $total = $uraian->r_januari_fisik + $uraian->r_februari_fisik + $uraian->r_maret_fisik + $uraian->r_april_fisik + $uraian->r_mei_fisik;
    }
    if ($bulan == '6') {
        $total = $uraian->r_januari_fisik + $uraian->r_februari_fisik + $uraian->r_maret_fisik + $uraian->r_april_fisik + $uraian->r_mei_fisik + $uraian->r_juni_fisik;
    }
    if ($bulan == '7') {
        $total = $uraian->r_januari_fisik + $uraian->r_februari_fisik + $uraian->r_maret_fisik + $uraian->r_april_fisik + $uraian->r_mei_fisik + $uraian->r_juni_fisik + $uraian->r_juli_fisik;
    }
    if ($bulan == '8') {
        $total = $uraian->r_januari_fisik + $uraian->r_februari_fisik + $uraian->r_maret_fisik + $uraian->r_april_fisik + $uraian->r_mei_fisik + $uraian->r_juni_fisik + $uraian->r_juli_fisik + $uraian->r_agustus_fisik;
    }
    if ($bulan == '9') {
        $total = $uraian->r_januari_fisik + $uraian->r_februari_fisik + $uraian->r_maret_fisik + $uraian->r_april_fisik + $uraian->r_mei_fisik + $uraian->r_juni_fisik + $uraian->r_juli_fisik + $uraian->r_agustus_fisik + $uraian->r_september_fisik;
    }
    if ($bulan == '10') {
        $total = $uraian->r_januari_fisik + $uraian->r_februari_fisik + $uraian->r_maret_fisik + $uraian->r_april_fisik + $uraian->r_mei_fisik + $uraian->r_juni_fisik + $uraian->r_juli_fisik + $uraian->r_agustus_fisik + $uraian->r_september_fisik + $uraian->r_oktober_fisik;
    }
    if ($bulan == '11') {
        $total = $uraian->r_januari_fisik + $uraian->r_februari_fisik + $uraian->r_maret_fisik + $uraian->r_april_fisik + $uraian->r_mei_fisik + $uraian->r_juni_fisik + $uraian->r_juli_fisik + $uraian->r_agustus_fisik + $uraian->r_september_fisik + $uraian->r_oktober_fisik + $uraian->r_november_fisik;
    }
    if ($bulan == '12') {
        $total = $uraian->r_januari_fisik + $uraian->r_februari_fisik + $uraian->r_maret_fisik + $uraian->r_april_fisik + $uraian->r_mei_fisik + $uraian->r_juni_fisik + $uraian->r_juli_fisik + $uraian->r_agustus_fisik + $uraian->r_september_fisik + $uraian->r_oktober_fisik + $uraian->r_november_fisik + $uraian->r_desember_fisik;
    }
    return $total;
}

function superadminRencana($bulan, $uraian)
{
    if ($bulan == '1') {
        $total = $uraian->p_januari_keuangan;
    }
    if ($bulan == '2') {
        $total = $uraian->p_januari_keuangan + $uraian->p_februari_keuangan;
    }
    if ($bulan == '3') {
        $total = $uraian->p_januari_keuangan + $uraian->p_februari_keuangan + $uraian->p_maret_keuangan;
    }
    if ($bulan == '4') {
        $total = $uraian->p_januari_keuangan + $uraian->p_februari_keuangan + $uraian->p_maret_keuangan + $uraian->p_april_keuangan;
    }
    if ($bulan == '5') {
        $total = $uraian->p_januari_keuangan + $uraian->p_februari_keuangan + $uraian->p_maret_keuangan + $uraian->p_april_keuangan + $uraian->p_mei_keuangan;
    }
    if ($bulan == '6') {
        $total = $uraian->p_januari_keuangan + $uraian->p_februari_keuangan + $uraian->p_maret_keuangan + $uraian->p_april_keuangan + $uraian->p_mei_keuangan + $uraian->p_juni_keuangan;
    }
    if ($bulan == '7') {
        $total = $uraian->p_januari_keuangan + $uraian->p_februari_keuangan + $uraian->p_maret_keuangan + $uraian->p_april_keuangan + $uraian->p_mei_keuangan + $uraian->p_juni_keuangan + $uraian->p_juli_keuangan;
    }
    if ($bulan == '8') {
        $total = $uraian->p_januari_keuangan + $uraian->p_februari_keuangan + $uraian->p_maret_keuangan + $uraian->p_april_keuangan + $uraian->p_mei_keuangan + $uraian->p_juni_keuangan + $uraian->p_juli_keuangan + $uraian->p_agustus_keuangan;
    }
    if ($bulan == '9') {
        $total = $uraian->p_januari_keuangan + $uraian->p_februari_keuangan + $uraian->p_maret_keuangan + $uraian->p_april_keuangan + $uraian->p_mei_keuangan + $uraian->p_juni_keuangan + $uraian->p_juli_keuangan + $uraian->p_agustus_keuangan + $uraian->p_september_keuangan;
    }
    if ($bulan == '10') {
        $total = $uraian->p_januari_keuangan + $uraian->p_februari_keuangan + $uraian->p_maret_keuangan + $uraian->p_april_keuangan + $uraian->p_mei_keuangan + $uraian->p_juni_keuangan + $uraian->p_juli_keuangan + $uraian->p_agustus_keuangan + $uraian->p_september_keuangan + $uraian->p_oktober_keuangan;
    }
    if ($bulan == '11') {
        $total = $uraian->p_januari_keuangan + $uraian->p_februari_keuangan + $uraian->p_maret_keuangan + $uraian->p_april_keuangan + $uraian->p_mei_keuangan + $uraian->p_juni_keuangan + $uraian->p_juli_keuangan + $uraian->p_agustus_keuangan + $uraian->p_september_keuangan + $uraian->p_oktober_keuangan + $uraian->p_november_keuangan;
    }
    if ($bulan == '12') {
        $total = $uraian->p_januari_keuangan + $uraian->p_februari_keuangan + $uraian->p_maret_keuangan + $uraian->p_april_keuangan + $uraian->p_mei_keuangan + $uraian->p_juni_keuangan + $uraian->p_juli_keuangan + $uraian->p_agustus_keuangan + $uraian->p_september_keuangan + $uraian->p_oktober_keuangan + $uraian->p_november_keuangan + $uraian->p_desember_keuangan;
    }
    return $total;
}
function superadminRealisasi($bulan, $uraian)
{
    if ($bulan == '1' || $bulan == 'Januari') {
        $total = $uraian->r_januari_keuangan;
    }
    if ($bulan == '2' || $bulan == 'Februari') {
        $total = $uraian->r_januari_keuangan + $uraian->r_februari_keuangan;
    }
    if ($bulan == '3' || $bulan == 'Maret') {
        $total = $uraian->r_januari_keuangan + $uraian->r_februari_keuangan + $uraian->r_maret_keuangan;
    }
    if ($bulan == '4' || $bulan == 'April') {
        $total = $uraian->r_januari_keuangan + $uraian->r_februari_keuangan + $uraian->r_maret_keuangan + $uraian->r_april_keuangan;
    }
    if ($bulan == '5' || $bulan == 'Mei') {
        $total = $uraian->r_januari_keuangan + $uraian->r_februari_keuangan + $uraian->r_maret_keuangan + $uraian->r_april_keuangan + $uraian->r_mei_keuangan;
    }
    if ($bulan == '6' || $bulan == 'Juni') {
        $total = $uraian->r_januari_keuangan + $uraian->r_februari_keuangan + $uraian->r_maret_keuangan + $uraian->r_april_keuangan + $uraian->r_mei_keuangan + $uraian->r_juni_keuangan;
    }
    if ($bulan == '7' || $bulan == 'Juli') {
        $total = $uraian->r_januari_keuangan + $uraian->r_februari_keuangan + $uraian->r_maret_keuangan + $uraian->r_april_keuangan + $uraian->r_mei_keuangan + $uraian->r_juni_keuangan + $uraian->r_juli_keuangan;
    }
    if ($bulan == '8' || $bulan == 'Agustus') {
        $total = $uraian->r_januari_keuangan + $uraian->r_februari_keuangan + $uraian->r_maret_keuangan + $uraian->r_april_keuangan + $uraian->r_mei_keuangan + $uraian->r_juni_keuangan + $uraian->r_juli_keuangan + $uraian->r_agustus_keuangan;
    }
    if ($bulan == '9' || $bulan == 'September') {
        $total = $uraian->r_januari_keuangan + $uraian->r_februari_keuangan + $uraian->r_maret_keuangan + $uraian->r_april_keuangan + $uraian->r_mei_keuangan + $uraian->r_juni_keuangan + $uraian->r_juli_keuangan + $uraian->r_agustus_keuangan + $uraian->r_september_keuangan;
    }
    if ($bulan == '10' || $bulan == 'Oktober') {
        $total = $uraian->r_januari_keuangan + $uraian->r_februari_keuangan + $uraian->r_maret_keuangan + $uraian->r_april_keuangan + $uraian->r_mei_keuangan + $uraian->r_juni_keuangan + $uraian->r_juli_keuangan + $uraian->r_agustus_keuangan + $uraian->r_september_keuangan + $uraian->r_oktober_keuangan;
    }
    if ($bulan == '11' || $bulan == 'November') {
        $total = $uraian->r_januari_keuangan + $uraian->r_februari_keuangan + $uraian->r_maret_keuangan + $uraian->r_april_keuangan + $uraian->r_mei_keuangan + $uraian->r_juni_keuangan + $uraian->r_juli_keuangan + $uraian->r_agustus_keuangan + $uraian->r_september_keuangan + $uraian->r_oktober_keuangan + $uraian->r_november_keuangan;
    }
    if ($bulan == '12' || $bulan == 'Desember') {
        $total = $uraian->r_januari_keuangan + $uraian->r_februari_keuangan + $uraian->r_maret_keuangan + $uraian->r_april_keuangan + $uraian->r_mei_keuangan + $uraian->r_juni_keuangan + $uraian->r_juli_keuangan + $uraian->r_agustus_keuangan + $uraian->r_september_keuangan + $uraian->r_oktober_keuangan + $uraian->r_november_keuangan + $uraian->r_desember_keuangan;
    }

    return $total;
}
function rencanaSKPD($bulan, $item, $jenisrfk)
{
    $uraian = $item->uraian->where('jenis_rfk', $jenisrfk);
    if ($bulan == 'januari' || $bulan == '1') {
        $total = $uraian->sum('p_januari_keuangan');
    }
    if ($bulan == 'februari' || $bulan == '2') {
        $total = $uraian->sum('p_januari_keuangan') + $uraian->sum('p_februari_keuangan');
    }
    if ($bulan == 'maret' || $bulan == '3') {
        $total = $uraian->sum('p_januari_keuangan') + $uraian->sum('p_februari_keuangan') + $uraian->sum('p_maret_keuangan');
    }
    if ($bulan == 'april' || $bulan == '4') {
        $total = $uraian->sum('p_januari_keuangan') + $uraian->sum('p_februari_keuangan') + $uraian->sum('p_maret_keuangan') + $uraian->sum('p_april_keuangan');
    }
    if ($bulan == 'mei' || $bulan == '5') {
        $total = $uraian->sum('p_januari_keuangan') + $uraian->sum('p_februari_keuangan') + $uraian->sum('p_maret_keuangan') + $uraian->sum('p_april_keuangan') + $uraian->sum('p_mei_keuangan');
    }
    if ($bulan == 'juni' || $bulan == '6') {
        $total = $uraian->sum('p_januari_keuangan') + $uraian->sum('p_februari_keuangan') + $uraian->sum('p_maret_keuangan') + $uraian->sum('p_april_keuangan') + $uraian->sum('p_mei_keuangan') + $uraian->sum('p_juni_keuangan');
    }
    if ($bulan == 'juli' || $bulan == '7') {
        $total = $uraian->sum('p_januari_keuangan') + $uraian->sum('p_februari_keuangan') + $uraian->sum('p_maret_keuangan') + $uraian->sum('p_april_keuangan') + $uraian->sum('p_mei_keuangan') + $uraian->sum('p_juni_keuangan') + $uraian->sum('p_juli_keuangan');
    }
    if ($bulan == 'agustus' || $bulan == '8') {
        $total = $uraian->sum('p_januari_keuangan') + $uraian->sum('p_februari_keuangan') + $uraian->sum('p_maret_keuangan') + $uraian->sum('p_april_keuangan') + $uraian->sum('p_mei_keuangan') + $uraian->sum('p_juni_keuangan') + $uraian->sum('p_juli_keuangan') + $uraian->sum('p_agustus_keuangan');
    }
    if ($bulan == 'september' || $bulan == '9') {
        $total = $uraian->sum('p_januari_keuangan') + $uraian->sum('p_februari_keuangan') + $uraian->sum('p_maret_keuangan') + $uraian->sum('p_april_keuangan') + $uraian->sum('p_mei_keuangan') + $uraian->sum('p_juni_keuangan') + $uraian->sum('p_juli_keuangan') + $uraian->sum('p_agustus_keuangan') + $uraian->sum('p_september_keuangan');
    }
    if ($bulan == 'oktober' || $bulan == '10') {
        $total = $uraian->sum('p_januari_keuangan') + $uraian->sum('p_februari_keuangan') + $uraian->sum('p_maret_keuangan') + $uraian->sum('p_april_keuangan') + $uraian->sum('p_mei_keuangan') + $uraian->sum('p_juni_keuangan') + $uraian->sum('p_juli_keuangan') + $uraian->sum('p_agustus_keuangan') + $uraian->sum('p_september_keuangan') + $uraian->sum('p_oktober_keuangan');
    }
    if ($bulan == 'november' || $bulan == '11') {
        $total = $uraian->sum('p_januari_keuangan') + $uraian->sum('p_februari_keuangan') + $uraian->sum('p_maret_keuangan') + $uraian->sum('p_april_keuangan') + $uraian->sum('p_mei_keuangan') + $uraian->sum('p_juni_keuangan') + $uraian->sum('p_juli_keuangan') + $uraian->sum('p_agustus_keuangan') + $uraian->sum('p_september_keuangan') + $uraian->sum('p_oktober_keuangan') + $uraian->sum('p_november_keuangan');
    }
    if ($bulan == 'desember' || $bulan == '12') {
        $total = $uraian->sum('p_januari_keuangan') + $uraian->sum('p_februari_keuangan') + $uraian->sum('p_maret_keuangan') + $uraian->sum('p_april_keuangan') + $uraian->sum('p_mei_keuangan') + $uraian->sum('p_juni_keuangan') + $uraian->sum('p_juli_keuangan') + $uraian->sum('p_agustus_keuangan') + $uraian->sum('p_september_keuangan') + $uraian->sum('p_oktober_keuangan') + $uraian->sum('p_november_keuangan') + $uraian->sum('p_desember_keuangan');
    }
    return $total;
}
function realisasiSKPDTriwulan($bulan, $item, $jenisrfk)
{
    $uraian = $item->uraian->where('jenis_rfk', $jenisrfk);
    $data['tw1'] = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan');
    $data['tw2'] = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan') + $uraian->sum('r_april_keuangan') + $uraian->sum('r_mei_keuangan') + $uraian->sum('r_juni_keuangan');
    $data['tw3'] = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan') + $uraian->sum('r_april_keuangan') + $uraian->sum('r_mei_keuangan') + $uraian->sum('r_juni_keuangan') + $uraian->sum('r_juli_keuangan') + $uraian->sum('r_agustus_keuangan') + $uraian->sum('r_september_keuangan');
    $data['tw4'] = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan') + $uraian->sum('r_april_keuangan') + $uraian->sum('r_mei_keuangan') + $uraian->sum('r_juni_keuangan') + $uraian->sum('r_juli_keuangan') + $uraian->sum('r_agustus_keuangan') + $uraian->sum('r_september_keuangan') + $uraian->sum('r_oktober_keuangan') + $uraian->sum('r_november_keuangan') + $uraian->sum('r_desember_keuangan');
    return $data;
}
function realisasiSKPD($bulan, $item, $jenisrfk)
{
    $uraian = $item->uraian->where('jenis_rfk', $jenisrfk);

    if ($bulan == 'januari' || $bulan == 'Januari' || $bulan == '1') {
        $total = $uraian->sum('r_januari_keuangan');
    }
    if ($bulan == 'februari' || $bulan == 'Februari' || $bulan == '2') {
        $total = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan');
    }
    if ($bulan == 'maret' || $bulan == 'Maret' || $bulan == '3') {
        $total = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan');
    }
    if ($bulan == 'april' || $bulan == 'April' || $bulan == '4') {
        $total = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan') + $uraian->sum('r_april_keuangan');
    }
    if ($bulan == 'mei' || $bulan == 'Mei' || $bulan == '5') {
        $total = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan') + $uraian->sum('r_april_keuangan') + $uraian->sum('r_mei_keuangan');
    }
    if ($bulan == 'juni' || $bulan == 'Juni' || $bulan == '6') {
        $total = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan') + $uraian->sum('r_april_keuangan') + $uraian->sum('r_mei_keuangan') + $uraian->sum('r_juni_keuangan');
    }
    if ($bulan == 'juli' || $bulan == 'Juli' || $bulan == '7') {
        $total = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan') + $uraian->sum('r_april_keuangan') + $uraian->sum('r_mei_keuangan') + $uraian->sum('r_juni_keuangan') + $uraian->sum('r_juli_keuangan');
    }
    if ($bulan == 'agustus' || $bulan == 'Agustus' || $bulan == '8') {
        $total = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan') + $uraian->sum('r_april_keuangan') + $uraian->sum('r_mei_keuangan') + $uraian->sum('r_juni_keuangan') + $uraian->sum('r_juli_keuangan') + $uraian->sum('r_agustus_keuangan');
    }
    if ($bulan == 'september' || $bulan == 'September' || $bulan == '9') {
        $total = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan') + $uraian->sum('r_april_keuangan') + $uraian->sum('r_mei_keuangan') + $uraian->sum('r_juni_keuangan') + $uraian->sum('r_juli_keuangan') + $uraian->sum('r_agustus_keuangan') + $uraian->sum('r_september_keuangan');
    }
    if ($bulan == 'oktober' || $bulan == 'Oktober' || $bulan == '10') {
        $total = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan') + $uraian->sum('r_april_keuangan') + $uraian->sum('r_mei_keuangan') + $uraian->sum('r_juni_keuangan') + $uraian->sum('r_juli_keuangan') + $uraian->sum('r_agustus_keuangan') + $uraian->sum('r_september_keuangan') + $uraian->sum('r_oktober_keuangan');
    }
    if ($bulan == 'november' || $bulan == 'November' || $bulan == '11') {
        $total = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan') + $uraian->sum('r_april_keuangan') + $uraian->sum('r_mei_keuangan') + $uraian->sum('r_juni_keuangan') + $uraian->sum('r_juli_keuangan') + $uraian->sum('r_agustus_keuangan') + $uraian->sum('r_september_keuangan') + $uraian->sum('r_oktober_keuangan') + $uraian->sum('r_november_keuangan');
    }
    if ($bulan == 'desember' || $bulan == 'Desember' || $bulan == '12') {
        $total = $uraian->sum('r_januari_keuangan') + $uraian->sum('r_februari_keuangan') + $uraian->sum('r_maret_keuangan') + $uraian->sum('r_april_keuangan') + $uraian->sum('r_mei_keuangan') + $uraian->sum('r_juni_keuangan') + $uraian->sum('r_juli_keuangan') + $uraian->sum('r_agustus_keuangan') + $uraian->sum('r_september_keuangan') + $uraian->sum('r_oktober_keuangan') + $uraian->sum('r_november_keuangan') + $uraian->sum('r_desember_keuangan');
    }

    return $total;
}

function rencanaKumSkpd($subkegiatan_id, $jenisrfk, $bulan)
{
    $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('jenis_rfk', $jenisrfk)->get();

    $totalDPA = $data->sum('dpa');

    $data->map(function ($item) use ($totalDPA, $bulan) {

        if ($item->dpa == 0) {
            $item->persenDPA = 0;
            $item->rencanaRP = 0;
            $item->rencanaKUM = 0;
            $item->rencanaTTB = 0;
            $item->realisasiRP = 0;
            $item->realisasiKUM = 0;
            $item->realisasiTTB = 0;
            $item->deviasiKUM = 0;
            $item->deviasiTTB = 0;
            $item->sisaAnggaran = 0;
            $item->capaianKeuangan = 0;

            $item->fisikRencanaKUM = 0;
            $item->fisikRencanaTTB = 0;
            $item->fisikRealisasiKUM = 0;
            $item->fisikRealisasiTTB = 0;
            $item->fisikDeviasiKUM = 0;
            $item->fisikDeviasiTTB = 0;
            $item->capaianFisik = 0;
        } else {
            $item->persenDPA = ($item->dpa / $totalDPA) * 100;
            $item->rencanaRP = totalRencana($bulan, $item);
            $item->rencanaKUM = ($item->rencanaRP / $item->dpa) * 100;
            $item->rencanaTTB = ($item->persenDPA * $item->rencanaKUM) / 100;
            $item->realisasiRP = totalRealisasi($bulan, $item);
            $item->realisasiKUM = ($item->realisasiRP / $item->dpa) * 100;
            $item->realisasiTTB = ($item->persenDPA * $item->realisasiKUM) / 100;
            $item->deviasiKUM =  $item->realisasiKUM - $item->rencanaKUM;
            $item->deviasiTTB = $item->realisasiTTB - $item->rencanaTTB;
            $item->sisaAnggaran = $item->dpa - $item->realisasiRP;
            if ($item->rencanaRP == 0) {
                $item->capaianKeuangan = 0;
            } else {
                $item->capaianKeuangan =  ($item->realisasiRP / $item->rencanaRP) * 100;
            }

            $item->fisikRencanaKUM = fisikRencana($bulan, $item);
            $item->fisikRencanaTTB = $item->fisikRencanaKUM * $item->persenDPA / 100;
            //dd($item->fisikRencanaTTB);
            $item->fisikRealisasiKUM = fisikRealisasi($bulan, $item);
            $item->fisikRealisasiTTB = $item->fisikRealisasiKUM * $item->persenDPA / 100;
            $item->fisikDeviasiKUM =  $item->fisikRealisasiKUM - $item->fisikRencanaKUM;
            $item->fisikDeviasiTTB =  $item->fisikRealisasiTTB - $item->fisikRencanaTTB;

            if ($item->fisikRencanaKUM == 0) {
                $item->capaianFisik = 0;
            } else {
                $item->capaianFisik =  ($item->fisikRealisasiKUM / $item->fisikRencanaKUM) * 100;
            }
        }
        return $item;
    });
    return $data->sum('fisikRencanaTTB');
}
function realisasiKumSkpd($subkegiatan_id, $jenisrfk, $bulan)
{
    $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('jenis_rfk', $jenisrfk)->get();

    $totalDPA = $data->sum('dpa');

    $data->map(function ($item) use ($totalDPA, $bulan) {

        if ($item->dpa == 0) {
            $item->persenDPA = 0;
            $item->rencanaRP = 0;
            $item->rencanaKUM = 0;
            $item->rencanaTTB = 0;
            $item->realisasiRP = 0;
            $item->realisasiKUM = 0;
            $item->realisasiTTB = 0;
            $item->deviasiKUM = 0;
            $item->deviasiTTB = 0;
            $item->sisaAnggaran = 0;
            $item->capaianKeuangan = 0;

            $item->fisikRencanaKUM = 0;
            $item->fisikRencanaTTB = 0;
            $item->fisikRealisasiKUM = 0;
            $item->fisikRealisasiTTB = 0;
            $item->fisikDeviasiKUM = 0;
            $item->fisikDeviasiTTB = 0;
            $item->capaianFisik = 0;
        } else {
            $item->persenDPA = ($item->dpa / $totalDPA) * 100;
            $item->rencanaRP = totalRencana($bulan, $item);
            $item->rencanaKUM = ($item->rencanaRP / $item->dpa) * 100;
            $item->rencanaTTB = ($item->persenDPA * $item->rencanaKUM) / 100;
            $item->realisasiRP = totalRealisasi($bulan, $item);
            $item->realisasiKUM = ($item->realisasiRP / $item->dpa) * 100;
            $item->realisasiTTB = ($item->persenDPA * $item->realisasiKUM) / 100;
            $item->deviasiKUM =  $item->realisasiKUM - $item->rencanaKUM;
            $item->deviasiTTB = $item->realisasiTTB - $item->rencanaTTB;
            $item->sisaAnggaran = $item->dpa - $item->realisasiRP;
            if ($item->rencanaRP == 0) {
                $item->capaianKeuangan = 0;
            } else {
                $item->capaianKeuangan =  ($item->realisasiRP / $item->rencanaRP) * 100;
            }

            $item->fisikRencanaKUM = fisikRencana($bulan, $item);
            $item->fisikRencanaTTB = $item->fisikRencanaKUM * $item->persenDPA / 100;
            //dd($item->fisikRencanaTTB);
            $item->fisikRealisasiKUM = fisikRealisasi($bulan, $item);
            $item->fisikRealisasiTTB = $item->fisikRealisasiKUM * $item->persenDPA / 100;
            $item->fisikDeviasiKUM =  $item->fisikRealisasiKUM - $item->fisikRencanaKUM;
            $item->fisikDeviasiTTB =  $item->fisikRealisasiTTB - $item->fisikRencanaTTB;

            if ($item->fisikRencanaKUM == 0) {
                $item->capaianFisik = 0;
            } else {
                $item->capaianFisik =  ($item->fisikRealisasiKUM / $item->fisikRencanaKUM) * 100;
            }
        }
        return $item;
    });
    return $data->sum('fisikRealisasiTTB');
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
    //dd($uraian, $total, $uraian->sum('p_januari_fisik'), $uraian->sum('p_februari_fisik'), $uraian->sum('p_maret_fisik'), $uraian->sum('p_april_fisik'), $uraian->sum('p_mei_fisik'), $uraian->sum('p_juni_fisik'), $uraian->sum('p_juli_fisik'));
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

    if ($bulan == '01' || $bulan == 'januari') {
        $total = $item->p_januari_keuangan;
    }
    if ($bulan == '02' || $bulan == 'februari') {
        $total = $item->p_januari_keuangan + $item->p_februari_keuangan;
    }
    if ($bulan == '03' || $bulan == 'maret') {
        $total = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan;
    }
    if ($bulan == '04' || $bulan == 'april') {
        $total = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan;
    }
    if ($bulan == '05' || $bulan == 'mei') {
        $total = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan;
    }
    if ($bulan == '06' || $bulan == 'juni') {
        $total = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan;
    }
    if ($bulan == '07' || $bulan == 'juli') {
        $total = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan + $item->p_juli_keuangan;
    }
    if ($bulan == '08' || $bulan == 'agustus') {
        $total = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan + $item->p_juli_keuangan + $item->p_agustus_keuangan;
    }
    if ($bulan == '09' || $bulan == 'september') {
        $total = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan + $item->p_juli_keuangan + $item->p_agustus_keuangan + $item->p_september_keuangan;
    }
    if ($bulan == '10' || $bulan == 'oktober') {
        $total = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan + $item->p_juli_keuangan + $item->p_agustus_keuangan + $item->p_september_keuangan + $item->p_oktober_keuangan;
    }
    if ($bulan == '11' || $bulan == 'november') {
        $total = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan + $item->p_juli_keuangan + $item->p_agustus_keuangan + $item->p_september_keuangan + $item->p_oktober_keuangan + $item->p_november_keuangan;
    }
    if ($bulan == '12' || $bulan == 'desember') {
        $total = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan + $item->p_juli_keuangan + $item->p_agustus_keuangan + $item->p_september_keuangan + $item->p_oktober_keuangan + $item->p_november_keuangan + $item->p_desember_keuangan;
    }
    return $total;
}


function totalRealisasi($bulan, $item)
{
    if ($bulan == '01' || $bulan == 'januari') {
        $total = $item->r_januari_keuangan;
    }
    if ($bulan == '02' || $bulan == 'februari') {
        $total = $item->r_januari_keuangan + $item->r_februari_keuangan;
    }
    if ($bulan == '03' || $bulan == 'maret') {
        $total = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan;
    }
    if ($bulan == '04' || $bulan == 'april') {
        $total = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan;
    }
    if ($bulan == '05' || $bulan == 'mei') {
        $total = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan + $item->r_mei_keuangan;
    }
    if ($bulan == '06' || $bulan == 'juni') {
        $total = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan + $item->r_mei_keuangan + $item->r_juni_keuangan;
    }
    if ($bulan == '07' || $bulan == 'juli') {
        $total = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan + $item->r_mei_keuangan + $item->r_juni_keuangan + $item->r_juli_keuangan;
    }
    if ($bulan == '08' || $bulan == 'agustus') {
        $total = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan + $item->r_mei_keuangan + $item->r_juni_keuangan + $item->r_juli_keuangan + $item->r_agustus_keuangan;
    }
    if ($bulan == '09' || $bulan == 'september') {
        $total = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan + $item->r_mei_keuangan + $item->r_juni_keuangan + $item->r_juli_keuangan + $item->r_agustus_keuangan + $item->r_september_keuangan;
    }
    if ($bulan == '10' || $bulan == 'oktober') {
        $total = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan + $item->r_mei_keuangan + $item->r_juni_keuangan + $item->r_juli_keuangan + $item->r_agustus_keuangan + $item->r_september_keuangan + $item->r_oktober_keuangan;
    }
    if ($bulan == '11' || $bulan == 'november') {
        $total = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan + $item->r_mei_keuangan + $item->r_juni_keuangan + $item->r_juli_keuangan + $item->r_agustus_keuangan + $item->r_september_keuangan + $item->r_oktober_keuangan + $item->r_november_keuangan;
    }
    if ($bulan == '12' || $bulan == 'desember') {
        $total = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan + $item->r_mei_keuangan + $item->r_juni_keuangan + $item->r_juli_keuangan + $item->r_agustus_keuangan + $item->r_september_keuangan + $item->r_oktober_keuangan + $item->r_november_keuangan + $item->r_desember_keuangan;
    }
    return $total;
}

function fisikRencana($bulan, $item)
{
    if ($bulan == '01' || $bulan == 'januari') {
        $total = $item->p_januari_fisik;
    }
    if ($bulan == '02' || $bulan == 'februari') {
        $total = $item->p_januari_fisik + $item->p_februari_fisik;
    }
    if ($bulan == '03' || $bulan == 'maret') {
        $total = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik;
    }
    if ($bulan == '04' || $bulan == 'april') {
        $total = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik;
    }
    if ($bulan == '05' || $bulan == 'mei') {
        $total = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik + $item->p_mei_fisik;
    }
    if ($bulan == '06' || $bulan == 'juni') {
        $total = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik + $item->p_mei_fisik + $item->p_juni_fisik;
    }
    if ($bulan == '07' || $bulan == 'juli') {
        $total = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik + $item->p_mei_fisik + $item->p_juni_fisik + $item->p_juli_fisik;
    }
    if ($bulan == '08' || $bulan == 'agustus') {
        $total = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik + $item->p_mei_fisik + $item->p_juni_fisik + $item->p_juli_fisik + $item->p_agustus_fisik;
    }
    if ($bulan == '09' || $bulan == 'september') {
        $total = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik + $item->p_mei_fisik + $item->p_juni_fisik + $item->p_juli_fisik + $item->p_agustus_fisik + $item->p_september_fisik;
    }
    if ($bulan == '10' || $bulan == 'oktober') {
        $total = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik + $item->p_mei_fisik + $item->p_juni_fisik + $item->p_juli_fisik + $item->p_agustus_fisik + $item->p_september_fisik + $item->p_oktober_fisik;
    }
    if ($bulan == '11' || $bulan == 'november') {
        $total = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik + $item->p_mei_fisik + $item->p_juni_fisik + $item->p_juli_fisik + $item->p_agustus_fisik + $item->p_september_fisik + $item->p_oktober_fisik + $item->p_november_fisik;
    }
    if ($bulan == '12' || $bulan == 'desember') {
        $total = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik + $item->p_mei_fisik + $item->p_juni_fisik + $item->p_juli_fisik + $item->p_agustus_fisik + $item->p_september_fisik + $item->p_oktober_fisik + $item->p_november_fisik + $item->p_desember_fisik;
    }
    return $total;
}
function fisikRealisasi($bulan, $item)
{
    if ($bulan == '01' || $bulan == 'januari') {
        $total = $item->r_januari_fisik;
    }
    if ($bulan == '02' || $bulan == 'februari') {
        $total = $item->r_januari_fisik + $item->r_februari_fisik;
    }
    if ($bulan == '03' || $bulan == 'maret') {
        $total = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik;
    }
    if ($bulan == '04' || $bulan == 'april') {
        $total = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik;
    }
    if ($bulan == '05' || $bulan == 'mei') {
        $total = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik + $item->r_mei_fisik;
    }
    if ($bulan == '06' || $bulan == 'juni') {
        $total = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik + $item->r_mei_fisik + $item->r_juni_fisik;
    }
    if ($bulan == '07' || $bulan == 'juli') {
        $total = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik + $item->r_mei_fisik + $item->r_juni_fisik + $item->r_juli_fisik;
    }
    if ($bulan == '08' || $bulan == 'agustus') {
        $total = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik + $item->r_mei_fisik + $item->r_juni_fisik + $item->r_juli_fisik + $item->r_agustus_fisik;
    }
    if ($bulan == '09' || $bulan == 'september') {
        $total = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik + $item->r_mei_fisik + $item->r_juni_fisik + $item->r_juli_fisik + $item->r_agustus_fisik + $item->r_september_fisik;
    }
    if ($bulan == '10' || $bulan == 'oktober') {
        $total = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik + $item->r_mei_fisik + $item->r_juni_fisik + $item->r_juli_fisik + $item->r_agustus_fisik + $item->r_september_fisik + $item->r_oktober_fisik;
    }
    if ($bulan == '11' || $bulan == 'november') {
        $total = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik + $item->r_mei_fisik + $item->r_juni_fisik + $item->r_juli_fisik + $item->r_agustus_fisik + $item->r_september_fisik + $item->r_oktober_fisik + $item->r_november_fisik;
    }
    if ($bulan == '12' || $bulan == 'desember') {
        $total = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik + $item->r_mei_fisik + $item->r_juni_fisik + $item->r_juli_fisik + $item->r_agustus_fisik + $item->r_september_fisik + $item->r_oktober_fisik + $item->r_november_fisik + $item->r_desember_fisik;
    }
    return $total;
}
