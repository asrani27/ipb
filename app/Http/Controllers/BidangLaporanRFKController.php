<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\T_m;
use App\Models\T_v;
use App\Models\T_st;
use App\Models\T_pbj;
use App\Models\T_pptk;
use App\Models\T_input;
use App\Models\Uraian;
use App\Models\Program;
use App\Models\JenisRfk;
use App\Models\Kegiatan;
use App\Models\Subkegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;

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
        $data = Program::where('bidang_id', $bidang_id)->where('tahun', $tahun)->where('jenis_rfk', statusRFK())->get();

        return view('bidang.laporan.program', compact('tahun', 'bulan', 'nama_bulan', 'data'));
    }

    public function kirimData($bulan, $subkegiatan_id)
    {
        $field = 'kirim_rfk_' . strtolower(namaBulan($bulan));
        Subkegiatan::find($subkegiatan_id)->update([
            $field => 1,
        ]);
        Session::flash('success', 'berhasil Di Kirim Ke Admin SKPD');
        return back();
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

        $field_kirim = 'kirim_rfk_' . strtolower($nama_bulan);
        $status_kirim = $subkegiatan[$field_kirim];

        $jenisrfk = JenisRfk::where('tahun', $tahun)->first();
        if ($jenisrfk == null) {
            Session::flash('info', 'Jenis RFK belum di input oleh admin skpd');
            return back();
        } else {
            $jenisrfk = $jenisrfk[strtolower($nama_bulan)];
            return view('bidang.laporan.rfk', compact('data', 'tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan', 'jenisrfk', 'status_kirim'));
        }
    }

    public function input($tahun, $bulan, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;

        $jenisrfk = JenisRfk::where('tahun', $tahun)->where('skpd_id', Auth::user()->bidang->skpd_id)->first();
        if ($jenisrfk == null) {
            Session::flash('info', 'Jenis RFK belum di input oleh admin skpd');
            return back();
        }

        $jenisrfk = $jenisrfk[strtolower($nama_bulan)];

        $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('jenis_rfk', $jenisrfk)->get();


        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        $field_kirim = 'kirim_rfk_' . strtolower($nama_bulan);
        $status_kirim = $subkegiatan[$field_kirim];

        $checkPptk = T_pptk::where('subkegiatan_id', $subkegiatan_id)->where('tahun', $tahun)->where('bulan', $bulan)->first();
        if ($checkPptk == null) {
            $pptk = null;
        } else {
            $pptk = $checkPptk;
        }

        return view('bidang.laporan.rfk_input', compact('status_kirim', 'data', 'tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan', 'pptk', 'jenisrfk'));
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

        $field_kirim = 'kirim_rfk_' . strtolower($nama_bulan);
        $status_kirim = $subkegiatan[$field_kirim];

        $jenisrfk = JenisRfk::where('tahun', $tahun)->where('skpd_id', Auth::user()->bidang->skpd_id)->first();
        $jenisrfk = $jenisrfk[strtolower($nama_bulan)];

        $pbj = T_pbj::where('subkegiatan_id', $subkegiatan_id)->where('tahun', $tahun)->where('bulan', $bulan)->get();

        return view('bidang.laporan.rfk_pbj', compact('status_kirim', 'tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan', 'jenisrfk', 'pbj'));
    }

    public function st($tahun, $bulan, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        $field_kirim = 'kirim_rfk_' . strtolower($nama_bulan);
        $status_kirim = $subkegiatan[$field_kirim];

        $st = T_st::where('subkegiatan_id', $subkegiatan_id)->where('tahun', $tahun)->where('bulan', $bulan)->get();

        $jenisrfk = JenisRfk::where('tahun', $tahun)->where('skpd_id', Auth::user()->bidang->skpd_id)->first();
        $jenisrfk = $jenisrfk[strtolower($nama_bulan)];
        return view('bidang.laporan.rfk_st', compact('status_kirim', 'tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan', 'st', 'jenisrfk'));
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
        $data = T_m::find($id);

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

        $field_kirim = 'kirim_rfk_' . strtolower($nama_bulan);
        $status_kirim = $subkegiatan[$field_kirim];
        $jenisrfk = JenisRfk::where('tahun', $tahun)->where('skpd_id', Auth::user()->bidang->skpd_id)->first();
        $jenisrfk = $jenisrfk[strtolower($nama_bulan)];

        $m = T_m::where('subkegiatan_id', $subkegiatan_id)->where('tahun', $tahun)->where('bulan', $bulan)->get();

        return view('bidang.laporan.rfk_m', compact('status_kirim', 'tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan', 'jenisrfk', 'm'));
    }

    public function v($tahun, $bulan, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        $field_kirim = 'kirim_rfk_' . strtolower($nama_bulan);
        $status_kirim = $subkegiatan[$field_kirim];
        $jenisrfk = JenisRfk::where('tahun', $tahun)->where('skpd_id', Auth::user()->bidang->skpd_id)->first();
        $jenisrfk = $jenisrfk[strtolower($nama_bulan)];

        $v = T_v::where('subkegiatan_id', $subkegiatan_id)->where('tahun', $tahun)->where('bulan', $bulan)->get();

        return view('bidang.laporan.rfk_v', compact('status_kirim', 'tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan', 'jenisrfk', 'v'));
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

        $jenisrfk = JenisRfk::where('tahun', $tahun)->where('skpd_id', Auth::user()->bidang->skpd_id)->first();
        if ($jenisrfk == null) {
            Session::flash('info', 'Jenis RFK belum di input oleh admin skpd');
            return back();
        }

        $jenisrfk = $jenisrfk[strtolower($nama_bulan)];

        $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('jenis_rfk', $jenisrfk)->get();
        // if ($jenisrfk == 'murni') {
        //     $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('status', null)->get();
        // }

        // if ($jenisrfk == 'perubahan') {
        //     $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('status', 99)->get();
        // }

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

        $field_kirim = 'kirim_rfk_' . strtolower($nama_bulan);
        $status_kirim = $subkegiatan[$field_kirim];
        return view('bidang.laporan.rfk_fiskeu', compact('status_kirim', 'data', 'tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan', 'jenisrfk'));
    }


    public function rfk($tahun, $bulan, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        try {
            $nama_bulan = namaBulan($bulan);
            $bidang_id = Auth::user()->bidang->id;
            $program = Program::find($program_id);
            $kegiatan = Kegiatan::find($kegiatan_id);
            $subkegiatan = Subkegiatan::find($subkegiatan_id);

            $jenisrfk = JenisRfk::where('tahun', $tahun)->where('skpd_id', Auth::user()->bidang->skpd_id)->first();
            if ($jenisrfk == null) {
                Session::flash('info', 'Jenis RFK belum di input oleh admin skpd');
                return back();
            }

            $jenisrfk = $jenisrfk[strtolower($nama_bulan)];
            $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('jenis_rfk', $jenisrfk)->get();

            // if ($jenisrfk == 'murni') {
            //     $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('status', null)->get();
            // }

            // if ($jenisrfk == 'perubahan') {
            //     $data = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('status', 99)->get();
            // }

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

        $field_kirim = 'kirim_rfk_' . strtolower($nama_bulan);
        $status_kirim = $subkegiatan[$field_kirim];
        return view('bidang.laporan.rfk_rfk', compact('status_kirim', 'data', 'tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan', 'jenisrfk'));
    }


    public function srp($tahun, $bulan, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        $jenisrfk = JenisRfk::where('tahun', $tahun)->where('skpd_id', Auth::user()->bidang->skpd_id)->first();
        if ($jenisrfk == null) {
            Session::flash('info', 'Jenis RFK belum di input oleh admin skpd');
            return back();
        }

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


        $field_kirim = 'kirim_rfk_' . strtolower($nama_bulan);
        $status_kirim = $subkegiatan[$field_kirim];
        return view('bidang.laporan.rfk_srp', compact('status_kirim', 'data', 'tahun', 'bulan', 'nama_bulan', 'program', 'kegiatan', 'subkegiatan', 'jenisrfk'));
    }


    public function excel($tahun, $bulan, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $nama_bulan = namaBulan($bulan);
        $bidang_id = Auth::user()->bidang->id;
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        $jenisrfk = JenisRfk::where('tahun', $tahun)->where('skpd_id', Auth::user()->bidang->skpd_id)->first();
        if ($jenisrfk == null) {
            Session::flash('info', 'Jenis RFK belum di input oleh admin skpd');
            return back();
        }

        $jenisrfk = $jenisrfk[strtolower($nama_bulan)];
        $datainput = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('jenis_rfk', $jenisrfk)->get();
        //dd($datainput);
        // dd($jenisrfk);
        // if ($jenisrfk == 'murni') {
        //     $datainput = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('status', null)->get();
        // }

        // if ($jenisrfk == 'perubahan') {
        //     $datainput = Uraian::where('subkegiatan_id', $subkegiatan_id)->where('status', 99)->get();
        // }
        $biodata = T_pptk::where('tahun', $tahun)->where('bulan', $bulan)->where('subkegiatan_id', $subkegiatan_id)->first();
        if ($biodata == null) {
            Session::flash('error', 'Data Di menu Input kosong');
            return back();
        }
        //dd($datainput, $jenisrfk, $bulan, $tahun, $subkegiatan_id, $biodata, $program, $kegiatan);

        $filename = 'RFK.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=$filename");
        header('Cache-Control: max-age=0');

        if ($bulan == '01') {
            $path = public_path('/excel/januari.xlsx');
        }
        if ($bulan == '02') {
            $path = public_path('/excel/februari.xlsx');
        }
        if ($bulan == '03') {
            $path = public_path('/excel/maret.xlsx');
        }
        if ($bulan == '04') {
            $path = public_path('/excel/april.xlsx');
        }
        if ($bulan == '05') {
            $path = public_path('/excel/mei.xlsx');
        }
        if ($bulan == '06') {
            $path = public_path('/excel/juni.xlsx');
        }
        if ($bulan == '07') {
            $path = public_path('/excel/juli.xlsx');
        }
        if ($bulan == '08') {
            $path = public_path('/excel/agustus.xlsx');
        }
        if ($bulan == '09') {
            $path = public_path('/excel/september.xlsx');
        }
        if ($bulan == '10') {
            $path = public_path('/excel/oktober.xlsx');
        }
        if ($bulan == '11') {
            $path = public_path('/excel/november.xlsx');
        }
        if ($bulan == '12') {
            $path = public_path('/excel/desember.xlsx');
        }
        //dd($path);
        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load($path);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H1', Auth::user()->bidang->skpd->nama);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H2', $program->nama);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H3', $kegiatan->nama);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H4', $subkegiatan->nama);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H5', $biodata->nama_kabid);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H6', 'NIP. ' . $biodata->nip_kabid);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H7', $biodata->nama_pptk);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H8', 'NIP. ' . $biodata->nip_pptk);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H9', $program->bidang->nama);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H12', $biodata->pelaporan_bulan);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H13', $biodata->pelaporan_tanggal);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H16', $biodata->kondisi_bulan);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H17', $biodata->kondisi_tanggal);
        $contentRow = 3;
        $lastRow = 27;
        foreach ($datainput as $key => $item) {
            $spreadsheet->getSheetByName('INPUT')->setCellValue('B' . $contentRow, $item->kode_rekening);
            $spreadsheet->getSheetByName('INPUT')->setCellValue('C' . $contentRow, $item->nama);
            $spreadsheet->getSheetByName('INPUT')->setCellValue('D' . $contentRow, $item->dpa);
            $contentRow++;
        }
        //dd('s');
        $totalHapus = $lastRow - $contentRow - $datainput->count();

        $mulaiHapus = $contentRow;
        //total di hapus
        for ($x = 0; $x < $totalHapus; $x++) {
            $spreadsheet->getSheetByName('INPUT')->setCellValue('B' . $mulaiHapus, '');
            $spreadsheet->getSheetByName('INPUT')->setCellValue('C' . $mulaiHapus, '');
            $spreadsheet->getSheetByName('INPUT')->setCellValue('D' . $mulaiHapus, '');
            $mulaiHapus++;
        }

        $spreadsheet->getSheetByName('FISKEU')->setCellValue('F3', ': ' . Auth::user()->bidang->skpd->nama);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('F4', ': ' . $program->nama);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('F5', ': ' . $kegiatan->nama);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('F6', ': ' . $nama_bulan);

        $rencanaKeuanganRow = 11;
        $realisasiKeuanganRow = 12;
        $rencanaFisikRow = 13;
        $realisasiFisikRow = 14;
        $sumKuning = 15;

        $sumJ = '=J11';
        $sumK = '=K11';
        $sumL = '=L11';
        $sumM = '=M11';
        $sumN = '=N11';
        $sumO = '=O11';
        $sumP = '=P11';
        $sumQ = '=Q11';
        $sumR = '=R11';
        $sumS = '=S11';
        $sumT = '=T11';
        $sumU = '=U11';
        $sumV = '=V11';


        $sumJfisik = '=J15';
        $sumKfisik = '=K15';
        $sumLfisik = '=L15';
        $sumMfisik = '=M15';
        $sumNfisik = '=N15';
        $sumOfisik = '=O15';
        $sumPfisik = '=P15';
        $sumQfisik = '=Q15';
        $sumRfisik = '=R15';
        $sumSfisik = '=S15';
        $sumTfisik = '=T15';
        $sumUfisik = '=U15';
        // //dd('d');
        $count = $datainput->count();

        foreach ($datainput as $key => $item) {
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('J' . $rencanaKeuanganRow, $item->p_januari_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('K' . $rencanaKeuanganRow, $item->p_februari_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('L' . $rencanaKeuanganRow, $item->p_maret_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('M' . $rencanaKeuanganRow, $item->p_april_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('N' . $rencanaKeuanganRow, $item->p_mei_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('O' . $rencanaKeuanganRow, $item->p_juni_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('P' . $rencanaKeuanganRow, $item->p_juli_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('Q' . $rencanaKeuanganRow, $item->p_agustus_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('R' . $rencanaKeuanganRow, $item->p_september_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('S' . $rencanaKeuanganRow, $item->p_oktober_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('T' . $rencanaKeuanganRow, $item->p_november_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('U' . $rencanaKeuanganRow, $item->p_desember_keuangan);

            $spreadsheet->getSheetByName('FISKEU')->setCellValue('J' . $realisasiKeuanganRow, $item->r_januari_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('K' . $realisasiKeuanganRow, $item->r_februari_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('L' . $realisasiKeuanganRow, $item->r_maret_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('M' . $realisasiKeuanganRow, $item->r_april_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('N' . $realisasiKeuanganRow, $item->r_mei_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('O' . $realisasiKeuanganRow, $item->r_juni_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('P' . $realisasiKeuanganRow, $item->r_juli_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('Q' . $realisasiKeuanganRow, $item->r_agustus_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('R' . $realisasiKeuanganRow, $item->r_september_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('S' . $realisasiKeuanganRow, $item->r_oktober_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('T' . $realisasiKeuanganRow, $item->r_november_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('U' . $realisasiKeuanganRow, $item->r_desember_keuangan);

            $spreadsheet->getSheetByName('FISKEU')->setCellValue('J' . $rencanaFisikRow, $item->p_januari_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('K' . $rencanaFisikRow, $item->p_februari_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('L' . $rencanaFisikRow, $item->p_maret_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('M' . $rencanaFisikRow, $item->p_april_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('N' . $rencanaFisikRow, $item->p_mei_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('O' . $rencanaFisikRow, $item->p_juni_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('P' . $rencanaFisikRow, $item->p_juli_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('Q' . $rencanaFisikRow, $item->p_agustus_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('R' . $rencanaFisikRow, $item->p_september_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('S' . $rencanaFisikRow, $item->p_oktober_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('T' . $rencanaFisikRow, $item->p_november_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('U' . $rencanaFisikRow, $item->p_desember_fisik / 100);

            $spreadsheet->getSheetByName('FISKEU')->setCellValue('J' . $realisasiFisikRow, $item->r_januari_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('K' . $realisasiFisikRow, $item->r_februari_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('L' . $realisasiFisikRow, $item->r_maret_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('M' . $realisasiFisikRow, $item->r_april_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('N' . $realisasiFisikRow, $item->r_mei_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('O' . $realisasiFisikRow, $item->r_juni_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('P' . $realisasiFisikRow, $item->r_juli_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('Q' . $realisasiFisikRow, $item->r_agustus_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('R' . $realisasiFisikRow, $item->r_september_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('S' . $realisasiFisikRow, $item->r_oktober_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('T' . $realisasiFisikRow, $item->r_november_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('U' . $realisasiFisikRow, $item->r_desember_fisik / 100);

            $rencanaKeuanganRow += 6;
            $realisasiKeuanganRow += 6;
            $rencanaFisikRow += 6;
            $realisasiFisikRow += 6;
            $sumKuning += 6;

            if ($key == ($count - 1)) {
            } else {
                $sumJ = $sumJ . '+J' . $rencanaKeuanganRow;
                $sumK = $sumK . '+K' . $rencanaKeuanganRow;
                $sumL = $sumL . '+L' . $rencanaKeuanganRow;
                $sumM = $sumM . '+M' . $rencanaKeuanganRow;
                $sumN = $sumN . '+N' . $rencanaKeuanganRow;
                $sumO = $sumO . '+O' . $rencanaKeuanganRow;
                $sumP = $sumP . '+P' . $rencanaKeuanganRow;
                $sumQ = $sumQ . '+Q' . $rencanaKeuanganRow;
                $sumR = $sumR . '+R' . $rencanaKeuanganRow;
                $sumS = $sumS . '+S' . $rencanaKeuanganRow;
                $sumT = $sumT . '+T' . $rencanaKeuanganRow;
                $sumU = $sumU . '+U' . $rencanaKeuanganRow;
                $sumV = $sumV . '+V' . $rencanaKeuanganRow;

                $sumJfisik = $sumJfisik . '+J' . $sumKuning;
                $sumKfisik = $sumKfisik . '+K' . $sumKuning;
                $sumLfisik = $sumLfisik . '+L' . $sumKuning;
                $sumMfisik = $sumMfisik . '+M' . $sumKuning;
                $sumNfisik = $sumNfisik . '+N' . $sumKuning;
                $sumOfisik = $sumOfisik . '+O' . $sumKuning;
                $sumPfisik = $sumPfisik . '+P' . $sumKuning;
                $sumQfisik = $sumQfisik . '+Q' . $sumKuning;
                $sumRfisik = $sumRfisik . '+R' . $sumKuning;
                $sumSfisik = $sumSfisik . '+S' . $sumKuning;
                $sumTfisik = $sumTfisik . '+T' . $sumKuning;
                $sumUfisik = $sumUfisik . '+U' . $sumKuning;
            }

            $totalRencanaKeuanganBulanRow = $rencanaKeuanganRow + 1;
            $totalRencanaFisikBulanRow = $rencanaKeuanganRow + 2;
        }

        $mulaiHapusDariBaris = $rencanaKeuanganRow - 1;
        $jumlahDihapus = 448 - $mulaiHapusDariBaris;

        // //remove row
        // //$countRemove = 77;
        $spreadsheet->getSheetByName('FISKEU')->removeRow($mulaiHapusDariBaris, $jumlahDihapus);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('J' . $totalRencanaKeuanganBulanRow, $sumJ);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('K' . $totalRencanaKeuanganBulanRow, $sumK);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('L' . $totalRencanaKeuanganBulanRow, $sumL);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('M' . $totalRencanaKeuanganBulanRow, $sumM);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('N' . $totalRencanaKeuanganBulanRow, $sumN);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('O' . $totalRencanaKeuanganBulanRow, $sumO);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('P' . $totalRencanaKeuanganBulanRow, $sumP);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('Q' . $totalRencanaKeuanganBulanRow, $sumQ);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('R' . $totalRencanaKeuanganBulanRow, $sumR);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('S' . $totalRencanaKeuanganBulanRow, $sumS);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('T' . $totalRencanaKeuanganBulanRow, $sumT);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('U' . $totalRencanaKeuanganBulanRow, $sumU);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('V' . $totalRencanaKeuanganBulanRow, $sumV);

        $spreadsheet->getSheetByName('FISKEU')->setCellValue('J' . $totalRencanaFisikBulanRow, $sumJfisik);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('K' . $totalRencanaFisikBulanRow, $sumKfisik);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('L' . $totalRencanaFisikBulanRow, $sumLfisik);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('M' . $totalRencanaFisikBulanRow, $sumMfisik);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('N' . $totalRencanaFisikBulanRow, $sumNfisik);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('O' . $totalRencanaFisikBulanRow, $sumOfisik);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('P' . $totalRencanaFisikBulanRow, $sumPfisik);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('Q' . $totalRencanaFisikBulanRow, $sumQfisik);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('R' . $totalRencanaFisikBulanRow, $sumRfisik);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('S' . $totalRencanaFisikBulanRow, $sumSfisik);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('T' . $totalRencanaFisikBulanRow, $sumTfisik);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('U' . $totalRencanaFisikBulanRow, $sumUfisik);

        $rfkMulaiKosong = $datainput->count() + 13;

        for ($x = $rfkMulaiKosong; $x < 85; $x++) {
            $spreadsheet->getSheetByName('RFK')->setCellValue('B' . $x, '');
            $spreadsheet->getSheetByName('RFK')->setCellValue('C' . $x, '');
            $spreadsheet->getSheetByName('RFK')->setCellValue('D' . $x, '');
            $spreadsheet->getSheetByName('RFK')->setCellValue('E' . $x, '');
            $spreadsheet->getSheetByName('RFK')->setCellValue('F' . $x, '');
            $spreadsheet->getSheetByName('RFK')->setCellValue('G' . $x, '');
            $spreadsheet->getSheetByName('RFK')->setCellValue('H' . $x, '');
            $spreadsheet->getSheetByName('RFK')->setCellValue('I' . $x, '');
            $spreadsheet->getSheetByName('RFK')->setCellValue('J' . $x, '');
            $spreadsheet->getSheetByName('RFK')->setCellValue('K' . $x, '');
            $spreadsheet->getSheetByName('RFK')->setCellValue('L' . $x, '');
            $spreadsheet->getSheetByName('RFK')->setCellValue('M' . $x, '');
            $spreadsheet->getSheetByName('RFK')->setCellValue('N' . $x, '');
            $spreadsheet->getSheetByName('RFK')->setCellValue('O' . $x, '');
            $spreadsheet->getSheetByName('RFK')->setCellValue('P' . $x, '');
            $spreadsheet->getSheetByName('RFK')->setCellValue('Q' . $x, '');
            $spreadsheet->getSheetByName('RFK')->setCellValue('R' . $x, '');
        }

        $spreadsheet->getSheetByName('SPENGANTAR')->setCellValue('A3', strtoupper(Auth::user()->bidang->skpd->nama));
        $spreadsheet->getSheetByName('SPENGANTAR')->setCellValue('F9', 'Kepala ' . strtoupper(Auth::user()->bidang->skpd->nama));
        $spreadsheet->getSheetByName('SPENGANTAR')->setCellValue('C8', $biodata->no_surat);
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}
