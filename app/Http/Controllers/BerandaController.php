<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Uraian;
use App\Models\Pengajuan;
use App\Models\BatasInput;
use App\Models\Subkegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BerandaController extends Controller
{
    public function index()
    {
        return view('superadmin.home');
    }

    public function duplikatData()
    {

        $logLatest = LogBukaTutup::latest()->first();

        if ($logLatest->ke == null) {
            $tahun = Carbon::now()->year;
            $data = Uraian::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->get()->toArray();
            foreach ($data as $i) {
                $attr = $i;
                $attr['uraian_id'] = $i['id'];
                $attr['status'] = $attr['status'] == null ? 1 : $attr['status'] + 1;
                Uraian::create($attr);
            }

            return $data;
        } else {
            $tahun = Carbon::now()->year;
            $data = Uraian::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->where('status', $logLatest->ke)->get()->toArray();

            foreach ($data as $i) {
                $attr = $i;
                $attr['uraian_id'] = $i['uraian_id'];
                $attr['status'] = $attr['status'] == null ? 1 : $attr['status'] + 1;
                Uraian::create($attr);
            }

            return $data;
        }
    }

    public function admin()
    {
        $murni = Auth::user()->skpd->murni;
        $perubahan = Auth::user()->skpd->perubahan;
        $realisasi = Auth::user()->skpd->realisasi;
        $pergeseran = Auth::user()->skpd->pergeseran;
        $log = LogBukaTutup::orderBy('id', 'DESC')->paginate(15);
        return view('admin.beranda', compact('murni', 'perubahan', 'realisasi', 'pergeseran', 'log'));
    }

    public function setMurni()
    {
        $murni = request()->get('murni');
        if ($murni == 'BUKA') {
            //check
            if (Auth::user()->skpd->pergeseran != 0) {
                toastr()->error('Pergeseran Harap Di tutup terlebih dahulu');
                return back();
            }
            if (Auth::user()->skpd->perubahan != 0) {
                toastr()->error('perubahan Harap Di tutup terlebih dahulu');
                return back();
            }
            if (Auth::user()->skpd->realisasi != 0) {
                toastr()->error('Realisasi Harap Di tutup terlebih dahulu');
                return back();
            }

            if (LogBukaTutup::where('tahun', Carbon::now()->year)->where('nama', 'murni')->first() != null) {
                toastr()->error('Murni Hanya bisa di buka sekali');
                return back();
            }

            Auth::user()->skpd->update(['murni' => 1]);

            $n = new LogBukaTutup;
            $n->tahun = Carbon::now()->year;
            $n->nama = 'murni';
            $n->jenis = 'buka';
            $n->save();

            toastr()->success('Penginputan Dibuka');
            return back();
        } elseif ($murni == 'TUTUP') {

            if (LogBukaTutup::where('tahun', Carbon::now()->year)->where('nama', 'murni')->first() != null) {
                toastr()->error('Murni Hanya bisa di buka sekali');
                return back();
            }

            Auth::user()->skpd->update(['murni' => 0]);

            $n = new LogBukaTutup;
            $n->tahun = Carbon::now()->year;
            $n->nama = 'murni';
            $n->jenis = 'tutup';
            $n->save();
            toastr()->success('Penginputan Ditutup');
            return back();
        } else {
            toastr()->error('Kata Tidak Sesuai');
            return back();
        }
    }

    public function setPergeseran()
    {
        $pergeseran = request()->get('pergeseran');
        $value = request()->get('value');
        if ($pergeseran == 'BUKA' && $value == "1") {
            $this->duplikatData();
            //check
            if (Auth::user()->skpd->murni != 0) {
                toastr()->error('Murni Harap Di tutup terlebih dahulu');
                return back();
            }
            if (Auth::user()->skpd->perubahan != 0) {
                toastr()->error('perubahan Harap Di tutup terlebih dahulu');
                return back();
            }

            //check ke berapa
            $cp = LogBukaTutup::where('tahun', Carbon::now()->year)->where('nama', 'pergeseran')->latest()->first();
            if ($cp == null) {
                //pergeseran pertama
                $n = new LogBukaTutup;
                $n->tahun = Carbon::now()->year;
                $n->nama = 'pergeseran';
                $n->ke = 1;
                $n->jenis = 'buka';
                $n->save();
            } else {
                //pergeseran selanjutnya
                $n = new LogBukaTutup;
                $n->tahun = Carbon::now()->year;
                $n->nama = 'pergeseran';
                $n->ke = $cp->ke + 1;
                $n->jenis = 'buka';
                $n->save();
            }

            Auth::user()->skpd->update(['pergeseran' => 1]);
            toastr()->success('Penginputan Pergeseran Dibuka');
            return back();
        } elseif ($pergeseran == 'TUTUP' && $value == "0") {
            $cp = LogBukaTutup::where('tahun', Carbon::now()->year)->where('nama', 'pergeseran')->latest()->first();
            Auth::user()->skpd->update(['pergeseran' => 0]);
            $n = new LogBukaTutup;
            $n->tahun = Carbon::now()->year;
            $n->nama = 'pergeseran';
            $n->ke = $cp->ke;
            $n->jenis = 'tutup';
            $n->save();
            toastr()->success('Penginputan Pergeseran Ditutup');
            return back();
        } else {
            toastr()->error('Kata Tidak Sesuai');
            return back();
        }
    }
    public function setPerubahan()
    {
        if (Auth::user()->skpd->perubahan == 0) {

            $tahun = Carbon::now()->year;
            $duplikatData = Subkegiatan::where('tahun', $tahun)->where('skpd_id', Auth::user()->skpd->id)->get();
            foreach ($duplikatData as $d) {
                $attr = $d->toArray();
                $attr['status'] = 2;
                $check = Subkegiatan::where('subkegiatan_id', $attr['id'])->first();
                if ($check == null) {
                    $attr['subkegiatan_id'] = $attr['id'];
                    Subkegiatan::create($attr);
                }
            }
            Auth::user()->skpd->update(['perubahan' => 1]);
            toastr()->success('Penginputan Dibuka');
        } else {
            Auth::user()->skpd->update(['perubahan' => 0]);
            toastr()->success('Penginputan Ditutup');
        }
        return back();
    }

    public function setRealisasi()
    {
        $real = request()->get('realisasi');
        //        dd($real);
        if ($real == 'BUKA') {
            Auth::user()->skpd->update(['realisasi' => 1]);
            $n = new LogBukaTutup;
            $n->tahun = Carbon::now()->year;
            $n->nama = 'realisasi';
            $n->jenis = 'buka';
            $n->save();
            toastr()->success('Penginputan Dibuka');
        } elseif ($real == 'TUTUP') {
            Auth::user()->skpd->update(['realisasi' => 0]);
            $n = new LogBukaTutup;
            $n->tahun = Carbon::now()->year;
            $n->nama = 'realisasi';
            $n->jenis = 'tutup';
            $n->save();
            toastr()->success('Penginputan Ditutup');
        } else {
            toastr()->error('Kata tidak sesuai');
            return back();
        }
        return back();
    }
    public function bidang()
    {
        $data = null;
        return view('bidang.beranda', compact('data'));
    }
    public function pptk()
    {
        // if (Auth::user()->pptk->bidang->skpd->kode_skpd ==  "4.01.03.") {
        //     Auth::logout();

        //     Session::flash('warning', 'PPTK setda sedang dalam pengembangan fitur untuk per BAGIAN');

        //     return redirect('/login');
        // }

        $tahun = Carbon::now()->format('Y');
        //$status = BatasInput::where('is_aktif', 1)->first()->nama;
        //$status = 'murni';
        $pergeseran_ke = null;
        if (Auth::user()->pptk->skpd->murni == 1) {
            $status = 'murni';
            $pergeseran_ke = null;
        }
        if (Auth::user()->pptk->skpd->pergeseran == 1) {
            $status = 'pergeseran';
            $pergeseran_ke = Auth::user()->pptk->skpd->ke;
        }
        if (Auth::user()->pptk->skpd->perubahan == 1) {
            $status = 'perubahan';
            $pergeseran_ke = null;
        }

        //dd($status);
        // $result = $status;
        // $data = null;

        // $t_subkegiatan = Subkegiatan::where('pptk_id', Auth::user()->pptk->id)->where('tahun', '2023')->count();
        // $t_uraian = Uraian::where('pptk_id', Auth::user()->pptk->id)->where('jenis_rfk', $result)->where('tahun', '2023')->count();

        $ke = Pengajuan::where('skpd_id', Auth::user()->pptk->skpd->id)->where('status', 1)->orderBy('id', 'DESC')->get();
        if (count($ke) != 0) {
            $hasil = $ke->first()->ke;
        }
        if ($status == 'pergeseran') {
            $subkegiatan = Subkegiatan::where('pptk_id', Auth::user()->pptk->id)->where('tahun', $tahun)->get();
            $uraian = Uraian::where('pptk_id', Auth::user()->pptk->id)->where('tahun', $tahun)->where('jenis_rfk', $status)->where('ke', $hasil)->count();

            $subkegiatan->map(function ($item) use ($status) {
                $item->uraian = $item->uraian->where('jenis_rfk', $status)->where('ke', Auth::user()->pptk->skpd->ke);
                $item->totalsubkegiatan = $item->uraian->where('jenis_rfk', $status)->where('ke', Auth::user()->pptk->skpd->ke)->sum('dpa');
                return $item;
            });
        } else {
            $subkegiatan = Subkegiatan::where('pptk_id', Auth::user()->pptk->id)->where('tahun', $tahun)->get();
            $uraian = Uraian::where('pptk_id', Auth::user()->pptk->id)->where('tahun', $tahun)->where('jenis_rfk', $status)->count();
            $subkegiatan->map(function ($item) use ($status) {
                $item->uraian = $item->uraian->where('jenis_rfk', $status);
                $item->totalsubkegiatan = $item->uraian->where('jenis_rfk', $status)->sum('dpa');
                return $item;
            });
        }
        //dd($subkegiatan);
        return view('pptk.home', compact('tahun', 'subkegiatan', 'status', 'uraian', 'pergeseran_ke'));
    }
    public function uraian()
    {
        //status rfk
        $tahun = Carbon::now()->format('Y');
        if (Auth::user()->pptk->skpd->murni == 1) {
            $status = 'murni';
        }
        if (Auth::user()->pptk->skpd->pergeseran == 1) {
            $status = 'pergeseran';
        }
        if (Auth::user()->pptk->skpd->perubahan == 1) {
            $status = 'perubahan';
        }
        $ke = Pengajuan::where('skpd_id', Auth::user()->pptk->skpd->id)->where('status', 1)->orderBy('id', 'DESC')->get();
        if (count($ke) != 0) {
            $hasil = $ke->first()->ke;
        }
        if ($status == 'pergeseran') {
            $subkegiatan = Subkegiatan::where('pptk_id', Auth::user()->pptk->id)->where('jenis_rfk', $status)->where('tahun', $tahun)->get();
            $t_uraian = Uraian::where('pptk_id', Auth::user()->pptk->id)->where('jenis_rfk', $status)->where('tahun', $tahun)->count();
            $data = null;

            $uraian = Uraian::where('pptk_id', Auth::user()->pptk->id)->where('jenis_rfk', $status)->where('tahun', $tahun)->orderBy('m_akun_id', 'ASC')->where('ke', $hasil)->get();
            $uraian->map(function ($item) {
                $item->angkas = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan + $item->p_juli_keuangan + $item->p_agustus_keuangan + $item->p_september_keuangan + $item->p_oktober_keuangan + $item->p_november_keuangan + $item->p_desember_keuangan;
                return $item;
            });
        } else {

            $subkegiatan = Subkegiatan::where('pptk_id', Auth::user()->pptk->id)->where('jenis_rfk', $status)->where('tahun', $tahun)->get();
            $t_uraian = Uraian::where('pptk_id', Auth::user()->pptk->id)->where('jenis_rfk', $status)->where('tahun', $tahun)->count();
            $data = null;

            $uraian = Uraian::where('pptk_id', Auth::user()->pptk->id)->where('jenis_rfk', $status)->where('tahun', $tahun)->orderBy('m_akun_id', 'ASC')->get();
            $uraian->map(function ($item) {
                $item->angkas = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan + $item->p_juli_keuangan + $item->p_agustus_keuangan + $item->p_september_keuangan + $item->p_oktober_keuangan + $item->p_november_keuangan + $item->p_desember_keuangan;
                return $item;
            });
        }
        return view('pptk.home_uraian', compact('data', 't_uraian', 'uraian', 'status', 'tahun', 'subkegiatan'));
    }
}
