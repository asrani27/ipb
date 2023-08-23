<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Carbon\Carbon;
use App\Models\Uraian;
use App\Models\Program;
use App\Models\Subkegiatan;
use App\Models\LogBukaTutup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminBerandaController extends Controller
{
    public function duplikatData()
    {
        //Membuka pergeseran, duplikat data mulai dari program, kegiatan, subkegiatan dan uraian berdasarkan tahun

        $logLatest = LogBukaTutup::where('skpd_id', Auth::user()->skpd->id)->latest()->first();
        if ($logLatest->ke == null) {
            $ke = 1;
        } else {
            $ke = $logLatest->ke + 1;
        }

        $tahun = Carbon::now()->format('Y');
        //menduplikat program
        $program = Program::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->where('jenis_rfk', 'murni')->get();

        foreach ($program as $key => $item) {
            $param = $item->toArray();
            $param['ke'] = $ke;
            $param['jenis_rfk'] = 'pergeseran';
            $param['before_id'] = $item->id;

            Program::create($param);
        }

        $kegiatan = Kegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->where('jenis_rfk', 'murni')->get();
        foreach ($kegiatan as $key => $item) {
            //dd($item, Program::where('before_id', $item->id)->get());
            $param = $item->toArray();
            $param['ke'] = $ke;
            $param['jenis_rfk'] = 'pergeseran';
            $param['before_id'] = $item->id;
            $param['program_id'] = Program::where('before_id', $item->program_id)->first()->id;

            Kegiatan::create($param);
        }

        $subkegiatan = Subkegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->where('jenis_rfk', 'murni')->get();
        foreach ($subkegiatan as $key => $item) {

            $param = $item->toArray();
            $param['ke'] = $ke;
            $param['jenis_rfk'] = 'pergeseran';
            $param['before_id'] = $item->id;
            $param['program_id'] = Program::where('before_id', $item->program_id)->first()->id;
            $param['kegiatan_id'] = Kegiatan::where('before_id', $item->kegiatan_id)->first()->id;

            Subkegiatan::create($param);
        }
        $uraian = Uraian::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->where('jenis_rfk', 'murni')->get();

        foreach ($uraian as $key => $item) {

            $param = $item->toArray();
            $param['ke'] = $ke;
            $param['jenis_rfk'] = 'pergeseran';
            $param['before_id'] = $item->id;
            $param['program_id'] = Program::where('before_id', $item->program_id)->first()->id;
            $param['kegiatan_id'] = Kegiatan::where('before_id', $item->kegiatan_id)->first()->id;
            $param['subkegiatan_id'] = Subkegiatan::where('before_id', $item->subkegiatan_id)->first()->id;

            Uraian::create($param);
        }

        // if ($logLatest->ke == null) {
        //     $tahun = Carbon::now()->year;
        //     $data = Uraian::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->get()->toArray();
        //     foreach ($data as $i) {
        //         $attr = $i;
        //         $attr['uraian_id'] = $i['id'];
        //         $attr['ke'] = $attr['status'] == null ? 1 : $attr['ke'] + 1;
        //         Uraian::create($attr);
        //     }

        //     return $data;
        // } else {
        //     $tahun = Carbon::now()->year;
        //     $data = Uraian::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->where('ke', $logLatest->ke)->get()->toArray();

        //     foreach ($data as $i) {
        //         $attr = $i;
        //         $attr['uraian_id'] = $i['uraian_id'];
        //         $attr['ke'] = $attr['ke'] == null ? 1 : $attr['ke'] + 1;
        //         Uraian::create($attr);
        //     }

        //     return $data;
        // }
    }
    public function duplikatPergeseran()
    {
        //Membuka pergeseran, duplikat data mulai dari program, kegiatan, subkegiatan dan uraian berdasarkan tahun

        $logLatest = LogBukaTutup::where('skpd_id', Auth::user()->skpd->id)->latest()->first();
        if ($logLatest->ke == null) {
            $ke = 1;
        } else {
            $ke = $logLatest->ke;
        }

        $tahun = Carbon::now()->format('Y');
        //menduplikat program
        $program = Program::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->where('jenis_rfk', 'pergeseran')->where('ke', $ke)->get();

        foreach ($program as $key => $item) {
            $param = $item->toArray();
            $param['ke'] = null;
            $param['jenis_rfk'] = 'perubahan';
            $param['before_id'] = $item->id;

            Program::create($param);
        }

        $kegiatan = Kegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->where('jenis_rfk', 'pergeseran')->where('ke', $ke)->get();
        foreach ($kegiatan as $key => $item) {
            //dd($item, Program::where('before_id', $item->id)->get());
            $param = $item->toArray();
            $param['ke'] = null;
            $param['jenis_rfk'] = 'perubahan';
            $param['before_id'] = $item->id;
            $param['program_id'] = Program::where('before_id', $item->program_id)->first()->id;

            Kegiatan::create($param);
        }

        $subkegiatan = Subkegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->where('jenis_rfk', 'pergeseran')->where('ke', $ke)->get();
        foreach ($subkegiatan as $key => $item) {

            $param = $item->toArray();
            $param['ke'] = null;
            $param['jenis_rfk'] = 'perubahan';
            $param['before_id'] = $item->id;
            $param['program_id'] = Program::where('before_id', $item->program_id)->first()->id;
            $param['kegiatan_id'] = Kegiatan::where('before_id', $item->kegiatan_id)->first()->id;

            Subkegiatan::create($param);
        }
        $uraian = Uraian::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->where('jenis_rfk', 'pergeseran')->where('ke', $ke)->get();

        foreach ($uraian as $key => $item) {

            $param = $item->toArray();
            $param['ke'] = null;
            $param['jenis_rfk'] = 'perubahan';
            $param['before_id'] = $item->id;
            $param['program_id'] = Program::where('before_id', $item->program_id)->first()->id;
            $param['kegiatan_id'] = Kegiatan::where('before_id', $item->kegiatan_id)->first()->id;
            $param['subkegiatan_id'] = Subkegiatan::where('before_id', $item->subkegiatan_id)->first()->id;

            Uraian::create($param);
        }
    }
    public function index()
    {
        $murni = Auth::user()->skpd->murni;
        $perubahan = Auth::user()->skpd->perubahan;
        $realisasi = Auth::user()->skpd->realisasi;
        $pergeseran = Auth::user()->skpd->pergeseran;
        $log = LogBukaTutup::orderBy('id', 'DESC')->paginate(15);
        if (Auth::user()->hasRole('admin')) {
            $t_program = Program::where('skpd_id', Auth::user()->skpd->id)->count();
            $t_kegiatan = Kegiatan::where('skpd_id', Auth::user()->skpd->id)->count();
            $t_subkegiatan = Subkegiatan::where('skpd_id', Auth::user()->skpd->id)->count();
            $t_uraian = Uraian::where('skpd_id', Auth::user()->skpd->id)->count();
        }
        if (Auth::user()->hasRole('bidang')) {
            $t_program = Program::where('bidang_id', Auth::user()->bidang->id)->count();
            $t_kegiatan = Kegiatan::where('bidang_id', Auth::user()->bidang->id)->count();
            $t_subkegiatan = Subkegiatan::where('bidang_id', Auth::user()->bidang->id)->count();
            $t_uraian = Uraian::where('bidang_id', Auth::user()->bidang->id)->count();
        }


        return view('admin.home', compact('murni', 'perubahan', 'realisasi', 'pergeseran', 'log', 't_program', 't_kegiatan', 't_subkegiatan', 't_uraian'));
    }

    public function bukaMurni()
    {

        if (LogBukaTutup::where('tahun', Carbon::now()->year)->where('nama', 'murni')->first() != null) {
            Session::flash('info', 'Murni hanya di buka sekali dalam setahun');
            return back();
        }
        if (Auth::user()->skpd->pergeseran != 0) {
            Session::flash('info', 'pergeseran harap di tutup terlebih dahulu');
            return back();
        }
        if (Auth::user()->skpd->perubahan != 0) {
            Session::flash('info', 'perubahan harap di tutup terlebih dahulu');
            return back();
        }

        Auth::user()->skpd->update(['murni' => 1]);

        $n = new LogBukaTutup;
        $n->tahun = Carbon::now()->year;
        $n->nama = 'murni';
        $n->jenis = 'buka';
        $n->skpd_id = Auth::user()->skpd->id;
        $n->save();

        Session::flash('success', 'Penginputan Dibuka');
        return back();
    }
    public function tutupMurni()
    {

        Auth::user()->skpd->update(['murni' => 0]);

        $n = new LogBukaTutup;
        $n->tahun = Carbon::now()->year;
        $n->nama = 'murni';
        $n->jenis = 'tutup';
        $n->skpd_id = Auth::user()->skpd->id;
        $n->save();
        Session::flash('success', 'Penginputan ditutup');
        return back();
    }

    public function bukaPergeseran()
    {
        //check
        if (Auth::user()->skpd->murni != 0) {
            Session::flash('info', 'Murni Harap Di tutup terlebih dahulu');
            return back();
        }
        if (Auth::user()->skpd->perubahan != 0) {
            Session::flash('info', 'perubahan Harap Di tutup terlebih dahulu');
            return back();
        }

        $this->duplikatData();
        //check ke berapa
        $cp = LogBukaTutup::where('tahun', Carbon::now()->year)->where('nama', 'pergeseran')->latest()->first();
        if ($cp == null) {
            //pergeseran pertama
            $n = new LogBukaTutup;
            $n->tahun = Carbon::now()->year;
            $n->nama = 'pergeseran';
            $n->ke = 1;
            $n->jenis = 'buka';
            $n->skpd_id = Auth::user()->skpd->id;
            $n->save();
        } else {
            //pergeseran selanjutnya
            $n = new LogBukaTutup;
            $n->tahun = Carbon::now()->year;
            $n->nama = 'pergeseran';
            $n->ke = $cp->ke + 1;
            $n->jenis = 'buka';
            $n->skpd_id = Auth::user()->skpd->id;
            $n->save();
        }

        Auth::user()->skpd->update(['pergeseran' => 1]);
        Session::flash('success', 'Penginputan Pergeseran Dibuka');

        return back();
    }
    public function tutupPergeseran()
    {
        $cp = LogBukaTutup::where('tahun', Carbon::now()->year)->where('nama', 'pergeseran')->latest()->first();
        Auth::user()->skpd->update(['pergeseran' => 0]);
        $n = new LogBukaTutup;
        $n->tahun = Carbon::now()->year;
        $n->nama = 'pergeseran';
        $n->ke = $cp->ke;
        $n->jenis = 'tutup';
        $n->skpd_id = Auth::user()->skpd->id;
        $n->save();
        Session::flash('success', 'Penginputan Pergeseran Ditutup');
        return back();
    }

    public function bukaPerubahan()
    {
        //check
        if (Auth::user()->skpd->murni != 0) {
            Session::flash('info', 'Murni Harap Di tutup terlebih dahulu');
            return back();
        }
        if (Auth::user()->skpd->pergeseran != 0) {
            Session::flash('info', 'perubahan Harap Di tutup terlebih dahulu');
            return back();
        }


        $this->duplikatPergeseran();

        $tahun = Carbon::now()->year;

        $cp = LogBukaTutup::where('tahun', Carbon::now()->year)->where('nama', 'perubahan')->latest()->first();
        if ($cp == null) {
            //pergeseran pertama
            $n = new LogBukaTutup;
            $n->tahun = Carbon::now()->year;
            $n->nama = 'perubahan';
            $n->ke = null;
            $n->jenis = 'buka';
            $n->skpd_id = Auth::user()->skpd->id;
            $n->save();
        } else {
            //pergeseran selanjutnya
            $n = new LogBukaTutup;
            $n->tahun = Carbon::now()->year;
            $n->nama = 'perubahan';
            $n->ke = $cp->ke + 1;
            $n->jenis = 'buka';
            $n->skpd_id = Auth::user()->skpd->id;
            $n->save();
        }

        Auth::user()->skpd->update(['perubahan' => 1, 'pergeseran' => 0]);
        Session::flash('success', 'Penginputan Pergeseran Dibuka');

        return back();
    }
    public function tutupPerubahan()
    {
        Auth::user()->skpd->update(['perubahan' => 0]);
        Session::flash('success', 'Penginputan Ditutup');
        return back();
    }

    public function bukaRealisasi()
    {
        Auth::user()->skpd->update(['realisasi' => 1]);
        $n = new LogBukaTutup;
        $n->tahun = Carbon::now()->year;
        $n->nama = 'realisasi';
        $n->jenis = 'buka';
        $n->skpd_id = Auth::user()->skpd->id;
        $n->save();
        Session::flash('success', 'Penginputan Dibuka');
        return back();
    }
    public function tutupRealisasi()
    {
        Auth::user()->skpd->update(['realisasi' => 0]);
        $n = new LogBukaTutup;
        $n->tahun = Carbon::now()->year;
        $n->nama = 'realisasi';
        $n->jenis = 'tutup';
        $n->skpd_id = Auth::user()->skpd->id;
        $n->save();
        Session::flash('success', 'Penginputan Ditutup');
        return back();
    }
}
