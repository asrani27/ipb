<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\BatasInput;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SuperadminBerandaController extends Controller
{
    public function index()
    {
        return view('superadmin.home');
    }
    public function batasinput()
    {
        $data = BatasInput::get();
        return view('superadmin.batasinput.index', compact('data'));
    }
    public function editbatasinput($id)
    {
        $data = BatasInput::find($id);

        return view('superadmin.batasinput.edit', compact('data'));
    }

    public function setaktifbatasinput($id)
    {
        BatasInput::where('is_aktif', 1)->first()->update(['is_aktif' => 0]);
        BatasInput::find($id)->update(['is_aktif' => 1]);
        Session::flash('success', 'Berhasil Di Simpan');
        return back();
    }

    public function updatebatasinput(Request $req, $id)
    {
        $mulaiFormat = $req->mulai;
        $sampaiFormat = $req->sampai;
        $mulai = Carbon::parse($mulaiFormat)->toDateTimeString();
        $sampai = Carbon::parse($sampaiFormat)->toDateTimeString();

        BatasInput::find($id)->update([
            'mulai' => $mulai,
            'sampai' => $sampai
        ]);
        Session::flash('success', 'Berhasil Di Simpan');
        return back();
    }
}
