<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Skpd;
use Illuminate\Http\Request;
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
            $status = Pengajuan::where('skpd_id', $item->id)->where('tahun', '2024')->where('status', 1)->first();
            if ($status == null) {
                $item->pergeseran = null;
            } else {
                $item->pergeseran = $status;
            }
            return $item;
        });

        return view('superadmin.pengajuan.index', compact('data'));
    }
}
