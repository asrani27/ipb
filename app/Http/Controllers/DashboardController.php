<?php

namespace App\Http\Controllers;

use App\Models\Skpd;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $skpd = Skpd::where('is_aktif', 1)->get();
        return view('dashboard', compact('skpd'));
    }

    // public function testing()
    // {
    //     $skpd = Skpd::where('is_aktif', 1)->get()->map(function (Skpd $item) {
    //         dd($item->getAttributes());
    //         $null = 0;
    //         foreach ($item->getAttributes() as $it) {
    //             if ($it === null) {
    //                 $null++;
    //             }
    //         }
    //         $item->kosong = $null;
    //         return $item;
    //     });
    //     dd($skpd);
    // }
}
