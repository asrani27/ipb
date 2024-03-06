<?php

namespace App\Http\Controllers;

use App\Models\PPTK;
use App\Models\Tahun;
use App\Models\Bidang;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\Subkegiatan;
use Illuminate\Support\Str;
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

        $program = Http::get('http://kayuhbaimbai.banjarmasinkota.go.id/api/programs/' . $kode_skpd . '/' . $tahun)->json();
        //dd($program, $kode_skpd);
        foreach ($program as $key => $item) {
            //check
            $check = Program::where('skpd_id', $skpd_id)->where('tahun', $tahun)->where('integrasi_id', $item['id'])->get()->first();
            if ($check == null) {
                $n = new Program;
                $n->nama = $item['nama'];
                $n->tahun = $tahun;
                $n->skpd_id = $skpd_id;
                $n->integrasi_id = $item['id'];
                $n->save();
            } else {
                $check->update([
                    'nama' => $item['nama']
                ]);
            }
        }

        $kegiatan = Http::get('http://kayuhbaimbai.banjarmasinkota.go.id/api/kegiatans/' . $kode_skpd . '/' . $tahun)->json();

        foreach ($kegiatan as $key => $item) {
            //check
            $check = Kegiatan::where('skpd_id', $skpd_id)->where('tahun', $tahun)->where('integrasi_id', $item['id'])->get()->first();
            if ($check == null) {
                $k = new Kegiatan;
                $k->program_id = Program::where('integrasi_id', $item['id_program'])->first()->id;
                $k->nama = $item['nama'];
                $k->tahun = $tahun;
                $k->skpd_id = $skpd_id;
                $k->integrasi_id = $item['id'];
                $k->save();
            } else {
                $check->update([
                    'nama' => $item['nama']
                ]);
            }
        }

        $subkegiatan = Http::get('http://kayuhbaimbai.banjarmasinkota.go.id/api/sub_kegiatans/' . $kode_skpd . '/' . $tahun)->json();

        foreach ($subkegiatan as $key => $item) {

            $check = Subkegiatan::where('skpd_id', $skpd_id)->where('tahun', $tahun)->where('integrasi_id', $item['id'])->get()->first();
            if ($check == null) {
                $sub = new Subkegiatan;
                $sub->program_id = Kegiatan::where('integrasi_id', $item['id_kegiatan'])->first()->program->id;
                $sub->kegiatan_id = Kegiatan::where('integrasi_id', $item['id_kegiatan'])->first()->id;
                $sub->nama = $item['nama'];
                $sub->tahun = $tahun;
                $sub->skpd_id = $skpd_id;
                $sub->integrasi_id = $item['id'];
                $sub->jenis_rfk = 'murni';
                $sub->save();
            } else {
                $check->update([
                    'nama' => $item['nama']
                ]);
            }
        }
        Session::flash('success', 'Berhasil Di Tarik');
        $req->flash();
        return back();
    }
}
