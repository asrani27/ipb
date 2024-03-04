<?php

namespace App\Http\Controllers;

use App\Models\PPTK;
use App\Models\Tahun;
use App\Models\Bidang;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\Subkegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class TarikDataController extends Controller
{
    public function index()
    {
        $skpd_id = Auth::user()->skpd->id;
        $tahun = Tahun::get()->map(function ($item) use ($skpd_id) {
            $item->program = Program::where('tahun', $item->nama)->where('skpd_id', $skpd_id)->count();
            $item->kegiatan = Kegiatan::where('tahun', $item->nama)->where('skpd_id', $skpd_id)->count();
            $item->subkegiatan = Subkegiatan::where('tahun', $item->nama)->where('skpd_id', $skpd_id)->count();
            return $item;
        });
        return view('admin.datatarik.index', compact('tahun'));
    }
    public function program($tahun)
    {
        $skpd_id = Auth::user()->skpd->id;
        $bidang = Bidang::where('skpd_id', $skpd_id)->get();
        $data = Program::where('tahun', $tahun)->where('skpd_id', $skpd_id)->get();
        return view('admin.datatarik.program', compact('data', 'bidang'));
    }
    public function updateBidang(Request $req)
    {
        foreach ($req->program_id as $key => $item) {
            Program::find($item)->update([
                'bidang_id' => $req->bidang_id[$key],
            ]);
            Program::find($item)->kegiatan->map->update([
                'bidang_id' => $req->bidang_id[$key],
            ]);
            Program::find($item)->kegiatan->map(function ($keg)  use ($req, $key) {
                return $keg->subkegiatan->map(function ($sub) use ($req, $key) {
                    $sub->update([
                        'bidang_id' => $req->bidang_id[$key],
                    ]);
                    return $sub;
                });
            });
        }
        Session::flash('success', 'Berhasil Di Update');
        return back();
    }
    public function updatePPTK(Request $req)
    {
        foreach ($req->subkegiatan_id as $key => $item) {
            Subkegiatan::find($item)->update([
                'pptk_id' => $req->pptk_id[$key],
            ]);
        }
        Session::flash('success', 'Berhasil Di Update');
        return back();
    }
    public function kegiatan($tahun)
    {
        $skpd_id = Auth::user()->skpd->id;
        $data = Kegiatan::where('tahun', $tahun)->where('skpd_id', $skpd_id)->get();
        return view('admin.datatarik.kegiatan', compact('data'));
    }
    public function subkegiatan($tahun)
    {
        $skpd_id = Auth::user()->skpd->id;
        $data = Subkegiatan::where('tahun', $tahun)->where('skpd_id', $skpd_id)->get();
        $pptk = PPTK::where('skpd_id', $skpd_id)->get();
        return view('admin.datatarik.subkegiatan', compact('data', 'pptk'));
    }
    public function tarikData(Request $req)
    {
        $tahun = $req->tahun;
        $kode_skpd = Auth::user()->username;
        $skpd_id = Auth::user()->skpd->id;

        $response = Http::get('http://kayuhbaimbai.banjarmasinkota.go.id/api/programs/' . $kode_skpd . '/' . $tahun)->json();

        foreach ($response as $key => $program) {
            //simpan program
            $checkProgram = Program::where('skpd_id', $skpd_id)->where('tahun', $tahun)->where('nama', $program['nama'])->first();
            if ($checkProgram == null) {
                $n = new Program;
                $n->nama = $program['nama'];
                $n->tahun = $tahun;
                $n->skpd_id = $skpd_id;
                $n->integrasi_id = $program['id'];
                $n->save();
            }

            foreach ($program['kegiatans'] as $keg => $kegiatan) {
                $checkKegiatan = Kegiatan::where('skpd_id', $skpd_id)->where('tahun', $tahun)->where('nama', $kegiatan['nama'])->first();
                //Simpan kegiatan
                if ($checkKegiatan == null) {
                    $k = new Kegiatan;
                    $k->program_id = Program::where('integrasi_id', $program['id'])->first()->id;
                    $k->nama = $kegiatan['nama'];
                    $k->tahun = $tahun;
                    $k->skpd_id = $skpd_id;
                    $k->integrasi_id = $kegiatan['id'];
                    $k->save();
                }
            }
            foreach ($kegiatan['sub_kegiatans'] as $sub => $subkegiatan) {
                $checkSub = Subkegiatan::where('skpd_id', $skpd_id)->where('tahun', $tahun)->where('nama', $subkegiatan['nama'])->first();
                //Simpan kegiatan
                if ($checkSub == null) {
                    $k = new Subkegiatan;
                    $k->program_id = Program::where('integrasi_id', $program['id'])->first()->id;
                    $k->kegiatan_id = Kegiatan::where('integrasi_id', $kegiatan['id'])->first()->id;
                    $k->nama = $subkegiatan['nama'];
                    $k->tahun = $tahun;
                    $k->skpd_id = $skpd_id;
                    $k->integrasi_id = $subkegiatan['id'];
                    $k->jenis_rfk = 'murni';
                    $k->save();
                } else {
                    $checkSub->update(['jenis_rfk' => 'murni']);
                }
            }
        }
        Session::flash('success', 'Berhasil Di Tarik');
        return back();
    }
}
