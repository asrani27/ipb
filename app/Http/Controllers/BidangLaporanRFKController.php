<?php

namespace App\Http\Controllers;

use App\Models\T_m;
use App\Models\T_st;
use App\Models\T_pptk;
use App\Models\Uraian;
use App\Models\Program;
use App\Models\JenisRfk;
use App\Models\Kegiatan;
use App\Models\Subkegiatan;
use App\Models\T_pbj;
use App\Models\T_v;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BidangLaporanRFKController extends Controller
{
    public function index()
    {
        return view('bidang.laporan.index');
    }

    public function tambahSt($id, $bulan)
    {
        return view('bidang.laporan.st.create', compact('id', 'bulan'));
    }
    public function tambahM($id, $bulan)
    {
        return view('bidang.laporan.m.create', compact('id', 'bulan'));
    }
    public function tambahPbj($id, $bulan)
    {
        return view('bidang.laporan.pbj.create', compact('id', 'bulan'));
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
        $jenisrfk = JenisRfk::where('tahun', $tahun)->first();
        $jenisrfk = $jenisrfk[strtolower($nama_bulan)];

        return view('bidang.laporan.rfk', compact('data', 'tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan', 'jenisrfk'));
    }
    public function input($tahun, $bulan, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;

        $jenisrfk = JenisRfk::where('tahun', $tahun)->first();
        $jenisrfk = $jenisrfk[strtolower($nama_bulan)];
        if ($jenisrfk == 'murni') {
            $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('status', null)->get();
        }

        if ($jenisrfk == 'perubahan') {
            $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('status', 99)->get();
        }

        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        $checkPptk = T_pptk::where('subkegiatan_id', $subkegiatan_id)->where('tahun', $tahun)->where('bulan', $bulan)->first();
        if ($checkPptk == null) {
            $pptk = null;
        } else {
            $pptk = $checkPptk;
        }


        return view('bidang.laporan.rfk_input', compact('data', 'tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan', 'pptk', 'jenisrfk'));
    }
    public function storeInput(Request $req)
    {
        if ($req->pptk_id == null) {
            T_pptk::create($req->all());
            Session::flash('success', 'Berhasil Di Simpan');
            return back();
        } else {
            T_pptk::find($req->pptk_id)->update($req->all());

            Session::flash('success', 'Berhasil Di Simpan');
            return back();
        }
    }
    public function pbj($tahun, $bulan, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        $jenisrfk = JenisRfk::where('tahun', $tahun)->first();
        $jenisrfk = $jenisrfk[strtolower($nama_bulan)];

        $pbj = T_pbj::where('subkegiatan_id', $subkegiatan_id)->where('tahun', $tahun)->where('bulan', $bulan)->get();

        return view('bidang.laporan.rfk_pbj', compact('tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan', 'jenisrfk', 'pbj'));
    }

    public function st($tahun, $bulan, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        $st = T_st::where('subkegiatan_id', $subkegiatan_id)->where('tahun', $tahun)->where('bulan', $bulan)->get();

        $jenisrfk = JenisRfk::where('tahun', $tahun)->first();
        $jenisrfk = $jenisrfk[strtolower($nama_bulan)];
        return view('bidang.laporan.rfk_st', compact('tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan', 'st', 'jenisrfk'));
    }

    public function editSt($id)
    {
        $data = T_st::find($id);

        return view('bidang.laporan.st.edit', compact('data'));
    }

    public function updateSt(Request $req, $id)
    {
        T_st::find($id)->update($req->all());
        $data = T_st::find($id);

        Session::flash('success', 'Berhasil Di Simpan');
        return redirect('/bidang/laporanrfk/' . $data->tahun . '/' . $data->bulan . '/' . $data->program_id . '/' . $data->kegiatan_id . '/' . $data->subkegiatan_id . '/st');
    }

    public function storeSt(Request $req, $id, $bulan)
    {
        $subkegiatan = Subkegiatan::find($id);

        $param = $req->all();
        $param['tahun'] = $subkegiatan->tahun;
        $param['bulan'] = $bulan;
        $param['program_id'] = $subkegiatan->program_id;
        $param['kegiatan_id'] = $subkegiatan->kegiatan_id;
        $param['subkegiatan_id'] = $subkegiatan->id;

        T_st::create($param);
        Session::flash('success', 'Berhasil Di Simpan');
        return redirect('/bidang/laporanrfk/' . $subkegiatan->tahun . '/' . $bulan . '/' . $subkegiatan->program_id . '/' . $subkegiatan->kegiatan_id . '/' . $subkegiatan->id . '/st');
        //return back();
    }

    public function storeM(Request $req, $id, $bulan)
    {
        $subkegiatan = Subkegiatan::find($id);

        $param = $req->all();
        $param['tahun'] = $subkegiatan->tahun;
        $param['bulan'] = $bulan;
        $param['program_id'] = $subkegiatan->program_id;
        $param['kegiatan_id'] = $subkegiatan->kegiatan_id;
        $param['subkegiatan_id'] = $subkegiatan->id;

        T_m::create($param);
        Session::flash('success', 'Berhasil Di Simpan');
        return redirect('/bidang/laporanrfk/' . $subkegiatan->tahun . '/' . $bulan . '/' . $subkegiatan->program_id . '/' . $subkegiatan->kegiatan_id . '/' . $subkegiatan->id . '/m');
        //return back();
    }
    public function storePbj(Request $req, $id, $bulan)
    {
        $subkegiatan = Subkegiatan::find($id);

        $param = $req->all();
        $param['tahun'] = $subkegiatan->tahun;
        $param['bulan'] = $bulan;
        $param['program_id'] = $subkegiatan->program_id;
        $param['kegiatan_id'] = $subkegiatan->kegiatan_id;
        $param['subkegiatan_id'] = $subkegiatan->id;

        T_pbj::create($param);
        Session::flash('success', 'Berhasil Di Simpan');
        return redirect('/bidang/laporanrfk/' . $subkegiatan->tahun . '/' . $bulan . '/' . $subkegiatan->program_id . '/' . $subkegiatan->kegiatan_id . '/' . $subkegiatan->id . '/pbj');
        //return back();
    }

    public function editM($id)
    {
        $data = T_m::find($id);

        return view('bidang.laporan.m.edit', compact('data'));
    }

    public function updateM(Request $req, $id)
    {
        T_m::find($id)->update($req->all());
        $data = T_m::find($id);

        Session::flash('success', 'Berhasil Di Simpan');
        return redirect('/bidang/laporanrfk/' . $data->tahun . '/' . $data->bulan . '/' . $data->program_id . '/' . $data->kegiatan_id . '/' . $data->subkegiatan_id . '/m');
    }
    public function deleteM($id)
    {
        T_m::find($id)->delete();
        Session::flash('success', 'Berhasil Di Hapus');
        return back();
    }

    public function editPbj($id)
    {
        $data = T_pbj::find($id);

        return view('bidang.laporan.pbj.edit', compact('data'));
    }

    public function updatePbj(Request $req, $id)
    {
        T_pbj::find($id)->update($req->all());
        $data = T_pbj::find($id);

        Session::flash('success', 'Berhasil Di Simpan');
        return redirect('/bidang/laporanrfk/' . $data->tahun . '/' . $data->bulan . '/' . $data->program_id . '/' . $data->kegiatan_id . '/' . $data->subkegiatan_id . '/pbj');
    }
    public function deletePbj($id)
    {
        T_pbj::find($id)->delete();
        Session::flash('success', 'Berhasil Di Hapus');
        return back();
    }
    public function deleteSt($id)
    {
        T_st::find($id)->delete();
        Session::flash('success', 'Berhasil Di Hapus');
        return back();
    }
    public function m($tahun, $bulan, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        $jenisrfk = JenisRfk::where('tahun', $tahun)->first();
        $jenisrfk = $jenisrfk[strtolower($nama_bulan)];

        $m = T_m::where('subkegiatan_id', $subkegiatan_id)->where('tahun', $tahun)->where('bulan', $bulan)->get();

        return view('bidang.laporan.rfk_m', compact('tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan', 'jenisrfk', 'm'));
    }

    public function v($tahun, $bulan, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        $jenisrfk = JenisRfk::where('tahun', $tahun)->first();
        $jenisrfk = $jenisrfk[strtolower($nama_bulan)];

        $v = T_v::where('subkegiatan_id', $subkegiatan_id)->where('tahun', $tahun)->where('bulan', $bulan)->get();

        return view('bidang.laporan.rfk_v', compact('tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan', 'jenisrfk', 'v'));
    }

    public function storeV(Request $req, $id, $bulan)
    {
        $subkegiatan = Subkegiatan::find($id);

        $validator = Validator::make($req->all(), [
            'file'  => 'mimes:jpg,png,jpeg,bmp|max:10240',
        ]);

        if ($validator->fails()) {
            $req->flash();
            Session::flash('error', 'File Harus Gambar');
            return back();
        }

        if ($req->file == null) {
            $filename = null;
        } else {
            $extension = $req->file->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;
            $image = $req->file('file');
            $realPath = public_path('storage') . '/visual';
            $image->move($realPath, $filename);
        }

        $param['file']  = $filename;
        $param['tahun'] = $subkegiatan->tahun;
        $param['bulan'] = $bulan;
        $param['program_id'] = $subkegiatan->program_id;
        $param['kegiatan_id'] = $subkegiatan->kegiatan_id;
        $param['subkegiatan_id'] = $subkegiatan->id;

        T_v::create($param);
        Session::flash('success', 'Berhasil Di Simpan');
        return redirect('/bidang/laporanrfk/' . $subkegiatan->tahun . '/' . $bulan . '/' . $subkegiatan->program_id . '/' . $subkegiatan->kegiatan_id . '/' . $subkegiatan->id . '/v');
        //return back();
    }

    public function deleteV($id)
    {
        T_v::find($id)->delete();
        Session::flash('success', 'Berhasil Di Hapus');
        return back();
    }

    public function fiskeu($tahun, $bulan, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;

        $jenisrfk = JenisRfk::where('tahun', $tahun)->first();
        $jenisrfk = $jenisrfk[strtolower($nama_bulan)];
        if ($jenisrfk == 'murni') {
            $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('status', null)->get();
        }

        if ($jenisrfk == 'perubahan') {
            $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('status', 99)->get();
        }

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

        return view('bidang.laporan.rfk_fiskeu', compact('data', 'tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan', 'jenisrfk'));
    }


    public function rfk($tahun, $bulan, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        try {
            $nama_bulan = namaBulan($bulan);
            $bidang_id = Auth::user()->bidang->id;
            $program = Program::find($program_id);
            $kegiatan = Kegiatan::find($kegiatan_id);
            $subkegiatan = Subkegiatan::find($subkegiatan_id);

            $jenisrfk = JenisRfk::where('tahun', $tahun)->first();
            $jenisrfk = $jenisrfk[strtolower($nama_bulan)];
            if ($jenisrfk == 'murni') {
                $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('status', null)->get();
            }

            if ($jenisrfk == 'perubahan') {
                $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('status', 99)->get();
            }

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
                        $item->capaianKeuangan = 100;
                    } else {
                        $item->capaianKeuangan =  ($item->realisasiRP / $item->rencanaRP) * 100;
                    }

                    $item->fisikRencanaKUM = fisikRencana($bulan, $item);
                    $item->fisikRencanaTTB = $item->fisikRencanaKUM * $item->persenDPA / 100;
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
        } catch (\Exception $e) {
            Session::flash('error', 'Division By Zero');
            return back();
        }

        return view('bidang.laporan.rfk_rfk', compact('data', 'tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan', 'jenisrfk'));
    }


    public function srp($tahun, $bulan, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        $jenisrfk = JenisRfk::where('tahun', $tahun)->first();
        $jenisrfk = $jenisrfk[strtolower($nama_bulan)];
        if ($jenisrfk == 'murni') {
            $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('status', null)->get();
        }

        if ($jenisrfk == 'perubahan') {
            $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('status', 99)->get();
        }

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
                if ($item->rencanaRP == 0) {
                    $item->capaianKeuangan = 0;
                } else {
                    $item->capaianKeuangan =  ($item->realisasiRP / $item->rencanaRP) * 100;
                }
                $item->deviasiKUM =  $item->realisasiKUM - $item->rencanaKUM;
                $item->deviasiTTB = $item->realisasiTTB - $item->rencanaTTB;
                $item->sisaAnggaran = $item->dpa - $item->realisasiRP;

                $item->fisikRencanaKUM = fisikRencana($bulan, $item);
                $item->fisikRencanaTTB = $item->fisikRencanaKUM * $item->persenDPA / 100;
                $item->fisikRealisasiKUM = fisikRealisasi($bulan, $item);
                $item->fisikRealisasiTTB = $item->fisikRealisasiKUM * $item->persenDPA / 100;
                if ($item->fisikRencanaKUM == 0) {
                    $item->capaianFisik = 0;
                } else {
                    $item->capaianFisik =  ($item->fisikRealisasiKUM / $item->fisikRencanaKUM) * 100;
                }
                $item->fisikDeviasiKUM =  $item->fisikRealisasiKUM - $item->fisikRencanaKUM;
                $item->fisikDeviasiTTB =  $item->fisikRealisasiTTB - $item->fisikRencanaTTB;
            }
            return $item;
        });


        return view('bidang.laporan.rfk_srp', compact('data', 'tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan', 'jenisrfk'));
    }
}
