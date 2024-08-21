<?php

namespace App\Http\Controllers;

use App\Models\Skpd;
use App\Models\Uraian;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PengajuanController extends Controller
{
    public function index()
    {
        $data = Skpd::get()->map(function ($item) {;
            $data = Pengajuan::where('skpd_id', $item->id)->where('tahun', '2024')->where('status', 0)->first();
            if ($data == null) {
                $item->pengajuan = null;
            } else {
                $item->pengajuan = $data;
            }
            $status = Pengajuan::where('skpd_id', $item->id)->where('tahun', '2024')->where('status', '!=', null)->first();
            if ($status == null) {
                $item->pergeseran = null;
            } else {
                $item->pergeseran = $status;
            }
            return $item;
        });

        return view('superadmin.pengajuan.index', compact('data'));
    }

    public function verifikasi($id_skpd, $id_pengajuan)
    {
        $skpd = Skpd::find($id_skpd);
        $pengajuan = Pengajuan::find($id_pengajuan);
        $tahun = $pengajuan->tahun;

        if ($pengajuan->ke != 1) {
            if (Uraian::where('skpd_id', $id_skpd)->where('jenis_rfk', 'pergeseran')->where('tahun', $tahun)->where('ke', (int) $pengajuan->ke - 1)->count() == 0) {
                $data = Uraian::where('skpd_id', $id_skpd)->where('jenis_rfk', 'pergeseran')->where('tahun', $tahun)->where('ke', (int) $pengajuan->ke - 2)->get()->toArray();
            } else {
                $data = Uraian::where('skpd_id', $id_skpd)->where('jenis_rfk', 'pergeseran')->where('tahun', $tahun)->where('ke', (int) $pengajuan->ke - 1)->get()->toArray();
            }
        } else {
            $data = Uraian::where('skpd_id', $id_skpd)->where('jenis_rfk', 'murni')->where('tahun', $tahun)->get()->toArray();
        }


        //duplikat untuk menjadi pergeseran
        DB::beginTransaction();
        try {
            $check = Uraian::where('skpd_id', $id_skpd)->where('jenis_rfk', 'pergeseran')->where('tahun', $tahun)->where('ke', $pengajuan->ke)->first();
            if ($check == null) {
                $skpd->update([
                    'murni' => 0,
                    'perubahan' => 0,
                    'pergeseran' => 1,
                    'ke' => $pengajuan->ke,
                ]);
                $pengajuan->update([
                    'status' => 1,
                ]);
                foreach ($data as $key => $item) {
                    $item['jenis_rfk'] = 'pergeseran';
                    $item['ke'] = $pengajuan->ke;
                    Uraian::create($item);
                }
                DB::commit();
                Session::flash('success', 'berhasil diverifikasi');
                return back();
            } else {
                Session::flash('info', 'Pergeseran ke : ' . $pengajuan->ke . ' Sudah ada');
                return back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'gagal sistem');
            return back();
        }
    }
}
