<?php

namespace App\Http\Controllers;

use App\Models\PPTK;
use App\Models\Role;
use App\Models\User;
use App\Models\Bidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminPptkController extends Controller
{

    public function index()
    {
        $data = PPTK::where('skpd_id', Auth::user()->skpd->id)->get();
        return view('admin.pptk.index', compact('data'));
    }

    public function create()
    {
        $bidang = Bidang::where('skpd_id', Auth::user()->skpd->id)->get();
        return view('admin.pptk.create', compact('bidang'));
    }

    public function store(Request $req)
    {

        if (preg_match('/\s/', $req->nip_pptk)) {
            Session::flash('warning', 'tidak boleh ada spasi');
            return back();
        } else {
            $check = PPTK::where('nip_pptk', $req->nip_pptk)->where('skpd_id', Auth::user()->skpd->id)->first();
            if ($check == null) {
                $n = new PPTK;
                $n->nip_pptk = $req->nip_pptk;
                $n->nama_pptk = $req->nama_pptk;
                $n->bidang_id = $req->bidang_id;
                $n->skpd_id = Auth::user()->skpd->id;
                $n->save();

                Session::flash('success', 'Berhasil Disimpan');
                return redirect('/admin/pptk');
            } else {
                Session::flash('error', 'NIP sudah ada');
                $req->flash();
                return back();
            }
        }
    }

    public function edit($id)
    {
        $data = PPTK::find($id);
        $bidang = Bidang::where('skpd_id', Auth::user()->skpd->id)->get();
        return view('admin.pptk.edit', compact('data', 'bidang'));
    }

    public function hapusakun($id)
    {
        PPTK::find($id)->user->delete();
        Session::flash('success', 'Berhasil dihapus');
        return back();
    }
    public function resetpass($id)
    {

        PPTK::find($id)->user->update([
            'password' => bcrypt('pptk123456'),
        ]);
        Session::flash('success', 'Password Baru : pptk123456');
        return back();
    }
    public function delete($id)
    {
        try {
            $pptk = PPTK::find($id);
            User::find($pptk->user_id)->delete();
            $pptk->delete();
            Session::flash('success', 'berhasil di hapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena memiliki Data terkait');
            return back();
        }
    }

    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'nip_pptk' => 'required|unique:pptk,nip_pptk,' . $id,
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'NIP Sudah ada');
            return back();
        }

        $n = PPTK::find($id);
        $n->nama_pptk = $req->nama_pptk;
        $n->bidang_id = $req->bidang_id;
        $n->save();

        Session::flash('success', 'berhasil di update');
        return redirect('/admin/pptk');
    }

    public function createuser($id)
    {
        $data = PPTK::find($id);
        if (Auth::user()->skpd->id != $data->skpd_id) {
            Session::flash('info', 'PPTK Ini Bukan di SKPD anda');

            return back();
        }
        return view('admin.pptk.createuser', compact('data'));
    }
    public function storeuser(Request $req, $id)
    {
        if (preg_match('/\s/', $req->username)) {
            $req->flash();
            Session::flash('warning', 'username tidak boleh ada spasi');
            return back();
        }
        if (preg_match('/\s/', $req->password)) {
            $req->flash();
            Session::flash('warning', 'password tidak boleh ada spasi');
            return back();
        }
        if (strlen($req->username) < 8) {
            $req->flash();
            Session::flash('warning', 'username minimal 8 karakter');
            return back();
        }
        if (strlen($req->password) < 8) {
            $req->flash();
            Session::flash('warning', 'password minimal 8 karakter');
            return back();
        }

        $data = PPTK::find($id);
        if (Auth::user()->skpd->id != $data->skpd_id) {
            Session::flash('info', 'PPTK Ini Bukan di SKPD anda');

            return back();
        }
        DB::beginTransaction();
        try {
            $role = Role::where('name', 'pptk')->first();
            $check = User::where('username', $req->username)->first();
            if ($check != null) {
                Session::flash('info', 'Username sudah ada, silahkan coba yang lain');
                return back();
            } else {
                $n = new User;
                $n->name = $data->nama_pptk;
                $n->username = $req->username;
                $n->password = bcrypt($req->password);
                $n->save();

                $n->roles()->attach($role);

                $data->update(['user_id' => $n->id]);
            }
            DB::commit();
            Session::flash('success', 'Berhasil Di Buat');
            $req->flash();
            return redirect('/admin/pptk');
        } catch (\Exception $e) {

            DB::rollback();
            Session::flash('error', 'Sistem Error');
            return back();
        }
    }
}
