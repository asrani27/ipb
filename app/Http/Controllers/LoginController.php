<?php

namespace App\Http\Controllers;

use captcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        // Session::flash('success', 'Ini notifikasi success');
        // Session::flash('warning', 'Ini notifikasi warning');
        // Session::flash('info', 'Ini notifikasi info');
        // Session::flash('error', 'Ini notifikasi error');

        if (Auth::check()) {
            if (Auth::user()->hasRole('superadmin')) {
                return redirect('/beranda');
            } elseif (Auth::user()->hasRole('admin')) {
                return redirect('/berandaskpd');
            } elseif (Auth::user()->hasRole('bidang')) {
                return redirect('/berandabidang');
            } elseif (Auth::user()->hasRole('pptk')) {
                return redirect('/berandapptk');
            } else {
                return 'role lain';
            }
        }
        return view('welcome');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    public function login(Request $req)
    {
        $remember = $req->remember ? true : false;
        $credential = $req->only('username', 'password');

        if (Auth::attempt($credential, $remember)) {

            if (Auth::user()->hasRole('superadmin')) {
                Session::flash('success', 'Selamat Datang');
                return redirect('/beranda');
            } elseif (Auth::user()->hasRole('admin')) {
                Session::flash('success', 'Selamat Datang');
                return redirect('/berandaskpd');
            } elseif (Auth::user()->hasRole('bidang')) {
                Session::flash('success', 'Selamat Datang');
                return redirect('/berandabidang');
            } elseif (Auth::user()->hasRole('pptk')) {
                Session::flash('success', 'Selamat Datang');
                return redirect('/berandapptk');
            } else {
                Session::flash('success', 'Selamat Datang');
                return 'role lain';
            }

        } else {
            Session::flash('error', 'username/password salah');
            $req->flash();
            return back();
        }
    }
}
