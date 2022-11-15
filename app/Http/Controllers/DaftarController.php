<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Pemohon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;

class DaftarController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('superadmin')) {
                return redirect('superadmin');
            } elseif (Auth::user()->hasRole('pemohon')) {
                return redirect('pemohon');
            }
        }
        return view('daftar');
    }

    public function daftar(Request $req)
    {
        $req->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|min:8|unique:users,username',
            'password' => 'required|confirmed|min:6'
        ]);
        $req->flash();


        // Begin Transaction
        DB::beginTransaction();
        try {
            $pemohon = Pemohon::create($req->all());

            $attr               = $req->all();
            $attr['name']       = $req->nama;
            $attr['password']   = bcrypt($req->password);
            $attr['pemohon_id'] = $pemohon->id;

            $role = Role::where('name', 'pemohon')->first();

            $user = User::create($attr);

            $user->roles()->attach($role);

            Auth::login($user);

            DB::commit();

            Session::flash('success', 'Ini notifikasi success');
            return redirect('/pemohon');
        } catch (\Exception $e) {
            DB::rollback();

            Session::flash('error', 'Error');
            return back();
        }
    }
}
