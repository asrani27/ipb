<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Program;
use App\Models\JenisRfk;
use App\Models\Kegiatan;
use App\Models\Subkegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AdminLaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function angkas($id)
    {
        $data = Subkegiatan::find($id);
        $uraian = Subkegiatan::find($id)->uraian;
        $uraian->map(function ($item) {
            $item->jumlah_renc_keuangan = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan + $item->p_juli_keuangan + $item->p_agustus_keuangan + $item->p_september_keuangan + $item->p_oktober_keuangan + $item->p_november_keuangan + $item->p_desember_keuangan;
            $item->jumlah_real_keuangan = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan + $item->r_mei_keuangan + $item->r_juni_keuangan + $item->r_juli_keuangan + $item->r_agustus_keuangan + $item->r_september_keuangan + $item->r_oktober_keuangan + $item->r_november_keuangan + $item->r_desember_keuangan;
            $item->jumlah_renc_fisik = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik + $item->p_mei_fisik + $item->p_juni_fisik + $item->p_juli_fisik + $item->p_agustus_fisik + $item->p_september_fisik + $item->p_oktober_fisik + $item->p_november_fisik + $item->p_desember_fisik;
            $item->jumlah_real_fisik = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik + $item->r_mei_fisik + $item->r_juni_fisik + $item->r_juli_fisik + $item->r_agustus_fisik + $item->r_september_fisik + $item->r_oktober_fisik + $item->r_november_fisik + $item->r_desember_fisik;
            return $item;
        });
        return view('admin.laporan.angkas', compact('data', 'uraian'));
    }

    public function laporan($tahun)
    {
        $bidang = Bidang::count();
        $program = Program::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->count();
        $subkegiatan = Subkegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->count();

        $data = Subkegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->get();
        return view('admin.laporan.laporanrfk', compact('bidang', 'program', 'subkegiatan', 'data'));
    }

    public function batal($id, $bulan)
    {
        Subkegiatan::find($id)->update([
            'kirim_rfk_' . $bulan => null,
        ]);
        Session::flash('success', 'berhasil di batalkan');
        return back();
    }

    public function laporanRfk($tahun, $bulan)
    {

        $statusRFK = JenisRfk::where('skpd_id',  Auth::user()->skpd->id)->where('tahun', $tahun)->first();

        if ($statusRFK[$bulan] == 'murni') {
            $result = null;
        } elseif ($statusRFK[$bulan] == 'perubahan') {
            $result = 99;
        }

        $bidang = Bidang::count();
        $program = Program::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->count();
        $kegiatan = Kegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->count();
        $subkegiatan = Subkegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->count();

        $data = Program::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->get();

        $subkeg = Subkegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->get();

        $totalsubkegiatan = $subkeg->map(function ($item) use ($result) {
            $item->kolom3 = $item->uraian->where('status', $result)->sum('dpa');
            return $item;
        })->sum('kolom3');

        $datasubkegiatan = $subkeg->map(function ($item) use ($result, $totalsubkegiatan, $bulan) {
            $status_kirim = 'kirim_rfk_' . $bulan;
            $item->status_kirim = $item[$status_kirim];
            if ($item->status_kirim == null) {
                $item->kolom3 = 0;
                $item->kolom4 = 0;
                $item->kolom5 = 0;
                $item->kolom6 = 0;
                $item->kolom7 = 0;
                $item->kolom8 = 0;
                $item->kolom9 = 0;
                $item->kolom10 = 0;
                $item->kolom11 = 0;
                $item->kolom12 = 0;
                $item->kolom13 = 0;
                $item->kolom14 = 0;
                $item->kolom15 = 0;
                $item->kolom16 = 0;
                $item->kolom17 = 0;
            } else {
                if ($totalsubkegiatan == 0) {
                    $item->kolom3 = 0;
                    $item->kolom4 = 0;
                    $item->kolom5 = 0;
                    $item->kolom6 = 0;
                    $item->kolom7 = 0;
                    $item->kolom8 = 0;
                    $item->kolom9 = 0;
                    $item->kolom10 = 0;
                    $item->kolom11 = 0;
                    $item->kolom12 = 0;
                    $item->kolom13 = 0;
                    $item->kolom14 = 0;
                    $item->kolom15 = 0;
                    $item->kolom16 = 0;
                    $item->kolom17 = 0;
                } else {
                    $item->kolom3 = $item->uraian->where('status', $result)->sum('dpa');
                    $item->kolom4 = ($item->kolom3 / $totalsubkegiatan) * 100;

                    $item->kolom5 = rencanaSKPD($bulan, $item, $result);

                    $item->kolom6 = ($item->kolom5 / $item->kolom3) * 100;
                    $item->kolom7 = ($item->kolom6 * $item->kolom4) / 100;

                    $item->kolom8 = realisasiSKPD($bulan, $item, $result);

                    $item->kolom9 = ($item->kolom8 / $item->kolom3) * 100;
                    $item->kolom10 = ($item->kolom9 * $item->kolom4) / 100;
                    if ($item->kolom8 == 0 && $item->kolom5 == 0) {
                        $item->kolom11 = 0;
                    } else {
                        $item->kolom11 = ($item->kolom8 / $item->kolom5) * 100;
                    }
                    $item->kolom12 = $item->kolom3 - $item->kolom8;

                    $item->kolom13 = fisikRencanaSKPD($bulan, $item, $result);
                    $item->kolom14 = ($item->kolom13 * $item->kolom4) / 100;
                    $item->kolom15 = fisikRealisasiSKPD($bulan, $item, $result);
                    $item->kolom16 = ($item->kolom15 * $item->kolom4) / 100;

                    //if ($item->kolom15 == 0 && $item->kolom13 == 0) {
                    if ($item->kolom13 == 0) {
                        $item->kolom17 = 0;
                    } else {
                        $item->kolom17 = ($item->kolom15 / $item->kolom13) * 100;
                    }
                }
            }
            return $item;
        });


        return view('admin.laporan.laporanrfk', compact('bidang', 'program', 'subkegiatan', 'data', 'datasubkegiatan', 'totalsubkegiatan', 'kegiatan', 'bulan', 'tahun'));
    }

    public function rencana($tahun)
    {

        $statusRFK = JenisRfk::where('skpd_id',  Auth::user()->skpd->id)->where('tahun', $tahun)->first();

        $bidang = Bidang::count();
        $program = Program::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->count();
        $kegiatan = Kegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->count();
        $subkegiatan = Subkegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->count();

        $data = Program::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->get();

        $subkeg = Subkegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->get();

        $totalsubkegiatan = $subkeg->map(function ($item) {
            $item->kolom3 = $item->uraian->where('status', null)->sum('dpa');
            return $item;
        })->sum('kolom3');

        $datasubkegiatan = $subkeg->map(function ($item) {
            if ($item->kirim_angkas == null) {
                $item->kolom3 = 0;
            } else {
                $item->kolom3 = $item->uraian->where('status', null)->sum('dpa');
            }
            return $item;
        });

        return view('admin.laporan.rencana', compact('bidang', 'program', 'subkegiatan', 'data', 'totalsubkegiatan', 'datasubkegiatan'));
    }


    public function excel($tahun, $bulan)
    {
        $statusRFK = JenisRfk::where('skpd_id',  Auth::user()->skpd->id)->where('tahun', $tahun)->first();

        if ($statusRFK[$bulan] == 'murni') {
            $result = null;
        } elseif ($statusRFK[$bulan] == 'perubahan') {
            $result = 99;
        }

        $bidang = Bidang::count();
        $program = Program::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->count();
        $kegiatan = Kegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->count();
        $subkegiatan = Subkegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->count();

        $data = Program::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->get();

        $subkeg = Subkegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->get();

        $totalsubkegiatan = $subkeg->map(function ($item) use ($result) {
            $item->kolom3 = $item->uraian->where('status', $result)->sum('dpa');
            return $item;
        })->sum('kolom3');

        $datasubkegiatan = $subkeg->map(function ($item) use ($result, $totalsubkegiatan, $bulan) {
            $status_kirim = 'kirim_rfk_' . $bulan;
            $item->status_kirim = $item[$status_kirim];
            if ($item->status_kirim == null) {
                $item->kolom3 = 0;
                $item->kolom4 = 0;
                $item->kolom5 = 0;
                $item->kolom6 = 0;
                $item->kolom7 = 0;
                $item->kolom8 = 0;
                $item->kolom9 = 0;
                $item->kolom10 = 0;
                $item->kolom11 = 0;
                $item->kolom12 = 0;
                $item->kolom13 = 0;
                $item->kolom14 = 0;
                $item->kolom15 = 0;
                $item->kolom16 = 0;
                $item->kolom17 = 0;
            } else {
                if ($totalsubkegiatan == 0) {
                    $item->kolom3 = 0;
                    $item->kolom4 = 0;
                    $item->kolom5 = 0;
                    $item->kolom6 = 0;
                    $item->kolom7 = 0;
                    $item->kolom8 = 0;
                    $item->kolom9 = 0;
                    $item->kolom10 = 0;
                    $item->kolom11 = 0;
                    $item->kolom12 = 0;
                    $item->kolom13 = 0;
                    $item->kolom14 = 0;
                    $item->kolom15 = 0;
                    $item->kolom16 = 0;
                    $item->kolom17 = 0;
                } else {
                    $item->kolom3 = $item->uraian->where('status', $result)->sum('dpa');
                    $item->kolom4 = ($item->kolom3 / $totalsubkegiatan) * 100;

                    $item->kolom5 = rencanaSKPD($bulan, $item, $result);

                    $item->kolom6 = ($item->kolom5 / $item->kolom3) * 100;
                    $item->kolom7 = ($item->kolom6 * $item->kolom4) / 100;

                    $item->kolom8 = realisasiSKPD($bulan, $item, $result);

                    $item->kolom9 = ($item->kolom8 / $item->kolom3) * 100;
                    $item->kolom10 = ($item->kolom9 * $item->kolom4) / 100;
                    if ($item->kolom8 == 0 && $item->kolom5 == 0) {
                        $item->kolom11 = 0;
                    } else {
                        $item->kolom11 = ($item->kolom8 / $item->kolom5) * 100;
                    }
                    $item->kolom12 = $item->kolom3 - $item->kolom8;

                    $item->kolom13 = fisikRencanaSKPD($bulan, $item, $result);
                    $item->kolom14 = ($item->kolom13 * $item->kolom4) / 100;
                    $item->kolom15 = fisikRealisasiSKPD($bulan, $item, $result);
                    $item->kolom16 = ($item->kolom15 * $item->kolom4) / 100;

                    //if ($item->kolom15 == 0 && $item->kolom13 == 0) {
                    if ($item->kolom13 == 0) {
                        $item->kolom17 = 0;
                    } else {
                        $item->kolom17 = ($item->kolom15 / $item->kolom13) * 100;
                    }
                }
            }
            return $item;
        });

        //dd($datasubkegiatan->take(2));
        $filename = 'RFK_DINAS.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=$filename");
        header('Cache-Control: max-age=0');

        $path = public_path('/excel/rfk_skpd.xlsx');
        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load($path);

        //looping program dlu
        $row = 10;
        $no = 1;
        foreach ($data as $key => $item) {
            $spreadsheet->getSheetByName('RFK')->setCellValue('B' . $row, $item->nama);
            $spreadsheet->getSheetByName('RFK')->getStyle('B' . $row)
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('abc5f2');

            $row++;
            foreach ($item->kegiatan as $item2) {
                $spreadsheet->getSheetByName('RFK')->setCellValue('B' . $row, $item2->nama);
                $spreadsheet->getSheetByName('RFK')->getStyle('B' . $row)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('d9ead3');
                $row++;
                foreach ($datasubkegiatan->where('kegiatan_id', $item2->id) as $item3) {
                    $spreadsheet->getSheetByName('RFK')->setCellValue('A' . $row, $no++);
                    $spreadsheet->getSheetByName('RFK')->setCellValue('B' . $row, $item3->nama);
                    $spreadsheet->getSheetByName('RFK')->setCellValue('D' . $row, $item3->kolom3);
                    $row++;
                }
            }
        }
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}
