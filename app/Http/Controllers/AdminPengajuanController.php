<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPengajuanController extends Controller
{
    public function index()
    {
        $data = Pengajuan::where('skpd_id', Auth::user()->skpd->id)->get();
        return view('admin.pengajuan.index', compact('data'));
    }

    public function create()
    {
        return view('admin.pengajuan.create');
    }

    public function store(Request $req)
    {

        $check = Pengajuan::where('skpd_id',  Auth::user()->skpd->id)->where('tahun', $req->tahun)->where('status', 0)->first();
        if ($check == null) {
            if (Pengajuan::where('skpd_id',  Auth::user()->skpd->id)->where('tahun', $req->tahun)->where('ke', $req->ke)->first() == null) {
                $n = new Pengajuan;
                $n->skpd_id = Auth::user()->skpd->id;
                $n->tahun = $req->tahun;
                $n->ke = $req->ke;
                $n->save();
                Session::flash('success', 'Berhasil Disimpan');
                return redirect('/admin/pengajuan');
            } else {
                Session::flash('error', 'pengajuan ke : ' . $req->ke . 'Sudah ada');
                return back();
            }
        } else {
            Session::flash('error', 'Tidak bisa mengajukan karena ada pengajuan yang belum di verifikasi');
            return back();
        }
    }

    public function edit($id)
    {
        $data = Pengajuan::find($id);
        return view('admin.pengajuan.edit', compact('data'));
    }
    public function delete($id)
    {
        try {
            Pengajuan::find($id)->delete();
            Session::flash('success', 'berhasil di hapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena memiliki Data terkait Program');
            return back();
        }
    }

    public function update(Request $req, $id)
    {
        $n = Pengajuan::find($id);
        $n->nama = $req->nama;
        $n->save();

        Session::flash('success', 'berhasil di update');
        return redirect('/admin/pengajuan');
    }

    public function storeuser(Request $req, $id)
    {
        $Pengajuan = Pengajuan::find($id);

        if (Auth::user()->skpd->id != $Pengajuan->skpd_id) {
            Session::flash('info', 'Pengajuan Ini Bukan di SKPD anda');

            return back();
        }

        DB::beginTransaction();
        try {
            $role = Role::where('name', 'Pengajuan')->first();
            $check = User::where('username', $req->username)->first();
            if ($check != null) {
                Session::flash('info', 'Username sudah ada, silahkan coba yang lain');
                return back();
            } else {
                $n = new User;
                $n->name = $Pengajuan->nama;
                $n->username = $req->username;
                $n->password = bcrypt($req->password);
                $n->save();

                $n->roles()->attach($role);

                $Pengajuan->update(['user_id' => $n->id]);
            }
            DB::commit();
            Session::flash('success', 'Berhasil Di Buat');
            return redirect('/admin/pengajuan');
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Sistem Error');
            return back();
        }
    }
}
