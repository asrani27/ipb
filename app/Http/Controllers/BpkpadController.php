<?php

namespace App\Http\Controllers;

use App\Models\Skpd;
use App\Models\Uraian;
use App\Models\Pengajuan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BpkpadController extends Controller
{
    public function index()
    {
        $tampil = false;
        $skpd = Skpd::get();
        $param = null;
        return view('bpkpad.home', compact('tampil', 'skpd', 'param'));
    }
    public function fisik()
    {
        $tampil = false;
        $skpd = Skpd::get();
        $fisik = null;
        return view('bpkpad.fisik', compact('tampil', 'skpd', 'fisik'));
    }
    public function keuangan()
    {
        $tampil = false;
        $skpd = Skpd::get();
        $param = null;
        return view('bpkpad.keuangan', compact('tampil', 'skpd', 'param'));
    }
    public function laporanpdf()
    {
        $tampil = false;
        $skpd = Skpd::get();
        $param = null;
        return view('bpkpad.home', compact('tampil', 'skpd', 'param'));
    }

    public function tampilkanFisik()
    {

        $tahun = request()->get('tahun');
        $skpd_id = request()->get('skpd_id');

        if ($skpd_id == null) {
            $data = collect();
            $skpd = Skpd::get();
            $skpd->map(function ($item) use ($skpd, $tahun) {
                $pergeseran_ke = Pengajuan::where('skpd_id', $item->id)->where('tahun', $tahun)->latest()->first();
                if ($pergeseran_ke == null) {
                    $item->p_ke = null;
                } else {
                    $item->p_ke = $pergeseran_ke->ke;
                }
                return $item->p_ke;
            });
            foreach ($skpd as $dinas) {
                $uraian = Uraian::where('tahun', $tahun)->where('skpd_id', $dinas->id)->where('jenis_rfk', 'pergeseran')->where('ke', $dinas->p_ke)->chunk(1000, function ($uraianChunk) use (&$data) {
                    $data = $data->merge($uraianChunk);
                });
            }
        } else {
            $pergeseran_ke = Pengajuan::where('skpd_id', $skpd_id)->where('tahun', $tahun)->latest()->first()->ke;

            $data = Uraian::where('tahun', $tahun)->where('skpd_id', $skpd_id)->where('jenis_rfk', 'pergeseran')->where('ke', $pergeseran_ke)->get();
        }

        $bo = $data->filter(function ($item) {
            return Str::startsWith($item->kode_rekening, '5.1'); // Cek apakah kode_rekening dimulai dengan '5.1'
        })->values(); // Atur ulang kunci array setelah filter

        $bm = $data->filter(function ($item) {
            return Str::startsWith($item->kode_rekening, '5.2'); // Cek apakah kode_rekening dimulai dengan '5.2'
        })->values(); // Atur ulang kunci array setelah filter

        $btt = $data->filter(function ($item) {
            return Str::startsWith($item->kode_rekening, '5.3'); // Cek apakah kode_rekening dimulai dengan '5.2'
        })->values(); // Atur ulang kunci array setelah filter

        $bt = $data->filter(function ($item) {
            return Str::startsWith($item->kode_rekening, '5.4'); // Cek apakah kode_rekening dimulai dengan '5.2'
        })->values(); // Atur ulang kunci array setelah filter
        // Jika kamu ingin melihat hasilnya


        $fisik['Belanja Operasi'] = [
            'p_januari'     =>  $bo->sum('p_januari_fisik'),
            'p_februari'    =>  $bo->sum('p_februari_fisik'),
            'p_maret'       =>  $bo->sum('p_maret_fisik'),
            'p_april'       =>  $bo->sum('p_april_fisik'),
            'p_mei'         =>  $bo->sum('p_mei_fisik'),
            'p_juni'        =>  $bo->sum('p_juni_fisik'),
            'p_juli'        =>  $bo->sum('p_juli_fisik'),
            'p_agustus'     =>  $bo->sum('p_agustus_fisik'),
            'p_september'   =>  $bo->sum('p_september_fisik'),
            'p_oktober'     =>  $bo->sum('p_oktober_fisik'),
            'p_november'    =>  $bo->sum('p_november_fisik'),
            'p_desember'    =>  $bo->sum('p_desember_fisik'),
            'r_januari'     =>  $bo->sum('r_januari_fisik'),
            'r_februari'    =>  $bo->sum('r_februari_fisik'),
            'r_maret'       =>  $bo->sum('r_maret_fisik'),
            'r_april'       =>  $bo->sum('r_april_fisik'),
            'r_mei'         =>  $bo->sum('r_mei_fisik'),
            'r_juni'        =>  $bo->sum('r_juni_fisik'),
            'r_juli'        =>  $bo->sum('r_juli_fisik'),
            'r_agustus'     =>  $bo->sum('r_agustus_fisik'),
            'r_september'   =>  $bo->sum('r_september_fisik'),
            'r_oktober'     =>  $bo->sum('r_oktober_fisik'),
            'r_november'    =>  $bo->sum('r_november_fisik'),
            'r_desember'    =>  $bo->sum('r_desember_fisik')
        ];
        $fisik['Belanja Modal'] = [
            'p_januari'     =>  $bm->sum('p_januari_fisik'),
            'p_februari'    =>  $bm->sum('p_februari_fisik'),
            'p_maret'       =>  $bm->sum('p_maret_fisik'),
            'p_april'       =>  $bm->sum('p_april_fisik'),
            'p_mei'         =>  $bm->sum('p_mei_fisik'),
            'p_juni'        =>  $bm->sum('p_juni_fisik'),
            'p_juli'        =>  $bm->sum('p_juli_fisik'),
            'p_agustus'     =>  $bm->sum('p_agustus_fisik'),
            'p_september'   =>  $bm->sum('p_september_fisik'),
            'p_oktober'     =>  $bm->sum('p_oktober_fisik'),
            'p_november'    =>  $bm->sum('p_november_fisik'),
            'p_desember'    =>  $bm->sum('p_desember_fisik'),
            'r_januari'     =>  $bm->sum('r_januari_fisik'),
            'r_februari'    =>  $bm->sum('r_februari_fisik'),
            'r_maret'       =>  $bm->sum('r_maret_fisik'),
            'r_april'       =>  $bm->sum('r_april_fisik'),
            'r_mei'         =>  $bm->sum('r_mei_fisik'),
            'r_juni'        =>  $bm->sum('r_juni_fisik'),
            'r_juli'        =>  $bm->sum('r_juli_fisik'),
            'r_agustus'     =>  $bm->sum('r_agustus_fisik'),
            'r_september'   =>  $bm->sum('r_september_fisik'),
            'r_oktober'     =>  $bm->sum('r_oktober_fisik'),
            'r_november'    =>  $bm->sum('r_november_fisik'),
            'r_desember'    =>  $bm->sum('r_desember_fisik')
        ];
        $fisik['Belanja Tidak Terduga'] = [
            'p_januari'     =>  $btt->sum('p_januari_fisik'),
            'p_februari'    =>  $btt->sum('p_februari_fisik'),
            'p_maret'       =>  $btt->sum('p_maret_fisik'),
            'p_april'       =>  $btt->sum('p_april_fisik'),
            'p_mei'         =>  $btt->sum('p_mei_fisik'),
            'p_juni'        =>  $btt->sum('p_juni_fisik'),
            'p_juli'        =>  $btt->sum('p_juli_fisik'),
            'p_agustus'     =>  $btt->sum('p_agustus_fisik'),
            'p_september'   =>  $btt->sum('p_september_fisik'),
            'p_oktober'     =>  $btt->sum('p_oktober_fisik'),
            'p_november'    =>  $btt->sum('p_november_fisik'),
            'p_desember'    =>  $btt->sum('p_desember_fisik'),
            'r_januari'     =>  $btt->sum('r_januari_fisik'),
            'r_februari'    =>  $btt->sum('r_februari_fisik'),
            'r_maret'       =>  $btt->sum('r_maret_fisik'),
            'r_april'       =>  $btt->sum('r_april_fisik'),
            'r_mei'         =>  $btt->sum('r_mei_fisik'),
            'r_juni'        =>  $btt->sum('r_juni_fisik'),
            'r_juli'        =>  $btt->sum('r_juli_fisik'),
            'r_agustus'     =>  $btt->sum('r_agustus_fisik'),
            'r_september'   =>  $btt->sum('r_september_fisik'),
            'r_oktober'     =>  $btt->sum('r_oktober_fisik'),
            'r_november'    =>  $btt->sum('r_november_fisik'),
            'r_desember'    =>  $btt->sum('r_desember_fisik')
        ];
        $fisik['Belanja Transfer'] = [
            'p_januari'     =>  $bt->sum('p_januari_fisik'),
            'p_februari'    =>  $bt->sum('p_februari_fisik'),
            'p_maret'       =>  $bt->sum('p_maret_fisik'),
            'p_april'       =>  $bt->sum('p_april_fisik'),
            'p_mei'         =>  $bt->sum('p_mei_fisik'),
            'p_juni'        =>  $bt->sum('p_juni_fisik'),
            'p_juli'        =>  $bt->sum('p_juli_fisik'),
            'p_agustus'     =>  $bt->sum('p_agustus_fisik'),
            'p_september'   =>  $bt->sum('p_september_fisik'),
            'p_oktober'     =>  $bt->sum('p_oktober_fisik'),
            'p_november'    =>  $bt->sum('p_november_fisik'),
            'p_desember'    =>  $bt->sum('p_desember_fisik'),
            'r_januari'     =>  $bt->sum('r_januari_fisik'),
            'r_februari'    =>  $bt->sum('r_februari_fisik'),
            'r_maret'       =>  $bt->sum('r_maret_fisik'),
            'r_april'       =>  $bt->sum('r_april_fisik'),
            'r_mei'         =>  $bt->sum('r_mei_fisik'),
            'r_juni'        =>  $bt->sum('r_juni_fisik'),
            'r_juli'        =>  $bt->sum('r_juli_fisik'),
            'r_agustus'     =>  $bt->sum('r_agustus_fisik'),
            'r_september'   =>  $bt->sum('r_september_fisik'),
            'r_oktober'     =>  $bt->sum('r_oktober_fisik'),
            'r_november'    =>  $bt->sum('r_november_fisik'),
            'r_desember'    =>  $bt->sum('r_desember_fisik')
        ];

        //dd($param['Belanja Operasi']['p_januari']);
        $skpd = Skpd::get();
        $tampil = true;
        request()->flash();
        return view('bpkpad.fisik', compact('data', 'tampil', 'skpd', 'fisik'));
    }

    public function tampilkanKeuangan()
    {

        $tahun = request()->get('tahun');
        $skpd_id = request()->get('skpd_id');

        if ($skpd_id == null) {
            $data = collect();
            $skpd = Skpd::get();
            $skpd->map(function ($item) use ($skpd, $tahun) {
                $pergeseran_ke = Pengajuan::where('skpd_id', $item->id)->where('tahun', $tahun)->latest()->first();
                if ($pergeseran_ke == null) {
                    $item->p_ke = null;
                } else {
                    $item->p_ke = $pergeseran_ke->ke;
                }
                return $item->p_ke;
            });
            foreach ($skpd as $dinas) {
                $uraian = Uraian::where('tahun', $tahun)->where('skpd_id', $dinas->id)->where('jenis_rfk', 'pergeseran')->where('ke', $dinas->p_ke)->chunk(1000, function ($uraianChunk) use (&$data) {
                    $data = $data->merge($uraianChunk);
                });
            }
        } else {
            $pergeseran_ke = Pengajuan::where('skpd_id', $skpd_id)->where('tahun', $tahun)->latest()->first()->ke;

            $data = Uraian::where('tahun', $tahun)->where('skpd_id', $skpd_id)->where('jenis_rfk', 'pergeseran')->where('ke', $pergeseran_ke)->get();
        }

        // dd($data->take(10));
        $bo = $data->filter(function ($item) {
            return Str::startsWith($item->kode_rekening, '5.1'); // Cek apakah kode_rekening dimulai dengan '5.1'
        })->values(); // Atur ulang kunci array setelah filter

        $bm = $data->filter(function ($item) {
            return Str::startsWith($item->kode_rekening, '5.2'); // Cek apakah kode_rekening dimulai dengan '5.2'
        })->values(); // Atur ulang kunci array setelah filter

        $btt = $data->filter(function ($item) {
            return Str::startsWith($item->kode_rekening, '5.3'); // Cek apakah kode_rekening dimulai dengan '5.2'
        })->values(); // Atur ulang kunci array setelah filter

        $bt = $data->filter(function ($item) {
            return Str::startsWith($item->kode_rekening, '5.4'); // Cek apakah kode_rekening dimulai dengan '5.2'
        })->values(); // Atur ulang kunci array setelah filter
        // Jika kamu ingin melihat hasilnya

        $param['Belanja Operasi'] = [
            'p_januari'     =>  $bo->sum('p_januari_keuangan'),
            'p_februari'    =>  $bo->sum('p_februari_keuangan'),
            'p_maret'       =>  $bo->sum('p_maret_keuangan'),
            'p_april'       =>  $bo->sum('p_april_keuangan'),
            'p_mei'         =>  $bo->sum('p_mei_keuangan'),
            'p_juni'        =>  $bo->sum('p_juni_keuangan'),
            'p_juli'        =>  $bo->sum('p_juli_keuangan'),
            'p_agustus'     =>  $bo->sum('p_agustus_keuangan'),
            'p_september'   =>  $bo->sum('p_september_keuangan'),
            'p_oktober'     =>  $bo->sum('p_oktober_keuangan'),
            'p_november'    =>  $bo->sum('p_november_keuangan'),
            'p_desember'    =>  $bo->sum('p_desember_keuangan'),
            'r_januari'     =>  $bo->sum('r_januari_keuangan'),
            'r_februari'    =>  $bo->sum('r_februari_keuangan'),
            'r_maret'       =>  $bo->sum('r_maret_keuangan'),
            'r_april'       =>  $bo->sum('r_april_keuangan'),
            'r_mei'         =>  $bo->sum('r_mei_keuangan'),
            'r_juni'        =>  $bo->sum('r_juni_keuangan'),
            'r_juli'        =>  $bo->sum('r_juli_keuangan'),
            'r_agustus'     =>  $bo->sum('r_agustus_keuangan'),
            'r_september'   =>  $bo->sum('r_september_keuangan'),
            'r_oktober'     =>  $bo->sum('r_oktober_keuangan'),
            'r_november'    =>  $bo->sum('r_november_keuangan'),
            'r_desember'    =>  $bo->sum('r_desember_keuangan')
        ];


        $param['Belanja Modal'] = [
            'p_januari'     =>  $bm->sum('p_januari_keuangan'),
            'p_februari'    =>  $bm->sum('p_februari_keuangan'),
            'p_maret'       =>  $bm->sum('p_maret_keuangan'),
            'p_april'       =>  $bm->sum('p_april_keuangan'),
            'p_mei'         =>  $bm->sum('p_mei_keuangan'),
            'p_juni'        =>  $bm->sum('p_juni_keuangan'),
            'p_juli'        =>  $bm->sum('p_juli_keuangan'),
            'p_agustus'     =>  $bm->sum('p_agustus_keuangan'),
            'p_september'   =>  $bm->sum('p_september_keuangan'),
            'p_oktober'     =>  $bm->sum('p_oktober_keuangan'),
            'p_november'    =>  $bm->sum('p_november_keuangan'),
            'p_desember'    =>  $bm->sum('p_desember_keuangan'),
            'r_januari'     =>  $bm->sum('r_januari_keuangan'),
            'r_februari'    =>  $bm->sum('r_februari_keuangan'),
            'r_maret'       =>  $bm->sum('r_maret_keuangan'),
            'r_april'       =>  $bm->sum('r_april_keuangan'),
            'r_mei'         =>  $bm->sum('r_mei_keuangan'),
            'r_juni'        =>  $bm->sum('r_juni_keuangan'),
            'r_juli'        =>  $bm->sum('r_juli_keuangan'),
            'r_agustus'     =>  $bm->sum('r_agustus_keuangan'),
            'r_september'   =>  $bm->sum('r_september_keuangan'),
            'r_oktober'     =>  $bm->sum('r_oktober_keuangan'),
            'r_november'    =>  $bm->sum('r_november_keuangan'),
            'r_desember'    =>  $bm->sum('r_desember_keuangan')
        ];
        $param['Belanja Tidak Terduga'] = [
            'p_januari'     =>  $btt->sum('p_januari_keuangan'),
            'p_februari'    =>  $btt->sum('p_februari_keuangan'),
            'p_maret'       =>  $btt->sum('p_maret_keuangan'),
            'p_april'       =>  $btt->sum('p_april_keuangan'),
            'p_mei'         =>  $btt->sum('p_mei_keuangan'),
            'p_juni'        =>  $btt->sum('p_juni_keuangan'),
            'p_juli'        =>  $btt->sum('p_juli_keuangan'),
            'p_agustus'     =>  $btt->sum('p_agustus_keuangan'),
            'p_september'   =>  $btt->sum('p_september_keuangan'),
            'p_oktober'     =>  $btt->sum('p_oktober_keuangan'),
            'p_november'    =>  $btt->sum('p_november_keuangan'),
            'p_desember'    =>  $btt->sum('p_desember_keuangan'),
            'r_januari'     =>  $btt->sum('r_januari_keuangan'),
            'r_februari'    =>  $btt->sum('r_februari_keuangan'),
            'r_maret'       =>  $btt->sum('r_maret_keuangan'),
            'r_april'       =>  $btt->sum('r_april_keuangan'),
            'r_mei'         =>  $btt->sum('r_mei_keuangan'),
            'r_juni'        =>  $btt->sum('r_juni_keuangan'),
            'r_juli'        =>  $btt->sum('r_juli_keuangan'),
            'r_agustus'     =>  $btt->sum('r_agustus_keuangan'),
            'r_september'   =>  $btt->sum('r_september_keuangan'),
            'r_oktober'     =>  $btt->sum('r_oktober_keuangan'),
            'r_november'    =>  $btt->sum('r_november_keuangan'),
            'r_desember'    =>  $btt->sum('r_desember_keuangan')
        ];
        $param['Belanja Transfer'] = [
            'p_januari'     =>  $bt->sum('p_januari_keuangan'),
            'p_februari'    =>  $bt->sum('p_februari_keuangan'),
            'p_maret'       =>  $bt->sum('p_maret_keuangan'),
            'p_april'       =>  $bt->sum('p_april_keuangan'),
            'p_mei'         =>  $bt->sum('p_mei_keuangan'),
            'p_juni'        =>  $bt->sum('p_juni_keuangan'),
            'p_juli'        =>  $bt->sum('p_juli_keuangan'),
            'p_agustus'     =>  $bt->sum('p_agustus_keuangan'),
            'p_september'   =>  $bt->sum('p_september_keuangan'),
            'p_oktober'     =>  $bt->sum('p_oktober_keuangan'),
            'p_november'    =>  $bt->sum('p_november_keuangan'),
            'p_desember'    =>  $bt->sum('p_desember_keuangan'),
            'r_januari'     =>  $bt->sum('r_januari_keuangan'),
            'r_februari'    =>  $bt->sum('r_februari_keuangan'),
            'r_maret'       =>  $bt->sum('r_maret_keuangan'),
            'r_april'       =>  $bt->sum('r_april_keuangan'),
            'r_mei'         =>  $bt->sum('r_mei_keuangan'),
            'r_juni'        =>  $bt->sum('r_juni_keuangan'),
            'r_juli'        =>  $bt->sum('r_juli_keuangan'),
            'r_agustus'     =>  $bt->sum('r_agustus_keuangan'),
            'r_september'   =>  $bt->sum('r_september_keuangan'),
            'r_oktober'     =>  $bt->sum('r_oktober_keuangan'),
            'r_november'    =>  $bt->sum('r_november_keuangan'),
            'r_desember'    =>  $bt->sum('r_desember_keuangan')
        ];

        //dd($param['Belanja Operasi']['p_januari']);
        $skpd = Skpd::get();
        $tampil = true;
        request()->flash();
        return view('bpkpad.keuangan', compact('data', 'tampil', 'skpd', 'param'));
    }
    public function laporan()
    {

        $tahun = request()->get('tahun');
        $skpd_id = request()->get('skpd_id');
        $pergeseran_ke = Pengajuan::where('skpd_id', $skpd_id)->where('tahun', $tahun)->latest()->first()->ke;

        $data = Uraian::where('tahun', $tahun)->where('skpd_id', $skpd_id)->where('jenis_rfk', 'pergeseran')->where('ke', $pergeseran_ke)->get();
        $data->map(function ($item) {
            $item->kode_akun = substr($item->kode_rekening, 0, 3);
            return $item;
        });

        $param['Belanja Operasi'] = [
            'p_januari'     =>  $data->where('kode_akun', '5.1')->sum('p_januari_keuangan'),
            'p_februari'    =>  $data->where('kode_akun', '5.1')->sum('p_februari_keuangan'),
            'p_maret'       =>  $data->where('kode_akun', '5.1')->sum('p_maret_keuangan'),
            'p_april'       =>  $data->where('kode_akun', '5.1')->sum('p_april_keuangan'),
            'p_mei'         =>  $data->where('kode_akun', '5.1')->sum('p_mei_keuangan'),
            'p_juni'        =>  $data->where('kode_akun', '5.1')->sum('p_juni_keuangan'),
            'p_juli'        =>  $data->where('kode_akun', '5.1')->sum('p_juli_keuangan'),
            'p_agustus'     =>  $data->where('kode_akun', '5.1')->sum('p_agustus_keuangan'),
            'p_september'   =>  $data->where('kode_akun', '5.1')->sum('p_september_keuangan'),
            'p_oktober'     =>  $data->where('kode_akun', '5.1')->sum('p_oktober_keuangan'),
            'p_november'    =>  $data->where('kode_akun', '5.1')->sum('p_november_keuangan'),
            'p_desember'    =>  $data->where('kode_akun', '5.1')->sum('p_desember_keuangan'),
            'r_januari'     =>  $data->where('kode_akun', '5.1')->sum('r_januari_keuangan'),
            'r_februari'    =>  $data->where('kode_akun', '5.1')->sum('r_februari_keuangan'),
            'r_maret'       =>  $data->where('kode_akun', '5.1')->sum('r_maret_keuangan'),
            'r_april'       =>  $data->where('kode_akun', '5.1')->sum('r_april_keuangan'),
            'r_mei'         =>  $data->where('kode_akun', '5.1')->sum('r_mei_keuangan'),
            'r_juni'        =>  $data->where('kode_akun', '5.1')->sum('r_juni_keuangan'),
            'r_juli'        =>  $data->where('kode_akun', '5.1')->sum('r_juli_keuangan'),
            'r_agustus'     =>  $data->where('kode_akun', '5.1')->sum('r_agustus_keuangan'),
            'r_september'   =>  $data->where('kode_akun', '5.1')->sum('r_september_keuangan'),
            'r_oktober'     =>  $data->where('kode_akun', '5.1')->sum('r_oktober_keuangan'),
            'r_november'    =>  $data->where('kode_akun', '5.1')->sum('r_november_keuangan'),
            'r_desember'    =>  $data->where('kode_akun', '5.1')->sum('r_desember_keuangan')
        ];
        $param['Belanja Modal'] = [
            'p_januari'     =>  $data->where('kode_akun', '5.2')->sum('p_januari_keuangan'),
            'p_februari'    =>  $data->where('kode_akun', '5.2')->sum('p_februari_keuangan'),
            'p_maret'       =>  $data->where('kode_akun', '5.2')->sum('p_maret_keuangan'),
            'p_april'       =>  $data->where('kode_akun', '5.2')->sum('p_april_keuangan'),
            'p_mei'         =>  $data->where('kode_akun', '5.2')->sum('p_mei_keuangan'),
            'p_juni'        =>  $data->where('kode_akun', '5.2')->sum('p_juni_keuangan'),
            'p_juli'        =>  $data->where('kode_akun', '5.2')->sum('p_juli_keuangan'),
            'p_agustus'     =>  $data->where('kode_akun', '5.2')->sum('p_agustus_keuangan'),
            'p_september'   =>  $data->where('kode_akun', '5.2')->sum('p_september_keuangan'),
            'p_oktober'     =>  $data->where('kode_akun', '5.2')->sum('p_oktober_keuangan'),
            'p_november'    =>  $data->where('kode_akun', '5.2')->sum('p_november_keuangan'),
            'p_desember'    =>  $data->where('kode_akun', '5.2')->sum('p_desember_keuangan'),
            'r_januari'     =>  $data->where('kode_akun', '5.2')->sum('r_januari_keuangan'),
            'r_februari'    =>  $data->where('kode_akun', '5.2')->sum('r_februari_keuangan'),
            'r_maret'       =>  $data->where('kode_akun', '5.2')->sum('r_maret_keuangan'),
            'r_april'       =>  $data->where('kode_akun', '5.2')->sum('r_april_keuangan'),
            'r_mei'         =>  $data->where('kode_akun', '5.2')->sum('r_mei_keuangan'),
            'r_juni'        =>  $data->where('kode_akun', '5.2')->sum('r_juni_keuangan'),
            'r_juli'        =>  $data->where('kode_akun', '5.2')->sum('r_juli_keuangan'),
            'r_agustus'     =>  $data->where('kode_akun', '5.2')->sum('r_agustus_keuangan'),
            'r_september'   =>  $data->where('kode_akun', '5.2')->sum('r_september_keuangan'),
            'r_oktober'     =>  $data->where('kode_akun', '5.2')->sum('r_oktober_keuangan'),
            'r_november'    =>  $data->where('kode_akun', '5.2')->sum('r_november_keuangan'),
            'r_desember'    =>  $data->where('kode_akun', '5.2')->sum('r_desember_keuangan')
        ];
        $param['Belanja Tidak Terduga'] = [
            'p_januari'     =>  $data->where('kode_akun', '5.3')->sum('p_januari_keuangan'),
            'p_februari'    =>  $data->where('kode_akun', '5.3')->sum('p_februari_keuangan'),
            'p_maret'       =>  $data->where('kode_akun', '5.3')->sum('p_maret_keuangan'),
            'p_april'       =>  $data->where('kode_akun', '5.3')->sum('p_april_keuangan'),
            'p_mei'         =>  $data->where('kode_akun', '5.3')->sum('p_mei_keuangan'),
            'p_juni'        =>  $data->where('kode_akun', '5.3')->sum('p_juni_keuangan'),
            'p_juli'        =>  $data->where('kode_akun', '5.3')->sum('p_juli_keuangan'),
            'p_agustus'     =>  $data->where('kode_akun', '5.3')->sum('p_agustus_keuangan'),
            'p_september'   =>  $data->where('kode_akun', '5.3')->sum('p_september_keuangan'),
            'p_oktober'     =>  $data->where('kode_akun', '5.3')->sum('p_oktober_keuangan'),
            'p_november'    =>  $data->where('kode_akun', '5.3')->sum('p_november_keuangan'),
            'p_desember'    =>  $data->where('kode_akun', '5.3')->sum('p_desember_keuangan'),
            'r_januari'     =>  $data->where('kode_akun', '5.3')->sum('r_januari_keuangan'),
            'r_februari'    =>  $data->where('kode_akun', '5.3')->sum('r_februari_keuangan'),
            'r_maret'       =>  $data->where('kode_akun', '5.3')->sum('r_maret_keuangan'),
            'r_april'       =>  $data->where('kode_akun', '5.3')->sum('r_april_keuangan'),
            'r_mei'         =>  $data->where('kode_akun', '5.3')->sum('r_mei_keuangan'),
            'r_juni'        =>  $data->where('kode_akun', '5.3')->sum('r_juni_keuangan'),
            'r_juli'        =>  $data->where('kode_akun', '5.3')->sum('r_juli_keuangan'),
            'r_agustus'     =>  $data->where('kode_akun', '5.3')->sum('r_agustus_keuangan'),
            'r_september'   =>  $data->where('kode_akun', '5.3')->sum('r_september_keuangan'),
            'r_oktober'     =>  $data->where('kode_akun', '5.3')->sum('r_oktober_keuangan'),
            'r_november'    =>  $data->where('kode_akun', '5.3')->sum('r_november_keuangan'),
            'r_desember'    =>  $data->where('kode_akun', '5.3')->sum('r_desember_keuangan')
        ];
        $param['Belanja Transfer'] = [
            'p_januari'     =>  $data->where('kode_akun', '5.4')->sum('p_januari_keuangan'),
            'p_februari'    =>  $data->where('kode_akun', '5.4')->sum('p_februari_keuangan'),
            'p_maret'       =>  $data->where('kode_akun', '5.4')->sum('p_maret_keuangan'),
            'p_april'       =>  $data->where('kode_akun', '5.4')->sum('p_april_keuangan'),
            'p_mei'         =>  $data->where('kode_akun', '5.4')->sum('p_mei_keuangan'),
            'p_juni'        =>  $data->where('kode_akun', '5.4')->sum('p_juni_keuangan'),
            'p_juli'        =>  $data->where('kode_akun', '5.4')->sum('p_juli_keuangan'),
            'p_agustus'     =>  $data->where('kode_akun', '5.4')->sum('p_agustus_keuangan'),
            'p_september'   =>  $data->where('kode_akun', '5.4')->sum('p_september_keuangan'),
            'p_oktober'     =>  $data->where('kode_akun', '5.4')->sum('p_oktober_keuangan'),
            'p_november'    =>  $data->where('kode_akun', '5.4')->sum('p_november_keuangan'),
            'p_desember'    =>  $data->where('kode_akun', '5.4')->sum('p_desember_keuangan'),
            'r_januari'     =>  $data->where('kode_akun', '5.4')->sum('r_januari_keuangan'),
            'r_februari'    =>  $data->where('kode_akun', '5.4')->sum('r_februari_keuangan'),
            'r_maret'       =>  $data->where('kode_akun', '5.4')->sum('r_maret_keuangan'),
            'r_april'       =>  $data->where('kode_akun', '5.4')->sum('r_april_keuangan'),
            'r_mei'         =>  $data->where('kode_akun', '5.4')->sum('r_mei_keuangan'),
            'r_juni'        =>  $data->where('kode_akun', '5.4')->sum('r_juni_keuangan'),
            'r_juli'        =>  $data->where('kode_akun', '5.4')->sum('r_juli_keuangan'),
            'r_agustus'     =>  $data->where('kode_akun', '5.4')->sum('r_agustus_keuangan'),
            'r_september'   =>  $data->where('kode_akun', '5.4')->sum('r_september_keuangan'),
            'r_oktober'     =>  $data->where('kode_akun', '5.4')->sum('r_oktober_keuangan'),
            'r_november'    =>  $data->where('kode_akun', '5.4')->sum('r_november_keuangan'),
            'r_desember'    =>  $data->where('kode_akun', '5.4')->sum('r_desember_keuangan')
        ];

        $fisik['Belanja Operasi'] = [
            'p_januari'     =>  $data->where('kode_akun', '5.1')->sum('p_januari_fisik'),
            'p_februari'    =>  $data->where('kode_akun', '5.1')->sum('p_februari_fisik'),
            'p_maret'       =>  $data->where('kode_akun', '5.1')->sum('p_maret_fisik'),
            'p_april'       =>  $data->where('kode_akun', '5.1')->sum('p_april_fisik'),
            'p_mei'         =>  $data->where('kode_akun', '5.1')->sum('p_mei_fisik'),
            'p_juni'        =>  $data->where('kode_akun', '5.1')->sum('p_juni_fisik'),
            'p_juli'        =>  $data->where('kode_akun', '5.1')->sum('p_juli_fisik'),
            'p_agustus'     =>  $data->where('kode_akun', '5.1')->sum('p_agustus_fisik'),
            'p_september'   =>  $data->where('kode_akun', '5.1')->sum('p_september_fisik'),
            'p_oktober'     =>  $data->where('kode_akun', '5.1')->sum('p_oktober_fisik'),
            'p_november'    =>  $data->where('kode_akun', '5.1')->sum('p_november_fisik'),
            'p_desember'    =>  $data->where('kode_akun', '5.1')->sum('p_desember_fisik'),
            'r_januari'     =>  $data->where('kode_akun', '5.1')->sum('r_januari_fisik'),
            'r_februari'    =>  $data->where('kode_akun', '5.1')->sum('r_februari_fisik'),
            'r_maret'       =>  $data->where('kode_akun', '5.1')->sum('r_maret_fisik'),
            'r_april'       =>  $data->where('kode_akun', '5.1')->sum('r_april_fisik'),
            'r_mei'         =>  $data->where('kode_akun', '5.1')->sum('r_mei_fisik'),
            'r_juni'        =>  $data->where('kode_akun', '5.1')->sum('r_juni_fisik'),
            'r_juli'        =>  $data->where('kode_akun', '5.1')->sum('r_juli_fisik'),
            'r_agustus'     =>  $data->where('kode_akun', '5.1')->sum('r_agustus_fisik'),
            'r_september'   =>  $data->where('kode_akun', '5.1')->sum('r_september_fisik'),
            'r_oktober'     =>  $data->where('kode_akun', '5.1')->sum('r_oktober_fisik'),
            'r_november'    =>  $data->where('kode_akun', '5.1')->sum('r_november_fisik'),
            'r_desember'    =>  $data->where('kode_akun', '5.1')->sum('r_desember_fisik')
        ];
        $fisik['Belanja Modal'] = [
            'p_januari'     =>  $data->where('kode_akun', '5.2')->sum('p_januari_fisik'),
            'p_februari'    =>  $data->where('kode_akun', '5.2')->sum('p_februari_fisik'),
            'p_maret'       =>  $data->where('kode_akun', '5.2')->sum('p_maret_fisik'),
            'p_april'       =>  $data->where('kode_akun', '5.2')->sum('p_april_fisik'),
            'p_mei'         =>  $data->where('kode_akun', '5.2')->sum('p_mei_fisik'),
            'p_juni'        =>  $data->where('kode_akun', '5.2')->sum('p_juni_fisik'),
            'p_juli'        =>  $data->where('kode_akun', '5.2')->sum('p_juli_fisik'),
            'p_agustus'     =>  $data->where('kode_akun', '5.2')->sum('p_agustus_fisik'),
            'p_september'   =>  $data->where('kode_akun', '5.2')->sum('p_september_fisik'),
            'p_oktober'     =>  $data->where('kode_akun', '5.2')->sum('p_oktober_fisik'),
            'p_november'    =>  $data->where('kode_akun', '5.2')->sum('p_november_fisik'),
            'p_desember'    =>  $data->where('kode_akun', '5.2')->sum('p_desember_fisik'),
            'r_januari'     =>  $data->where('kode_akun', '5.2')->sum('r_januari_fisik'),
            'r_februari'    =>  $data->where('kode_akun', '5.2')->sum('r_februari_fisik'),
            'r_maret'       =>  $data->where('kode_akun', '5.2')->sum('r_maret_fisik'),
            'r_april'       =>  $data->where('kode_akun', '5.2')->sum('r_april_fisik'),
            'r_mei'         =>  $data->where('kode_akun', '5.2')->sum('r_mei_fisik'),
            'r_juni'        =>  $data->where('kode_akun', '5.2')->sum('r_juni_fisik'),
            'r_juli'        =>  $data->where('kode_akun', '5.2')->sum('r_juli_fisik'),
            'r_agustus'     =>  $data->where('kode_akun', '5.2')->sum('r_agustus_fisik'),
            'r_september'   =>  $data->where('kode_akun', '5.2')->sum('r_september_fisik'),
            'r_oktober'     =>  $data->where('kode_akun', '5.2')->sum('r_oktober_fisik'),
            'r_november'    =>  $data->where('kode_akun', '5.2')->sum('r_november_fisik'),
            'r_desember'    =>  $data->where('kode_akun', '5.2')->sum('r_desember_fisik')
        ];
        $fisik['Belanja Tidak Terduga'] = [
            'p_januari'     =>  $data->where('kode_akun', '5.3')->sum('p_januari_fisik'),
            'p_februari'    =>  $data->where('kode_akun', '5.3')->sum('p_februari_fisik'),
            'p_maret'       =>  $data->where('kode_akun', '5.3')->sum('p_maret_fisik'),
            'p_april'       =>  $data->where('kode_akun', '5.3')->sum('p_april_fisik'),
            'p_mei'         =>  $data->where('kode_akun', '5.3')->sum('p_mei_fisik'),
            'p_juni'        =>  $data->where('kode_akun', '5.3')->sum('p_juni_fisik'),
            'p_juli'        =>  $data->where('kode_akun', '5.3')->sum('p_juli_fisik'),
            'p_agustus'     =>  $data->where('kode_akun', '5.3')->sum('p_agustus_fisik'),
            'p_september'   =>  $data->where('kode_akun', '5.3')->sum('p_september_fisik'),
            'p_oktober'     =>  $data->where('kode_akun', '5.3')->sum('p_oktober_fisik'),
            'p_november'    =>  $data->where('kode_akun', '5.3')->sum('p_november_fisik'),
            'p_desember'    =>  $data->where('kode_akun', '5.3')->sum('p_desember_fisik'),
            'r_januari'     =>  $data->where('kode_akun', '5.3')->sum('r_januari_fisik'),
            'r_februari'    =>  $data->where('kode_akun', '5.3')->sum('r_februari_fisik'),
            'r_maret'       =>  $data->where('kode_akun', '5.3')->sum('r_maret_fisik'),
            'r_april'       =>  $data->where('kode_akun', '5.3')->sum('r_april_fisik'),
            'r_mei'         =>  $data->where('kode_akun', '5.3')->sum('r_mei_fisik'),
            'r_juni'        =>  $data->where('kode_akun', '5.3')->sum('r_juni_fisik'),
            'r_juli'        =>  $data->where('kode_akun', '5.3')->sum('r_juli_fisik'),
            'r_agustus'     =>  $data->where('kode_akun', '5.3')->sum('r_agustus_fisik'),
            'r_september'   =>  $data->where('kode_akun', '5.3')->sum('r_september_fisik'),
            'r_oktober'     =>  $data->where('kode_akun', '5.3')->sum('r_oktober_fisik'),
            'r_november'    =>  $data->where('kode_akun', '5.3')->sum('r_november_fisik'),
            'r_desember'    =>  $data->where('kode_akun', '5.3')->sum('r_desember_fisik')
        ];
        $fisik['Belanja Transfer'] = [
            'p_januari'     =>  $data->where('kode_akun', '5.4')->sum('p_januari_fisik'),
            'p_februari'    =>  $data->where('kode_akun', '5.4')->sum('p_februari_fisik'),
            'p_maret'       =>  $data->where('kode_akun', '5.4')->sum('p_maret_fisik'),
            'p_april'       =>  $data->where('kode_akun', '5.4')->sum('p_april_fisik'),
            'p_mei'         =>  $data->where('kode_akun', '5.4')->sum('p_mei_fisik'),
            'p_juni'        =>  $data->where('kode_akun', '5.4')->sum('p_juni_fisik'),
            'p_juli'        =>  $data->where('kode_akun', '5.4')->sum('p_juli_fisik'),
            'p_agustus'     =>  $data->where('kode_akun', '5.4')->sum('p_agustus_fisik'),
            'p_september'   =>  $data->where('kode_akun', '5.4')->sum('p_september_fisik'),
            'p_oktober'     =>  $data->where('kode_akun', '5.4')->sum('p_oktober_fisik'),
            'p_november'    =>  $data->where('kode_akun', '5.4')->sum('p_november_fisik'),
            'p_desember'    =>  $data->where('kode_akun', '5.4')->sum('p_desember_fisik'),
            'r_januari'     =>  $data->where('kode_akun', '5.4')->sum('r_januari_fisik'),
            'r_februari'    =>  $data->where('kode_akun', '5.4')->sum('r_februari_fisik'),
            'r_maret'       =>  $data->where('kode_akun', '5.4')->sum('r_maret_fisik'),
            'r_april'       =>  $data->where('kode_akun', '5.4')->sum('r_april_fisik'),
            'r_mei'         =>  $data->where('kode_akun', '5.4')->sum('r_mei_fisik'),
            'r_juni'        =>  $data->where('kode_akun', '5.4')->sum('r_juni_fisik'),
            'r_juli'        =>  $data->where('kode_akun', '5.4')->sum('r_juli_fisik'),
            'r_agustus'     =>  $data->where('kode_akun', '5.4')->sum('r_agustus_fisik'),
            'r_september'   =>  $data->where('kode_akun', '5.4')->sum('r_september_fisik'),
            'r_oktober'     =>  $data->where('kode_akun', '5.4')->sum('r_oktober_fisik'),
            'r_november'    =>  $data->where('kode_akun', '5.4')->sum('r_november_fisik'),
            'r_desember'    =>  $data->where('kode_akun', '5.4')->sum('r_desember_fisik')
        ];

        //dd($param['Belanja Operasi']['p_januari']);
        $skpd = Skpd::get();
        $tampil = true;
        request()->flash();
        return view('bpkpad.home', compact('data', 'tampil', 'skpd', 'pergeseran_ke', 'param', 'fisik'));
    }
}
