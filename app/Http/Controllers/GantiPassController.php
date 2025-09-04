<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class GantiPassController extends Controller
{
    public function index()
    {
        return view('gantipass.index');
    }
    public function update(Request $request)
    {

        $user = Auth::user();

        // Cek password lama
        if (!Hash::check($request->password_lama, $user->password)) {
            Session::flash('error', 'Password lama salah');
            return redirect('/gantipass');
        }
        // Cek confirm password
        if ($request->password_baru != $request->confirm_password) {
            Session::flash('error', 'Password tidak sama');
            return redirect('/gantipass');
        }
        // Update password
        $user->password = Hash::make($request->password_baru);
        $user->save();
        Session::flash('success', 'Password berhasil diperbarui.');
        return redirect('/gantipass');
    }
}
