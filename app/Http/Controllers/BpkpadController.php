<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Skpd;
use App\Models\Uraian;
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
