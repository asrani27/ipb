<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Bidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminBidangController extends Controller
{
    public function index()
    {
        $data = Bidang::where('skpd_id', Auth::user()->skpd->id)->get();
        return view('admin.bidang.index', compact('data'));
    }

    public function create()
    {
        return view('admin.bidang.create');
    }

    public function store(Request $req)
    {
        $n = new Bidang;
        $n->nama = $req->nama;
        $n->skpd_id = Auth::user()->skpd->id;
        $n->save();

        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/admin/bidang');
    }

    public function edit($id)
    {
        $data = Bidang::find($id);
        return view('admin.bidang.edit', compact('data'));
    }

    public function resetpass($id)
    {
        Bidang::find($id)->user->update([
            'password' => bcrypt('123456'),
        ]);
        Session::flash('success', 'Password Baru : 123456');
        return back();
    }
    public function delete($id)
    {
        try {
            Bidang::find($id)->delete();
            Session::flash('success', 'berhasil di hapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena memiliki Data terkait Program');
            return back();
        }
    }

    public function update(Request $req, $id)
    {
        $n = Bidang::find($id);
        $n->nama = $req->nama;
        $n->save();

        Session::flash('success', 'berhasil di update');
        return redirect('/admin/bidang');
    }

    public function createuser($id)
    {
        $data = Bidang::find($id);
        return view('admin.bidang.createuser', compact('data'));
    }

    public function storeuser(Request $req, $id)
    {
        $bidang = Bidang::find($id);

        if (Auth::user()->skpd->id != $bidang->skpd_id) {
            Session::flash('info', 'Bidang Ini Bukan di SKPD anda');

            return back();
        }

        DB::beginTransaction();
        try {
            $role = Role::where('name', 'bidang')->first();
            $check = User::where('username', $req->username)->first();
            if ($check != null) {
                Session::flash('info', 'Username sudah ada, silahkan coba yang lain');
                return back();
            } else {
                $n = new User;
                $n->name = $bidang->nama;
                $n->username = $req->username;
                $n->password = bcrypt($req->password);
                $n->save();

                $n->roles()->attach($role);

                $bidang->update(['user_id' => $n->id]);
            }
            DB::commit();
            Session::flash('success', 'Berhasil Di Buat');
            return redirect('/admin/bidang');
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Sistem Error');
            return back();
        }
    }
}
