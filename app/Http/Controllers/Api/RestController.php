<?php

namespace App\Http\Controllers\Api;

use App\Models\PPTK;
use App\Models\Skpd;
use App\Models\Uraian;
use App\Models\Program;
use App\Models\M_program;
use App\Models\T_capaian;
use App\Models\M_indikator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subkegiatan;

class RestController extends Controller
{
    public function rfk($kode_skpd, $tahun)
    {
        $skpd = Skpd::where('kode_skpd', $kode_skpd)->first();
        if ($skpd == null) {
            return response()->json('kode skpd tidak ada');
        } else {
            $data = Uraian::where('skpd_id', $skpd->id)->where('tahun', $tahun)->where('jenis_rfk', 'perubahan')->latest()->get();
            $bulanList = [
                'januari',
                'februari',
                'maret',
                'april',
                'mei',
                'juni',
                'juli',
                'agustus',
                'september',
                'oktober',
                'november',
                'desember'
            ];

            $result = [];

            // Inisialisasi struktur
            foreach ($bulanList as $bulan) {
                $result[$bulan] = [
                    'rencana' => [],
                    'realisasi' => []
                ];
            }

            foreach ($data as $item) {

                // Ambil prefix kode rekening (5.1)
                $prefix = substr($item->kode_rekening, 0, 3);

                foreach ($bulanList as $bulan) {
                    $fieldRencana = "p_{$bulan}_keuangan";
                    $fieldRealisasi = "r_{$bulan}_keuangan";

                    $result[$bulan]['rencana'][$prefix] =
                        ($result[$bulan]['rencana'][$prefix] ?? 0) + $item->$fieldRencana;

                    $result[$bulan]['realisasi'][$prefix] =
                        ($result[$bulan]['realisasi'][$prefix] ?? 0) + $item->$fieldRealisasi;
                }
            }

            // Urutkan hasil agar 5.1 → 5.2 → 5.3 → 5.4
            foreach ($result as $bulan => $dataBulan) {
                ksort($result[$bulan]['rencana'], SORT_NATURAL);
                ksort($result[$bulan]['realisasi'], SORT_NATURAL);
            }

            return response()->json($result);
        }
    }
    public function realisasi($skpd_id, $nip, $tahun)
    {
        $skpd = Skpd::where('kode_skpd', $skpd_id)->first()->id;
        $pptk = PPTK::where('nip_pptk', $nip)->first();
        if ($pptk == null) {
            $resp['message'] = 'pptk tidak di temukan';
            $resp['data'] = [];
        } else {
            $uraian = Uraian::where('pptk_id', $pptk->id)->where('tahun', $tahun)->where('skpd_id', $skpd)->get()->map(function ($item) {
                $subk = Subkegiatan::find($item->subkegiatan_id);
                $item->kode_subkegiatan = $subk->kode;
                $item->nama_subkegiatan = $subk->nama;
                return $item;
            });

            $resp['message'] = 'success';
            $resp['data'] = $uraian;
            $resp['count'] = $uraian->count();
        }
        return response()->json($resp);
    }

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
