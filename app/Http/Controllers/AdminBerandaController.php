<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Uraian;
use App\Models\Subkegiatan;
use App\Models\LogBukaTutup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminBerandaController extends Controller
{
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

    public function index()
    {
        $murni = Auth::user()->skpd->murni;
        $perubahan = Auth::user()->skpd->perubahan;
        $realisasi = Auth::user()->skpd->realisasi;
        $pergeseran = Auth::user()->skpd->pergeseran;
        $log = LogBukaTutup::orderBy('id', 'DESC')->paginate(15);
        return view('admin.home', compact('murni', 'perubahan', 'realisasi', 'pergeseran', 'log'));
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
        if (Auth::user()->skpd->realisasi != 0) {
            Session::flash('info', 'Realisasi harap di tutup terlebih dahulu');
            return back();
        }


        Auth::user()->skpd->update(['murni' => 1]);

        $n = new LogBukaTutup;
        $n->tahun = Carbon::now()->year;
        $n->nama = 'murni';
        $n->jenis = 'buka';
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
        $n->save();
        Session::flash('success', 'Penginputan ditutup');
        return back();
    }

    public function bukaPergeseran()
    {
        $this->duplikatData();
        //check
        if (Auth::user()->skpd->murni != 0) {
            Session::flash('info', 'Murni Harap Di tutup terlebih dahulu');
            return back();
        }
        if (Auth::user()->skpd->perubahan != 0) {
            Session::flash('info', 'perubahan Harap Di tutup terlebih dahulu');
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
        $n->save();
        Session::flash('success', 'Penginputan Pergeseran Ditutup');
        return back();
    }

    public function bukaPerubahan()
    {
        $tahun = Carbon::now()->year;
        $duplikatData = Subkegiatan::where('tahun', $tahun)->where('skpd_id', Auth::user()->skpd->id)->get();

        foreach ($duplikatData as $d) {
            $attr = $d->toArray();
            $attr['status'] = 2;
            $check = Uraian::where('subkegiatan_id', $attr['id'])->first();
            //dd($check);
            if ($check == null) {
                $attr['subkegiatan_id'] = $attr['id'];
                Subkegiatan::create($attr);
            }
        }

        Auth::user()->skpd->update(['perubahan' => 1]);
        Session::flash('success', 'Penginputan Dibuka');
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
        $n->save();
        Session::flash('success', 'Penginputan Ditutup');
        return back();
    }
}
