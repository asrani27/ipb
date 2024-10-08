<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\T_m;
use App\Models\Skpd;
use App\Models\Uraian;
use App\Models\LaporanRFK;
use App\Models\Subkegiatan;
use App\Models\Permasalahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class SuperadminController extends Controller
{

    public function hapusLaporan($id)
    {
        LaporanRFK::find($id)->delete();
        Session::flash('success', 'Di Hapus');
        return back();
    }
    public function laporan()
    {
        $tahun = '2024';
        $skpd = Skpd::where('is_aktif', 1)->get()->map(function ($item) use ($tahun) {
            $item->januari = LaporanRFK::where('tahun', $tahun)->where('bulan', '01')->where('skpd_id', $item->id)->first();
            $item->februari = LaporanRFK::where('tahun', $tahun)->where('bulan', '02')->where('skpd_id', $item->id)->first();
            $item->maret = LaporanRFK::where('tahun', $tahun)->where('bulan', '03')->where('skpd_id', $item->id)->first();
            $item->april = LaporanRFK::where('tahun', $tahun)->where('bulan', '04')->where('skpd_id', $item->id)->first();
            $item->mei = LaporanRFK::where('tahun', $tahun)->where('bulan', '05')->where('skpd_id', $item->id)->first();
            $item->juni = LaporanRFK::where('tahun', $tahun)->where('bulan', '06')->where('skpd_id', $item->id)->first();
            $item->juli = LaporanRFK::where('tahun', $tahun)->where('bulan', '07')->where('skpd_id', $item->id)->first();
            $item->agustus = LaporanRFK::where('tahun', $tahun)->where('bulan', '08')->where('skpd_id', $item->id)->first();
            $item->september = LaporanRFK::where('tahun', $tahun)->where('bulan', '09')->where('skpd_id', $item->id)->first();
            $item->oktober = LaporanRFK::where('tahun', $tahun)->where('bulan', '10')->where('skpd_id', $item->id)->first();
            $item->november = LaporanRFK::where('tahun', $tahun)->where('bulan', '11')->where('skpd_id', $item->id)->first();
            $item->desember = LaporanRFK::where('tahun', $tahun)->where('bulan', '12')->where('skpd_id', $item->id)->first();
            return $item;
        });

        return view('superadmin.laporan.index', compact('skpd', 'tahun'));
    }
    public function laporanskpd($tahun, $bulan)
    {
        $skpd = Skpd::where('is_aktif', 1)->get()->map(function ($item) use ($tahun, $bulan) {
            $check = LaporanRFK::where('tahun', $tahun)->where('bulan', $bulan)->where('skpd_id', $item->id)->first();
            if ($check == null) {
                $item->laporan = null;
            } else {
                $item->laporan = $check;
            }
            return $item;
        });
        return view('superadmin.laporan.skpd', compact('skpd'));
    }

    public function export()
    {
        $bulan = request()->get('bulan');
        $tahun = request()->get('tahun');
        $jenis = request()->get('jenis');
        $button = request()->get('button');
        if ($button == 'masalah') {
            $masalah = Permasalahan::where('bulan', $bulan)->where('tahun', $tahun)->where('deskripsi', '!=', null)->get();
            $permasalahan = $masalah->where('permasalahan', '!=', '-');
            $disdik = $permasalahan->where('skpd_id', 1);
            $dinkes = $permasalahan->where('skpd_id', 34);
            $dpupr  = $permasalahan->where('skpd_id', 3);
            $dprkp = $permasalahan->where('skpd_id', 4);
            $satpolpp = $permasalahan->where('skpd_id', 5);
            $kesbangpol = $permasalahan->where('skpd_id', 6);
            $dinsos = $permasalahan->where('skpd_id', 7);
            $dp3a = $permasalahan->where('skpd_id', 8);
            $dkp3 = $permasalahan->where('skpd_id', 9);
            $dlh = $permasalahan->where('skpd_id', 10);
            $capil = $permasalahan->where('skpd_id', 11);
            $dppkbpm = $permasalahan->where('skpd_id', 12);
            $dishub = $permasalahan->where('skpd_id', 13);
            $diskominfotik = $permasalahan->where('skpd_id', 14);
            $diskopumker = $permasalahan->where('skpd_id', 15);
            $dpmptsp = $permasalahan->where('skpd_id', 16);
            $disbudporapar = $permasalahan->where('skpd_id', 37);
            $dpa = $permasalahan->where('skpd_id', 19);
            $perdagin = $permasalahan->where('skpd_id', 20);
            $setwan = $permasalahan->where('skpd_id', 22);
            $bpkpad = $permasalahan->where('skpd_id', 23);
            $inspektorat = $permasalahan->where('skpd_id', 24);
            $bkddiklat = $permasalahan->where('skpd_id', 25);
            $bpbd = $permasalahan->where('skpd_id', 26);
            $damkar = $permasalahan->where('skpd_id', 36);
            $timur = $permasalahan->where('skpd_id', 27);
            $utara = $permasalahan->where('skpd_id', 28);
            $tengah = $permasalahan->where('skpd_id', 29);
            $barat = $permasalahan->where('skpd_id', 30);
            $selatan = $permasalahan->where('skpd_id', 31);

            $bagkesra = $permasalahan->where('skpd_id', 39);
            $bagpbg   = $permasalahan->where('skpd_id', 40);
            $bagpbj   = $permasalahan->where('skpd_id', 41);
            $bagumum  = $permasalahan->where('skpd_id', 42);
            $bageko   = $permasalahan->where('skpd_id', 43);
            $bagpem   = $permasalahan->where('skpd_id', 44);
            $bagkum   = $permasalahan->where('skpd_id', 45);
            $bagorg   = $permasalahan->where('skpd_id', 46);
            $bagprokopim   = $permasalahan->where('skpd_id', 47);

            $bappeda   = $permasalahan->where('skpd_id', 32);
            $rs   = $permasalahan->where('skpd_id', 38);

            $skpd = [
                $disdik,
                $dinkes,
                $dpupr,
                $dprkp,
                $satpolpp,
                $kesbangpol,
                $dinsos,
                $dp3a,
                $dkp3,
                $dlh,
                $capil,
                $dppkbpm,
                $dishub,
                $diskominfotik,
                $diskopumker,
                $dpmptsp,
                $disbudporapar,
                $dpa,
                $perdagin,
                $setwan,
                $bpkpad,
                $inspektorat,
                $bkddiklat,
                $bpbd,
                $damkar,
                $timur,
                $utara,
                $barat,
                $tengah,
                $selatan,
                $bagpem,
                $bagkum,
                $bagorg,
                $bagkesra,
                $bageko,
                $bagumum,
                $bagpbj,
                $bagpbg,
                $bagprokopim,
                $bappeda,
                $rs
            ];

            $filename = 'Laporan_permasalahan_' . namaBulan($bulan) . '.xlsx';

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Disposition: attachment;filename=$filename");
            header('Cache-Control: max-age=0');

            $path = public_path('/excel/permasalahan.xlsx');

            $reader = IOFactory::createReader('Xlsx');
            $spreadsheet = $reader->load($path);

            // DISDIK
            $tanggal = Carbon::now()->format('d-m-Y H:i:s');

            foreach ($skpd as $key => $datamasalah) {
                if ($datamasalah->count() != 0) {
                    $sheetName = sheetName($datamasalah->first()->skpd_id);
                    $skpd = Skpd::find($datamasalah->first()->skpd_id);
                    // $spreadsheet->getSheetByName($sheetName)->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
                    $spreadsheet->getSheetByName($sheetName)->setCellValue('A2', strtoupper($skpd->nama));
                    $spreadsheet->getSheetByName($sheetName)->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
                    $spreadsheet->getSheetByName($sheetName)->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
                    $spreadsheet->getSheetByName($sheetName)->insertNewRowBefore(10, $datamasalah->count() - 1);
                    $disdikRow = 9;

                    $nomor_masalah = 0;
                    foreach ($datamasalah as $key2 => $item_masalah) {
                        //dd($item_masalah);
                        $spreadsheet->getSheetByName($sheetName)->setCellValue('A' . $disdikRow, $nomor_masalah + 1)->getColumnDimension('A')->setAutoSize(true);
                        $spreadsheet->getSheetByName($sheetName)->getStyle('A' . $disdikRow)->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_TOP);
                        $spreadsheet->getSheetByName($sheetName)->setCellValue('C' . $disdikRow, $item_masalah->kegiatan->nama);
                        $spreadsheet->getSheetByName($sheetName)->getStyle('C' . $disdikRow)->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_TOP);
                        $spreadsheet->getSheetByName($sheetName)->setCellValue('D' . $disdikRow, $item_masalah->permasalahan);
                        $spreadsheet->getSheetByName($sheetName)->getStyle('D' . $disdikRow)->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_TOP);
                        $spreadsheet->getSheetByName($sheetName)->setCellValue('E' . $disdikRow, $item_masalah->upaya);
                        $spreadsheet->getSheetByName($sheetName)->getStyle('E' . $disdikRow)->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_TOP);
                        $spreadsheet->getSheetByName($sheetName)->setCellValue('F' . $disdikRow, $item_masalah->pihak_pembantu);
                        $spreadsheet->getSheetByName($sheetName)->getStyle('F' . $disdikRow)->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_TOP);
                        $disdikRow++;
                        $nomor_masalah++;
                    }
                }
            }

            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
            //dd($skpd);
        } else {

            $check = LaporanRFK::where('bulan', $bulan)->where('tahun', $tahun)->get();

            if ($check->count() > 0) {
                $check->map(function ($item) {
                    $item->data = collect(json_decode($item->data));
                    return $item;
                });

                $disdik = $check->where('skpd_id', 1)->first() == null ? null : $check->where('skpd_id', 1)->first()->data;
                $dinkes = $check->where('skpd_id', 34)->first() == null ? null : $check->where('skpd_id', 34)->first()->data;
                $dpupr  = $check->where('skpd_id', 3)->first() == null ? null : $check->where('skpd_id', 3)->first()->data;
                $dprkp = $check->where('skpd_id', 4)->first() == null ? null : $check->where('skpd_id', 4)->first()->data;
                $satpolpp = $check->where('skpd_id', 5)->first() == null ? null : $check->where('skpd_id', 5)->first()->data;
                $kesbangpol = $check->where('skpd_id', 6)->first() == null ? null : $check->where('skpd_id', 6)->first()->data;
                $dinsos = $check->where('skpd_id', 7)->first() == null ? null : $check->where('skpd_id', 7)->first()->data;
                $dp3a = $check->where('skpd_id', 8)->first() == null ? null : $check->where('skpd_id', 8)->first()->data;
                $dkp3 = $check->where('skpd_id', 9)->first() == null ? null : $check->where('skpd_id', 9)->first()->data;
                $dlh = $check->where('skpd_id', 10)->first() == null ? null : $check->where('skpd_id', 10)->first()->data;
                $capil = $check->where('skpd_id', 11)->first() == null ? null : $check->where('skpd_id', 11)->first()->data;
                $dppkbpm = $check->where('skpd_id', 12)->first() == null ? null : $check->where('skpd_id', 12)->first()->data;
                $dishub = $check->where('skpd_id', 13)->first() == null ? null : $check->where('skpd_id', 13)->first()->data;
                $diskominfotik = $check->where('skpd_id', 14)->first() == null ? null : $check->where('skpd_id', 14)->first()->data;
                $diskopumker = $check->where('skpd_id', 15)->first() == null ? null : $check->where('skpd_id', 15)->first()->data;
                $dpmptsp = $check->where('skpd_id', 16)->first() == null ? null : $check->where('skpd_id', 16)->first()->data;
                $disbudporapar = $check->where('skpd_id', 37)->first() == null ? null : $check->where('skpd_id', 37)->first()->data;
                $dpa = $check->where('skpd_id', 19)->first() == null ? null : $check->where('skpd_id', 19)->first()->data;
                $perdagin = $check->where('skpd_id', 20)->first() == null ? null : $check->where('skpd_id', 20)->first()->data;
                $setwan = $check->where('skpd_id', 22)->first() == null ? null : $check->where('skpd_id', 22)->first()->data;
                $bpkpad = $check->where('skpd_id', 23)->first() == null ? null : $check->where('skpd_id', 23)->first()->data;
                $inspektorat = $check->where('skpd_id', 24)->first() == null ? null : $check->where('skpd_id', 24)->first()->data;
                $bkddiklat = $check->where('skpd_id', 25)->first() == null ? null : $check->where('skpd_id', 25)->first()->data;
                $bpbd = $check->where('skpd_id', 26)->first() == null ? null : $check->where('skpd_id', 26)->first()->data;
                $damkar = $check->where('skpd_id', 36)->first() == null ? null : $check->where('skpd_id', 36)->first()->data;
                $timur = $check->where('skpd_id', 27)->first() == null ? null : $check->where('skpd_id', 27)->first()->data;
                $utara = $check->where('skpd_id', 28)->first() == null ? null : $check->where('skpd_id', 28)->first()->data;
                $tengah = $check->where('skpd_id', 29)->first() == null ? null : $check->where('skpd_id', 29)->first()->data;
                $barat = $check->where('skpd_id', 30)->first() == null ? null : $check->where('skpd_id', 30)->first()->data;
                $selatan = $check->where('skpd_id', 31)->first() == null ? null : $check->where('skpd_id', 31)->first()->data;

                $bagkesra = $check->where('skpd_id', 39)->first() == null ? null : $check->where('skpd_id', 39)->first()->data;
                $bagpbg   = $check->where('skpd_id', 40)->first() == null ? null : $check->where('skpd_id', 40)->first()->data;
                $bagpbj   = $check->where('skpd_id', 41)->first() == null ? null : $check->where('skpd_id', 41)->first()->data;
                $bagumum  = $check->where('skpd_id', 42)->first() == null ? null : $check->where('skpd_id', 42)->first()->data;
                $bageko   = $check->where('skpd_id', 43)->first() == null ? null : $check->where('skpd_id', 43)->first()->data;
                $bagpem   = $check->where('skpd_id', 44)->first() == null ? null : $check->where('skpd_id', 44)->first()->data;
                $bagkum   = $check->where('skpd_id', 45)->first() == null ? null : $check->where('skpd_id', 45)->first()->data;
                $bagorg   = $check->where('skpd_id', 46)->first() == null ? null : $check->where('skpd_id', 46)->first()->data;
                $bagprokopim   = $check->where('skpd_id', 47)->first() == null ? null : $check->where('skpd_id', 47)->first()->data;

                $bappeda   = $check->where('skpd_id', 32)->first() == null ? null : $check->where('skpd_id', 32)->first()->data;
                $rs   = $check->where('skpd_id', 38)->first() == null ? null : $check->where('skpd_id', 38)->first()->data;
            } else {
                $disdik = null;
                $dinkes = null;
                $dpupr  = null;
                $dprkp = null;
                $satpolpp = null;
                $kesbangpol = null;
                $dinsos = null;
                $dp3a = null;
                $dkp3 = null;
                $dlh = null;
                $capil = null;
                $dppkbpm = null;
                $dishub = null;
                $diskominfotik = null;
                $diskopumker = null;
                $dpmptsp = null;
                $disbudporapar = null;
                $dpa = null;
                $perdagin = null;
                $setwan = null;
                $bpkpad = null;
                $inspektorat = null;
                $bkddiklat = null;
                $bpbd = null;
                $damkar = null;
                $timur = null;
                $utara = null;
                $tengah = null;
                $barat = null;
                $selatan = null;

                $bagpem   = null;
                $bagkum   = null;
                $bagorg   = null;
                $bagkesra = null;
                $bageko   = null;
                $bagumum  = null;
                $bagpbj   = null;
                $bagpbg   = null;
                $bagprokopim   = null;
                $bappeda   = null;
                $rs   = null;
            }

            $skpd = [
                $disdik,
                $dinkes,
                $dpupr,
                $dprkp,
                $satpolpp,
                $kesbangpol,
                $dinsos,
                $dp3a,
                $dkp3,
                $dlh,
                $capil,
                $dppkbpm,
                $dishub,
                $diskominfotik,
                $diskopumker,
                $dpmptsp,
                $disbudporapar,
                $dpa,
                $perdagin,
                $setwan,
                $bpkpad,
                $inspektorat,
                $bkddiklat,
                $bpbd,
                $damkar,
                $timur,
                $utara,
                $barat,
                $tengah,
                $selatan,
                $bagpem,
                $bagkum,
                $bagorg,
                $bagkesra,
                $bageko,
                $bagumum,
                $bagpbj,
                $bagpbg,
                $bagprokopim,
                $bappeda,
                $rs
            ];

            $filename = 'Laporan_rfk_' . namaBulan($bulan) . '.xlsx';

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Disposition: attachment;filename=$filename");
            header('Cache-Control: max-age=0');

            $path = public_path('/excel/laporan_rf.xlsx');

            $reader = IOFactory::createReader('Xlsx');
            $spreadsheet = $reader->load($path);

            // DISDIK
            $tanggal = Carbon::now()->format('d-m-Y H:i:s');
            //rekap

            // $permasalahan_disdik    = T_m::whereIn('subkegiatan_id', $disdik->pluck('id')->toArray())->get();
            // $permasalahan_dinkes    = T_m::whereIn('subkegiatan_id', $dinkes->pluck('id')->toArray())->get();
            // $permasalahan_dpupr     = T_m::whereIn('subkegiatan_id', $dpupr->pluck('id')->toArray())->get();
            // $permasalahan_dprkp     = T_m::whereIn('subkegiatan_id', $dprkp->pluck('id')->toArray())->get();
            // $permasalahan_satpolpp  = T_m::whereIn('subkegiatan_id', $satpolpp->pluck('id')->toArray())->get();
            // $permasalahan_kesbangpol = T_m::whereIn('subkegiatan_id', $kesbangpol->pluck('id')->toArray())->get();
            // $permasalahan_dinsos    = T_m::whereIn('subkegiatan_id', $dinsos->pluck('id')->toArray())->get();
            // $permasalahan_dp3a      = T_m::whereIn('subkegiatan_id', $dp3a->pluck('id')->toArray())->get();
            // $permasalahan_dkp3      = T_m::whereIn('subkegiatan_id', $dkp3->pluck('id')->toArray())->get();
            // $permasalahan_dlh       = T_m::whereIn('subkegiatan_id', $dlh->pluck('id')->toArray())->get();
            // $permasalahan_capil     = T_m::whereIn('subkegiatan_id', $capil->pluck('id')->toArray())->get();
            // $permasalahan_dppkbpm   = T_m::whereIn('subkegiatan_id', $dppkbpm->pluck('id')->toArray())->get();
            // $permasalahan_dishub    = T_m::whereIn('subkegiatan_id', $dishub->pluck('id')->toArray())->get();
            // $permasalahan_diskominfotik = T_m::whereIn('subkegiatan_id', $diskominfotik->pluck('id')->toArray())->get();
            // $permasalahan_diskopumker   = T_m::whereIn('subkegiatan_id', $diskopumker->pluck('id')->toArray())->get();
            // $permasalahan_dpmptsp       = T_m::whereIn('subkegiatan_id', $dpmptsp->pluck('id')->toArray())->get();
            // $permasalahan_disbudporapar = T_m::whereIn('subkegiatan_id', $disbudporapar->pluck('id')->toArray())->get();


            $mulai = 9;

            // foreach ($permasalahan_disdik as $key => $p) {
            //     // $spreadsheet->getSheetByName('Permasalahan')->setCellValue('A' . $key + $mulai, $key + 1);
            //     $spreadsheet->getSheetByName('Permasalahan')->setCellValue('B' . $key + $mulai, 'Dinas Pendidikan');
            //     $spreadsheet->getSheetByName('Permasalahan')->setCellValue('C' . $key + $mulai, $p->deskripsi);
            //     $spreadsheet->getSheetByName('Permasalahan')->setCellValue('D' . $key + $mulai, $p->permasalahan);
            //     $spreadsheet->getSheetByName('Permasalahan')->setCellValue('E' . $key + $mulai, $p->upaya);
            //     $spreadsheet->getSheetByName('Permasalahan')->setCellValue('F' . $key + $mulai, $p->pihak_pembantu);
            // }
            // $mulai = $mulai + $permasalahan_disdik->count() + 1;

            // foreach ($permasalahan_dinkes as $key => $p) {
            //     // $spreadsheet->getSheetByName('Permasalahan')->setCellValue('A' . $key + $mulai, $key + 1);
            //     $spreadsheet->getSheetByName('Permasalahan')->setCellValue('B' . $key + $mulai, 'Dinas Kesehatan');
            //     $spreadsheet->getSheetByName('Permasalahan')->setCellValue('C' . $key + $mulai, $p->deskripsi);
            //     $spreadsheet->getSheetByName('Permasalahan')->setCellValue('D' . $key + $mulai, $p->permasalahan);
            //     $spreadsheet->getSheetByName('Permasalahan')->setCellValue('E' . $key + $mulai, $p->upaya);
            //     $spreadsheet->getSheetByName('Permasalahan')->setCellValue('F' . $key + $mulai, $p->pihak_pembantu);
            // }

            // $mulai = $mulai + $permasalahan_dinkes->count() + 1;

            // foreach ($permasalahan_dpupr as $key => $p) {
            //     // $spreadsheet->getSheetByName('Permasalahan')->setCellValue('A' . $key + $mulai, $key + 1);
            //     $spreadsheet->getSheetByName('Permasalahan')->setCellValue('B' . $key + $mulai, 'Dinas Pekerjaan Umum dan Penataan Ruang');
            //     $spreadsheet->getSheetByName('Permasalahan')->setCellValue('C' . $key + $mulai, $p->deskripsi);
            //     $spreadsheet->getSheetByName('Permasalahan')->setCellValue('D' . $key + $mulai, $p->permasalahan);
            //     $spreadsheet->getSheetByName('Permasalahan')->setCellValue('E' . $key + $mulai, $p->upaya);
            //     $spreadsheet->getSheetByName('Permasalahan')->setCellValue('F' . $key + $mulai, $p->pihak_pembantu);
            // }

            // $mulai = $mulai + $permasalahan_dpupr->count() + 1;


            // $spreadsheet->getSheetByName('Permasalahan')->insertNewRowBefore(10, $permasalahan->count());
            // foreach ($permasalahan as $key => $p) {
            //     $spreadsheet->getSheetByName('Permasalahan')->setCellValue('A' . $key + $mulai, ($key + 1));
            //     $spreadsheet->getSheetByName('Permasalahan')->setCellValue('B' . $key + $mulai, 'Unit Kerja')->getStyle('B' . $key + $mulai)->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_TOP);
            //     $spreadsheet->getSheetByName('Permasalahan')->setCellValue('C' . $key + $mulai, $p->deskripsi)->getStyle('C' . $key + $mulai)->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_TOP);
            //     $spreadsheet->getSheetByName('Permasalahan')->setCellValue('D' . $key + $mulai, $p->permasalahan)->getStyle('D' . $key + $mulai)->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_TOP);
            //     $spreadsheet->getSheetByName('Permasalahan')->setCellValue('E' . $key + $mulai, $p->upaya)->getStyle('E' . $key + $mulai)->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_TOP);
            //     $spreadsheet->getSheetByName('Permasalahan')->setCellValue('F' . $key + $mulai, $p->pihak_pembantu)->getStyle('F' . $key + $mulai)->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_TOP);
            // }
            foreach ($skpd as $key => $dataexcel) {

                if ($dataexcel != null) {
                    if ($dataexcel->count() != 0) {
                        $sheetName = sheetName($dataexcel->first()->skpd_id);
                        $skpd = Skpd::find($dataexcel->first()->skpd_id);
                        $spreadsheet->getSheetByName($sheetName)->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
                        $spreadsheet->getSheetByName($sheetName)->setCellValue('A2', strtoupper($skpd->nama));
                        $spreadsheet->getSheetByName($sheetName)->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
                        $spreadsheet->getSheetByName($sheetName)->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
                        $spreadsheet->getSheetByName($sheetName)->insertNewRowBefore(12, $dataexcel->count() - 1);
                        $disdikRow = 11;

                        if ($dataexcel->count() != 0) {
                            foreach ($dataexcel as $key2 => $item_disdik) {
                                $spreadsheet->getSheetByName($sheetName)->setCellValue('A' . $disdikRow, $key2 + 1);
                                $spreadsheet->getSheetByName($sheetName)->setCellValue('B' . $disdikRow, $item_disdik->nama)->getColumnDimension('B')->setWidth('50');
                                $spreadsheet->getSheetByName($sheetName)->getStyle('B' . $disdikRow)->getAlignment()->setWrapText(true);
                                $spreadsheet->getSheetByName($sheetName)->setCellValue('C' . $disdikRow, $item_disdik->dpa)->getColumnDimension('C')->setAutoSize(true);
                                $spreadsheet->getSheetByName($sheetName)->setCellValue('D' . $disdikRow, '=C' . $disdikRow . '/$C$' . $dataexcel->count() + 11 . '*100')->getColumnDimension('D')->setAutoSize(true);
                                $spreadsheet->getSheetByName($sheetName)->setCellValue('E' . $disdikRow, $item_disdik->rencana)->getColumnDimension('E')->setAutoSize(true);
                                $spreadsheet->getSheetByName($sheetName)->setCellValue('F' . $disdikRow, '=E' . $disdikRow . '/C' . $disdikRow . '*100')->getColumnDimension('F')->setAutoSize(true);
                                $spreadsheet->getSheetByName($sheetName)->setCellValue('G' . $disdikRow, '=F' . $disdikRow . '*D' . $disdikRow . '/100')->getColumnDimension('G')->setAutoSize(true);
                                $spreadsheet->getSheetByName($sheetName)->setCellValue('H' . $disdikRow, $item_disdik->realisasi)->getColumnDimension('H')->setAutoSize(true);
                                $spreadsheet->getSheetByName($sheetName)->setCellValue('I' . $disdikRow, '=H' . $disdikRow . '/C' . $disdikRow . '*100')->getColumnDimension('I')->setAutoSize(true);
                                $spreadsheet->getSheetByName($sheetName)->setCellValue('J' . $disdikRow, '=I' . $disdikRow . '*D' . $disdikRow . '/100')->getColumnDimension('J')->setAutoSize(true);
                                $spreadsheet->getSheetByName($sheetName)->setCellValue('K' . $disdikRow, '=IF(E' . $disdikRow . '=0,0,H' . $disdikRow . '/E' . $disdikRow . '*100)')->getColumnDimension('K')->setAutoSize(true);
                                $spreadsheet->getSheetByName($sheetName)->setCellValue('L' . $disdikRow, '=J' . $disdikRow . '-G' . $disdikRow)->getColumnDimension('L')->setAutoSize(true);
                                $spreadsheet->getSheetByName($sheetName)->setCellValue('M' . $disdikRow, '=C' . $disdikRow . '-H' . $disdikRow)->getColumnDimension('M')->setAutoSize(true);
                                $spreadsheet->getSheetByName($sheetName)->setCellValue('N' . $disdikRow, $item_disdik->rencana_fisik)->getColumnDimension('N')->setAutoSize(true);
                                $spreadsheet->getSheetByName($sheetName)->setCellValue('O' . $disdikRow, '=N' . $disdikRow . '*D' . $disdikRow . '/100')->getColumnDimension('O')->setAutoSize(true);
                                $spreadsheet->getSheetByName($sheetName)->setCellValue('P' . $disdikRow, $item_disdik->realisasi_fisik)->getColumnDimension('P')->setAutoSize(true);
                                $spreadsheet->getSheetByName($sheetName)->setCellValue('Q' . $disdikRow, '=P' . $disdikRow . '*D' . $disdikRow . '/100')->getColumnDimension('Q')->setAutoSize(true);
                                $spreadsheet->getSheetByName($sheetName)->setCellValue('R' . $disdikRow, '=IF(N' . $disdikRow . '=0,0,P' . $disdikRow . '/N' . $disdikRow . '*100)')->getColumnDimension('R')->setAutoSize(true);
                                $disdikRow++;
                            }
                            $spreadsheet->getSheetByName($sheetName)->setCellValue('B' . $dataexcel->count() + 11, 'TOTALNYA');
                            $spreadsheet->getSheetByName($sheetName)->setCellValue('C' . $dataexcel->count() + 11, '=SUM(C11:C' . $dataexcel->count() + 10 . ')');
                            $spreadsheet->getSheetByName($sheetName)->setCellValue('D' . $dataexcel->count() + 11, '=SUM(D11:D' . $dataexcel->count() + 10 . ')');
                            $spreadsheet->getSheetByName($sheetName)->setCellValue('E' . $dataexcel->count() + 11, '=SUM(E11:E' . $dataexcel->count() + 10 . ')');
                            $spreadsheet->getSheetByName($sheetName)->setCellValue('F' . $dataexcel->count() + 11, '=SUM(G11:G' . $dataexcel->count() + 10 . ')');
                            $spreadsheet->getSheetByName($sheetName)->setCellValue('G' . $dataexcel->count() + 11, '=SUM(G11:G' . $dataexcel->count() + 10 . ')');
                            $spreadsheet->getSheetByName($sheetName)->setCellValue('H' . $dataexcel->count() + 11, '=SUM(H11:H' . $dataexcel->count() + 10 . ')');
                            $spreadsheet->getSheetByName($sheetName)->setCellValue('I' . $dataexcel->count() + 11, '=SUM(J11:J' . $dataexcel->count() + 10 . ')');
                            $spreadsheet->getSheetByName($sheetName)->setCellValue('J' . $dataexcel->count() + 11, '=SUM(J11:J' . $dataexcel->count() + 10 . ')');
                            $spreadsheet->getSheetByName($sheetName)->setCellValue('K' . $dataexcel->count() + 11, '=IF(E' . $dataexcel->count() + 11 . '=0,0,H' . $dataexcel->count() + 11 . '/E' . $dataexcel->count() + 11 . '*100)');
                            $spreadsheet->getSheetByName($sheetName)->setCellValue('L' . $dataexcel->count() + 11, '=J' . $dataexcel->count() + 11 . '-G' .  $dataexcel->count() + 11);
                            $spreadsheet->getSheetByName($sheetName)->setCellValue('M' . $dataexcel->count() + 11, '=C' . $dataexcel->count() + 11 . '-H' .  $dataexcel->count() + 11);
                            $spreadsheet->getSheetByName($sheetName)->setCellValue('N' . $dataexcel->count() + 11, '=SUM(O11:O' . $dataexcel->count() + 10 . ')');
                            $spreadsheet->getSheetByName($sheetName)->setCellValue('O' . $dataexcel->count() + 11, '=SUM(O11:O' . $dataexcel->count() + 10 . ')');
                            $spreadsheet->getSheetByName($sheetName)->setCellValue('P' . $dataexcel->count() + 11, '=SUM(Q11:Q' . $dataexcel->count() + 10 . ')');
                            $spreadsheet->getSheetByName($sheetName)->setCellValue('Q' . $dataexcel->count() + 11, '=SUM(Q11:Q' . $dataexcel->count() + 10 . ')');
                            $spreadsheet->getSheetByName($sheetName)->setCellValue('R' . $dataexcel->count() + 11, '=IF(N' . $dataexcel->count() + 11 . '=0,0,P' . $dataexcel->count() + 11 . '/N' . $dataexcel->count() + 11 . '*100)');
                        }

                        $value_c = "='$sheetName'!C" . $disdikRow;
                        $value_e = "='$sheetName'!E" . $disdikRow;
                        $value_f = "='$sheetName'!F" . $disdikRow;
                        $value_h = "='$sheetName'!H" . $disdikRow;
                        $value_i = "='$sheetName'!I" . $disdikRow;
                        $value_k = "='$sheetName'!K" . $disdikRow;
                        $value_n = "='$sheetName'!N" . $disdikRow;
                        $value_p = "='$sheetName'!P" . $disdikRow;
                        $value_r = "='$sheetName'!R" . $disdikRow;

                        //dd($value_c);
                        $cell_c = "C" . cellName($skpd->id);
                        $cell_e = "E" . cellName($skpd->id);
                        $cell_f = "F" . cellName($skpd->id);
                        $cell_h = "H" . cellName($skpd->id);
                        $cell_i = "I" . cellName($skpd->id);
                        $cell_k = "K" . cellName($skpd->id);
                        $cell_n = "N" . cellName($skpd->id);
                        $cell_p = "P" . cellName($skpd->id);
                        $cell_r = "R" . cellName($skpd->id);

                        $spreadsheet->getSheetByName('Rekap')->setCellValue($cell_c, $value_c);
                        $spreadsheet->getSheetByName('Rekap')->setCellValue($cell_e, $value_e);
                        $spreadsheet->getSheetByName('Rekap')->setCellValue($cell_f, $value_f);
                        $spreadsheet->getSheetByName('Rekap')->setCellValue($cell_f, $value_f);
                        $spreadsheet->getSheetByName('Rekap')->setCellValue($cell_h, $value_h);
                        $spreadsheet->getSheetByName('Rekap')->setCellValue($cell_i, $value_i);
                        $spreadsheet->getSheetByName('Rekap')->setCellValue($cell_k, $value_k);
                        $spreadsheet->getSheetByName('Rekap')->setCellValue($cell_n, $value_n);
                        $spreadsheet->getSheetByName('Rekap')->setCellValue($cell_p, $value_p);
                        $spreadsheet->getSheetByName('Rekap')->setCellValue($cell_r, $value_r);
                    } else {

                        // $cell_c = "C" . cellName($skpd->id);
                        // $spreadsheet->getSheetByName('Rekap')->setCellValue($cell_c, 0);
                    }
                } else {
                    //dd($skpd);
                    // $cell = cellName($skpd->id);
                    // $spreadsheet->getSheetByName('Rekap')->setCellValue($cell, 0);
                }
            }

            // dd('d');
            $spreadsheet->getSheetByName('Rekap')->setCellValue('B5', 'Sumber Data : Kenangan, Tanggal : ' . $tanggal);
            $spreadsheet->setActiveSheetIndexByName('Rekap');

            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
        }
    }
}
