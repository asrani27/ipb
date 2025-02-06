<?php

namespace App\Http\Controllers;

use App\Models\PPTK;
use App\Models\Tahun;
use App\Models\Bagian;
use App\Models\Bidang;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\Kelurahan;
use App\Models\Subkegiatan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MasterProgram;
use App\Models\MasterKegiatan;
use App\Models\MasterSubKegiatan;
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
        if (Auth::user()->username == "4.01.03.") {
            foreach ($req->subkegiatan_id as $key => $item) {
                Subkegiatan::find($item)->update([
                    'pptk_id' => $req->pptk_id[$key],
                    'bagian_id' => $req->bagian_id[$key],
                ]);
            }
        } elseif (Auth::user()->username == "4.01.09." || Auth::user()->username == "4.01.10." || Auth::user()->username == "4.01.11." || Auth::user()->username == "4.01.12." || Auth::user()->username == "4.01.13.") {
            foreach ($req->subkegiatan_id as $key => $item) {
                Subkegiatan::find($item)->update([
                    'pptk_id' => $req->pptk_id[$key],
                    'kelurahan_id' => $req->kelurahan_id[$key],
                ]);
            }
        } else {
            foreach ($req->subkegiatan_id as $key => $item) {
                Subkegiatan::find($item)->update([
                    'pptk_id' => $req->pptk_id[$key],
                ]);
            }
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
    public function detail($tahun)
    {
        return view('admin.datatarik.detail', compact('data'));
    }
    public function subkegiatan($tahun)
    {
        $skpd_id = Auth::user()->skpd->id;
        $data = Subkegiatan::where('tahun', $tahun)->where('skpd_id', $skpd_id)->get();
        $pptk = PPTK::where('skpd_id', $skpd_id)->get();
        $bagian = Bagian::get();
        $kelurahan = Kelurahan::where('skpd_id', Auth::user()->skpd->id)->get();
        return view('admin.datatarik.subkegiatan', compact('data', 'pptk', 'bagian', 'kelurahan', 'tahun'));
    }

    public function add_subkegiatan($tahun)
    {
        $subkegiatan = MasterSubKegiatan::get();
        return view('admin.datatarik.add_subkegiatan', compact('subkegiatan', 'tahun'));
    }
    public function store_subkegiatan(Request $req, $tahun)
    {
        $subkegiatan = MasterSubKegiatan::find($req->subkegiatan_id);

        $n = new Subkegiatan();
        $n->kode = $subkegiatan->kode;
        $n->nama = $subkegiatan->nama;
        $n->tahun =  $tahun;
        $n->skpd_id = Auth::user()->skpd->id;
        $n->jenis_rfk = 'murni';
        $n->save();

        $checkProgram = Program::where('tahun',  $tahun)->where('skpd_id', Auth::user()->skpd->id)->where('kode', substr($subkegiatan->kode, 0, 7))->first();
        if ($checkProgram == null) {
            $p = new Program();
            $p->skpd_id = Auth::user()->skpd->id;
            $p->tahun = $tahun;
            $p->nama = MasterProgram::where('kode', $subkegiatan->kode_program)->first()->nama;
            $p->kode = $subkegiatan->kode_program;
            $p->jenis_rfk = 'murni';
            $p->save();
            $n->update([
                'program_id' => $p->id,
                'kode' => $subkegiatan->kode,
            ]);
        } else {
            $n->update([
                'program_id' => $checkProgram->id,
                'kode' => $subkegiatan->kode,
            ]);
        }

        $checkKegiatan = Kegiatan::where('tahun',  $tahun)->where('skpd_id', Auth::user()->skpd->id)->where('kode', substr($subkegiatan->kode, 0, 12))->first();
        if ($checkKegiatan == null) {
            $k = new Kegiatan();
            $k->skpd_id = Auth::user()->skpd->id;
            $k->tahun =  $tahun;
            $k->program_id = Program::where('kode', $subkegiatan->kode_program)->where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->first()->id;
            $k->nama = MasterKegiatan::where('kode', $subkegiatan->kode_kegiatan)->first()->nama;
            $k->kode = $subkegiatan->kode_kegiatan;
            $k->jenis_rfk = 'murni';
            $k->save();
            $n->update([
                'kegiatan_id' => $k->id,
                'kode' => $subkegiatan->kode,
            ]);
        } else {
            $n->update([
                'kegiatan_id' => $checkKegiatan->id,
                'kode' => $subkegiatan->kode,
            ]);
        }

        Session::flash('success', 'Berhasil Di Update');
        return redirect('admin/datatarik/subkegiatan/' . $tahun);
    }
    public function tarikData(Request $req)
    {

        Session::flash('info', 'FITUR INI DI NONAKTIFKAN');
        return back();

        $tahun = $req->tahun;
        $kode_skpd = Auth::user()->username;
        $skpd_id = Auth::user()->skpd->id;

        $program = Http::get('http://kayuhbaimbai.banjarmasinkota.go.id/api/programs/' . $kode_skpd . '/' . $tahun)->json();
        //dd($program);
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
                    'nama' => $item['nama'],
                    'skpd_id' => $skpd_id,
                    'tahun' => $tahun,
                ]);
            }
        }

        $kegiatan = Http::get('http://kayuhbaimbai.banjarmasinkota.go.id/api/kegiatans/' . $kode_skpd . '/' . $tahun)->json();
        //dd($kegiatan);
        foreach ($kegiatan as $key => $item) {
            //check
            $check = Kegiatan::where('skpd_id', $skpd_id)->where('tahun', $tahun)->where('integrasi_id', $item['id'])->get()->first();
            if ($check == null) {
                $k = new Kegiatan;
                $k->program_id = Program::where('skpd_id', $skpd_id)->where('tahun', $tahun)->where('integrasi_id', $item['id_program'])->first()->id;
                $k->nama = $item['nama'];
                $k->tahun = $tahun;
                $k->skpd_id = $skpd_id;
                $k->integrasi_id = $item['id'];
                $k->save();
            } else {
                $check->update([
                    'nama' => $item['nama'],
                    'skpd_id' => $skpd_id,
                    'tahun' => $tahun,
                    'program_id' => Program::where('skpd_id', $skpd_id)->where('tahun', $tahun)->where('integrasi_id', $item['id_program'])->first()->id,
                ]);
            }
        }

        $subkegiatan = Http::get('http://kayuhbaimbai.banjarmasinkota.go.id/api/sub_kegiatans/' . $kode_skpd . '/' . $tahun)->json();
        //dd($subkegiatan);
        foreach ($subkegiatan as $key => $item) {
            $check = Subkegiatan::where('skpd_id', $skpd_id)->where('tahun', $tahun)->where('nama', $item['nama'])->where('integrasi_id', $item['id_sub_kegiatan'])->get()->first();
            if ($check == null) {
                $sub = new Subkegiatan;
                $sub->program_id = Kegiatan::where('skpd_id', $skpd_id)->where('tahun', $tahun)->where('integrasi_id', $item['id_kegiatan'])->first()->program->id;
                $sub->kegiatan_id = Kegiatan::where('skpd_id', $skpd_id)->where('tahun', $tahun)->where('integrasi_id', $item['id_kegiatan'])->first()->id;
                $sub->nama = $item['nama'];
                $sub->tahun = $tahun;
                $sub->skpd_id = $skpd_id;
                $sub->integrasi_id = $item['id'];
                $sub->jenis_rfk = 'murni';
                $sub->save();
            } else {
                $check->update([
                    'nama' => $item['nama'],
                    'program_id' => Kegiatan::where('skpd_id', $skpd_id)->where('tahun', $tahun)->where('integrasi_id', $item['id_kegiatan'])->first()->program->id,
                    'kegiatan_id' => Kegiatan::where('skpd_id', $skpd_id)->where('tahun', $tahun)->where('integrasi_id', $item['id_kegiatan'])->first()->id,
                    'skpd_id' => $skpd_id,
                    'tahun' => $tahun,
                    'jabatan_id' => $item['id_jabatan'],
                    'jabatan' => $item['nama_jabatan'],
                ]);
            }
        }
        Session::flash('success', 'Berhasil Di Tarik');
        $req->flash();
        return back();
    }
}
