<?php

namespace App\Http\Controllers\Api;

use App\Models\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\M_indikator;
use App\Models\M_program;
use App\Models\T_capaian;

class RestController extends Controller
{
    public function programSkpd($skpd_id, $tahun)
    {
        $data = M_program::where('skpd_id', $skpd_id)->where('tahun', $tahun)->get()->map(
            function ($item) use ($tahun, $skpd_id) {
                $item->indikator = M_indikator::where('tahun', $tahun)->where('jenis', 'program')->where('skpd_id', $skpd_id)->where('kode', $item->kode)->get()->map(function ($indikator_program) use ($tahun, $skpd_id) {
                    $indikator_program->capaian = T_capaian::where('tahun', $tahun)->where('skpd_id', $skpd_id)->where('jenis', 'indikator_program')->where('kode', $indikator_program->kode_indikator)->first();
                    return $indikator_program;
                });

                $item->kegiatan = $item->kegiatan->map(function ($indikator_kegiatan) use ($tahun, $skpd_id) {
                    $indikator_kegiatan->realisasi_tw1 = $indikator_kegiatan->subkegiatan->sum('realisasi_tw1');
                    $indikator_kegiatan->realisasi_tw2 = $indikator_kegiatan->subkegiatan->sum('realisasi_tw2');
                    $indikator_kegiatan->realisasi_tw3 = $indikator_kegiatan->subkegiatan->sum('realisasi_tw3');
                    $indikator_kegiatan->realisasi_tw4 = $indikator_kegiatan->subkegiatan->sum('realisasi_tw4');


                    $indikator_kegiatan->indikator = M_indikator::where('tahun', $tahun)->where('jenis', 'kegiatan')->where('skpd_id', $skpd_id)->where('kode', $indikator_kegiatan->kode)->get()->map(function ($capaian_kegiatan) use ($tahun, $skpd_id) {
                        $capaian_kegiatan->capaian = T_capaian::where('tahun', $tahun)->where('skpd_id', $skpd_id)->where('jenis', 'indikator_kegiatan')->where('kode', $capaian_kegiatan->kode_indikator)->first();
                        return $capaian_kegiatan;
                    });
                    //$indikator_kegiatan->capaian = T_capaian::where('tahun', $tahun)->where('jenis', 'indikator_kegiatan')->where('kode', $indikator_kegiatan->kode_indikator)->first();
                    $indikator_kegiatan->subkegiatan = $indikator_kegiatan->subkegiatan->map(function ($subkegiatan) use ($tahun, $skpd_id) {
                        $realisasi = T_capaian::where('tahun', $tahun)->where('skpd_id', $skpd_id)->where('jenis', 'subkegiatan')->where('kode', $subkegiatan->kode)->first();
                        if ($realisasi == null) {
                            $subkegiatan->realisasi_tw1 = null;
                            $subkegiatan->realisasi_tw2 = null;
                            $subkegiatan->realisasi_tw3 = null;
                            $subkegiatan->realisasi_tw4 = null;
                        } else {
                            $subkegiatan->realisasi_tw1 = (int)$realisasi->tw1;
                            $subkegiatan->realisasi_tw2 = (int)$realisasi->tw2;
                            $subkegiatan->realisasi_tw3 = (int)$realisasi->tw3;
                            $subkegiatan->realisasi_tw4 = (int) $realisasi->tw4;
                        }
                        $subkegiatan->indikator = M_indikator::where('tahun', $tahun)->where('jenis', 'subkegiatan')->where('skpd_id', $skpd_id)->where('kode', $subkegiatan->kode)->get()->map(function ($capaian_subkegiatan) use ($tahun, $skpd_id) {
                            $capaian_subkegiatan->capaian = T_capaian::where('tahun', $tahun)->where('skpd_id', $skpd_id)->where('jenis', 'indikator_subkegiatan')->where('kode', $capaian_subkegiatan->kode_indikator)->first();
                            return $capaian_subkegiatan;
                        });
                        return $subkegiatan;
                    });
                    return $indikator_kegiatan;
                });

                return $item;
            }
        );

        return response()->json($data);
    }
}
