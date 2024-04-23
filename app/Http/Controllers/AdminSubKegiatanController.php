<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\Subkegiatan;
use Illuminate\Http\Request;
use App\Models\M_subkegiatan;
use App\Models\MasterProgram;
use App\Models\MasterKegiatan;
use App\Models\MasterSubKegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminSubKegiatanController extends Controller
{
    public function index()
    {
        $data = M_subkegiatan::where('skpd_id', Auth::user()->skpd->id)->orderBy('id', 'DESC')->paginate(15);
        return view('admin.subkegiatan.index', compact('data'));
    }
    public function edit($id)
    {
        $data = Subkegiatan::find($id);
        $subkegiatan = MasterSubKegiatan::get();
        return view('admin.subkegiatan.edit', compact('data', 'subkegiatan'));
    }

    public function create()
    {
        $subkegiatan = MasterSubKegiatan::get();
        return view('admin.subkegiatan.create', compact('subkegiatan'));
    }

    public function delete($id)
    {
        Subkegiatan::find($id)->delete();
        Session::flash('success', 'Berhasil Di hapus');
        return back();
    }
    public function store(Request $req)
    {
        $subkegiatan = MasterSubKegiatan::find($req->subkegiatan_id);

        $n = new Subkegiatan();
        $n->kode = $subkegiatan->kode;
        $n->nama = $subkegiatan->nama;
        $n->tahun = '2024';
        $n->skpd_id = Auth::user()->skpd->id;
        $n->jenis_rfk = 'murni';
        $n->save();

        $checkProgram = Program::where('tahun', '2024')->where('skpd_id', Auth::user()->skpd->id)->where('kode', substr($subkegiatan->kode, 0, 7))->first();
        if ($checkProgram == null) {
            $p = new Program();
            $p->skpd_id = Auth::user()->skpd->id;
            $p->tahun = '2024';
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

        $checkKegiatan = Kegiatan::where('tahun', '2024')->where('skpd_id', Auth::user()->skpd->id)->where('kode', substr($subkegiatan->kode, 0, 12))->first();
        if ($checkKegiatan == null) {
            $k = new Kegiatan();
            $k->skpd_id = Auth::user()->skpd->id;
            $k->tahun = '2024';
            $k->program_id = Program::where('kode', $subkegiatan->kode_program)->where('skpd_id', Auth::user()->skpd->id)->where('tahun', '2024')->first()->id;
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
        return redirect('admin/datatarik/subkegiatan/2024');
    }
    public function update(Request $req, $id)
    {
        $subkegiatan = MasterSubKegiatan::find($req->subkegiatan_id);

        $checkProgram = Program::where('tahun', $req->tahun)->where('skpd_id', Auth::user()->skpd->id)->where('kode', substr($subkegiatan->kode, 0, 7))->first();
        if ($checkProgram == null) {
            $p = new Program();
            $p->skpd_id = Auth::user()->skpd->id;
            $p->tahun = '2024';
            $p->nama = MasterProgram::where('kode', $subkegiatan->kode_program)->first()->nama;
            $p->kode = $subkegiatan->kode_program;
            $p->jenis_rfk = 'murni';
            $p->save();
            Subkegiatan::find($id)->update([
                'program_id' => $p->id,
                'kode' => $subkegiatan->kode,
            ]);
        } else {
            Subkegiatan::find($id)->update([
                'program_id' => $checkProgram->id,
                'kode' => $subkegiatan->kode,
            ]);
        }
        $checkKegiatan = Kegiatan::where('tahun', $req->tahun)->where('skpd_id', Auth::user()->skpd->id)->where('kode', substr($subkegiatan->kode, 0, 12))->first();
        if ($checkKegiatan == null) {
            $k = new Kegiatan();
            $k->skpd_id = Auth::user()->skpd->id;
            $k->tahun = '2024';
            $k->program_id = Program::where('kode', $subkegiatan->kode_program)->where('skpd_id', Auth::user()->skpd->id)->where('tahun', $req->tahun)->first()->id;
            $k->nama = MasterKegiatan::where('kode', $subkegiatan->kode_kegiatan)->first()->nama;
            $k->kode = $subkegiatan->kode_kegiatan;
            $k->jenis_rfk = 'murni';
            $k->save();
            Subkegiatan::find($id)->update([
                'kegiatan_id' => $k->id,
                'kode' => $subkegiatan->kode,
            ]);
        } else {
            Subkegiatan::find($id)->update([
                'kegiatan_id' => $checkKegiatan->id,
                'kode' => $subkegiatan->kode,
            ]);
        }

        $n = Subkegiatan::find($id)->update([
            'kode' => $subkegiatan->kode,
            'kode_program' => substr($subkegiatan->kode, 0, 7),
            'kode_kegiatan' => substr($subkegiatan->kode, 0, 12),
            'nama' => MasterSubKegiatan::find($req->subkegiatan_id)->nama,
        ]);

        Session::flash('success', 'Berhasil Di Update');
        return redirect('admin/datatarik/subkegiatan/' . $req->tahun);
    }
}
