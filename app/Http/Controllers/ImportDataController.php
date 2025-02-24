<?php

namespace App\Http\Controllers;

use App\Imports\KegiatanImport;
use Illuminate\Http\Request;
use App\Imports\KodeRekeningImport;
use App\Imports\ProgramImport;
use App\Imports\SubKegiatanImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportDataController extends Controller
{
    public function index()
    {
        return view('superadmin.import');
    }

    public function koderekening(Request $req)
    {
        Excel::import(new KodeRekeningImport, $req->file);
        return back();
    }

    public function subkegiatan(Request $req)
    {
        Excel::queueImport(new SubKegiatanImport, $req->file('file'));
        return back();
    }

    public function kegiatan(Request $req)
    {
        Excel::queueImport(new KegiatanImport, $req->file('file'));
        return back();
    }

    public function program(Request $req)
    {
        Excel::queueImport(new ProgramImport, $req->file('file'));
        return back();
    }
}
