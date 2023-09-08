<?php

namespace App\Http\Controllers\Api;

use App\Models\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\M_indikator;
use App\Models\M_program;

class RestController extends Controller
{
    public function programSkpd($skpd_id, $tahun)
    {
        $data = M_program::where('skpd_id', $skpd_id)->where('tahun', $tahun)->get()->map(
            function ($item) use ($tahun, $skpd_id) {
                $item->indikator = M_indikator::where('tahun', $tahun)->where('skpd_id', $skpd_id)->where('kode', $item->kode)->get();
                $item->kegiatan = $item->kegiatan->map(function ($item2) {
                    $item2->subkegiatan = $item2->subkegiatan;
                    return $item2;
                });
                return $item;
            }
        );

        return response()->json($data);
    }
}
