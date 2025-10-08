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
use Illuminate\Support\Facades\Log;
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
        $tahun = '2025';
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

                        $spreadsheet->getSheetByName($sheetName)->setCellValue('A' . $disdikRow, $nomor_masalah + 1)->getColumnDimension('A')->setAutoSize(true);
                        $spreadsheet->getSheetByName($sheetName)->getStyle('A' . $disdikRow)->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_TOP);
                        $spreadsheet->getSheetByName($sheetName)
                            ->getRowDimension($disdikRow)
                            ->setRowHeight(-1);
                        $spreadsheet->getSheetByName($sheetName)->setCellValue('B' . $disdikRow, $item_masalah->subkegiatan == null ? '' : $item_masalah->subkegiatan->pptk->nama_pptk);
                        $spreadsheet->getSheetByName($sheetName)->getStyle('B' . $disdikRow)->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_TOP);

                        $spreadsheet->getSheetByName($sheetName)->setCellValue('C' . $disdikRow, $item_masalah->subkegiatan == null ? '' : $item_masalah->subkegiatan->nama);
                        $spreadsheet->getSheetByName($sheetName)->getStyle('C' . $disdikRow)->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_TOP);

                        $spreadsheet->getSheetByName($sheetName)->setCellValue('D' . $disdikRow, $item_masalah->deskripsi);
                        $spreadsheet->getSheetByName($sheetName)->getStyle('D' . $disdikRow)->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_TOP);

                        $spreadsheet->getSheetByName($sheetName)->setCellValue('E' . $disdikRow, $item_masalah->permasalahan);
                        $spreadsheet->getSheetByName($sheetName)->getStyle('E' . $disdikRow)->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_TOP);

                        $spreadsheet->getSheetByName($sheetName)->setCellValue('F' . $disdikRow, $item_masalah->upaya);
                        $spreadsheet->getSheetByName($sheetName)->getStyle('F' . $disdikRow)->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_TOP);

                        $spreadsheet->getSheetByName($sheetName)->setCellValue('G' . $disdikRow, $item_masalah->pihak_pembantu);
                        $spreadsheet->getSheetByName($sheetName)->getStyle('G' . $disdikRow)->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_TOP);
                        $disdikRow++;
                        $nomor_masalah++;
                    }
                }
            }

            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
            //dd($skpd);
        }
        if ($button == 'excel') {

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

            $tanggal = Carbon::now()->format('d-m-Y H:i:s');
            $mulai = 9;
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
                                $spreadsheet->getSheetByName($sheetName)->setCellValue('F' . $disdikRow, '=IF(E' . $disdikRow . '=0,0,E' . $disdikRow . '/C' . $disdikRow . '*100)')->getColumnDimension('F')->setAutoSize(true);
                                $spreadsheet->getSheetByName($sheetName)->setCellValue('G' . $disdikRow, '=F' . $disdikRow . '*D' . $disdikRow . '/100')->getColumnDimension('G')->setAutoSize(true);
                                $spreadsheet->getSheetByName($sheetName)->setCellValue('H' . $disdikRow, $item_disdik->realisasi)->getColumnDimension('H')->setAutoSize(true);
                                $spreadsheet->getSheetByName($sheetName)->setCellValue('I' . $disdikRow, '=IF(H' . $disdikRow . '=0,0,H' . $disdikRow . '/C' . $disdikRow . '*100)')->getColumnDimension('I')->setAutoSize(true);
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

    public function belanjaSkpd()
    {
        return view('superadmin.belanja.index');
    }
    public function exportBelanjaSkpd()
    {
        // Increase memory limit temporarily
        ini_set('memory_limit', '512M');
        set_time_limit(300); // 5 minutes

        try {
            // Get all active SKPDs with chunking for memory efficiency
            $skpdList = Skpd::where('is_aktif', 1)->get();

            // Create new spreadsheet
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

            // Remove default sheet
            $spreadsheet->removeSheetByIndex(0);

            // Define kode rekening patterns
            $kodePatterns = [
                'pegawai' => '5.1.01.',
                'barang_jasa' => '5.1.02.',
                'modal' => '5.2.'
            ];

            foreach ($skpdList as $index => $skpd) {
                // Clear memory between iterations
                if ($index % 10 == 0) {
                    gc_collect_cycles();
                }
                // Get data for current SKPD only (chunked approach)
                $skpdData = Uraian::where('jenis_rfk', 'pergeseran')
                    ->where('tahun', '2025')
                    ->where('skpd_id', $skpd->id)
                    ->where('ke', $skpd->ke)
                    ->where(function ($query) use ($kodePatterns) {
                        foreach ($kodePatterns as $pattern) {
                            $query->orWhere('kode_rekening', 'like', $pattern . '%');
                        }
                    })
                    ->get();

                // Group by belanja type
                $groupedData = $skpdData->groupBy(function ($item) {
                    if (str_starts_with($item->kode_rekening, '5.1.01.')) {
                        return 'pegawai';
                    } elseif (str_starts_with($item->kode_rekening, '5.1.02.')) {
                        return 'barang_jasa';
                    } elseif (str_starts_with($item->kode_rekening, '5.2.')) {
                        return 'modal';
                    }
                    return 'other';
                });

                $belanjaPegawai = $groupedData->get('pegawai', collect());
                $belanjaBarangJasa = $groupedData->get('barang_jasa', collect());
                $belanjaModal = $groupedData->get('modal', collect());

                // Create sheet for each SKPD
                $sheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, $this->sanitizeSheetName($skpd->nama));
                $spreadsheet->addSheet($sheet, $index);

                // Set headers
                $sheet->setCellValue('A1', $skpd->nama);
                $sheet->mergeCells('A1:AB1');
                $sheet->setCellValue('A2', 'no');
                $sheet->setCellValue('B2', 'Keterangan Uraian');
                $sheet->setCellValue('C2', 'DPA');
                $sheet->setCellValue('D2', 'Rencana');
                $sheet->setCellValue('P2', 'Realisasi');
                $sheet->setCellValue('AB2', 'Total Realisasi');

                // Merge Rencana header across 12 columns (D to O)
                $sheet->mergeCells('D2:O2');

                // Merge Realisasi header across 12 columns (P to AA)
                $sheet->mergeCells('P2:AA2');

                // Add month headers for Rencana
                $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                $col = 'D';
                foreach ($months as $month) {
                    $sheet->setCellValue($col . '3', $month);
                    $col++;
                }

                // Add month headers for Realisasi
                $col = 'P';
                foreach ($months as $month) {
                    $sheet->setCellValue($col . '3', $month);
                    $col++;
                }

                // Style headers with larger font and gray background
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('A2:AB2')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('A2:AB3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('D2:O2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $sheet->getStyle('P2:AA2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

                // Apply gray background to headers
                $headerGray = 'D3D3D3';
                $sheet->getStyle('A2:AB3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle('A2:AB3')->getFill()->getStartColor()->setARGB($headerGray);

                // Add thin borders to headers
                $sheet->getStyle('A2:AB3')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $sheet->getStyle('A1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                // Function to add belanja section
                $addBelanjaSection = function ($data, $title, &$currentRow, $sheet, &$allSectionRanges = []) {
                    if ($data->count() > 0) {
                        // Add title in column B
                        $sheet->setCellValue('B' . $currentRow, $title);
                        $sheet->getStyle('B' . $currentRow)->getFont()->setBold(true);
                        $currentRow++;

                        // Define month fields for rencana
                        $rencanaFields = [
                            'p_januari_keuangan',
                            'p_februari_keuangan',
                            'p_maret_keuangan',
                            'p_april_keuangan',
                            'p_mei_keuangan',
                            'p_juni_keuangan',
                            'p_juli_keuangan',
                            'p_agustus_keuangan',
                            'p_september_keuangan',
                            'p_oktober_keuangan',
                            'p_november_keuangan',
                            'p_desember_keuangan'
                        ];

                        // Define month fields for realisasi
                        $realisasiFields = [
                            'r_januari_keuangan',
                            'r_februari_keuangan',
                            'r_maret_keuangan',
                            'r_april_keuangan',
                            'r_mei_keuangan',
                            'r_juni_keuangan',
                            'r_juli_keuangan',
                            'r_agustus_keuangan',
                            'r_september_keuangan',
                            'r_oktober_keuangan',
                            'r_november_keuangan',
                            'r_desember_keuangan'
                        ];

                        // Add data directly (no headers)
                        $startRow = $currentRow;
                        $endRow = $currentRow + $data->count() - 1;

                        foreach ($data as $item) {
                            $sheet->setCellValue('A' . $currentRow, $currentRow - $startRow + 1); // Nomor urut
                            $sheet->setCellValue('B' . $currentRow, $item->kode_rekening . ' - ' . ($item->nama ?? '')); // Keterangan Uraian
                            $sheet->setCellValue('C' . $currentRow, $item->dpa ?? 0); // DPA

                            // Add rencana monthly data
                            $col = 'D';
                            foreach ($rencanaFields as $field) {
                                $sheet->setCellValue($col . $currentRow, $item->$field ?? 0);
                                $col++;
                            }

                            // Add realisasi monthly data
                            $col = 'P';
                            foreach ($realisasiFields as $field) {
                                $sheet->setCellValue($col . $currentRow, $item->$field ?? 0);
                                $col++;
                            }

                            // Add Total Realisasi formula (sum of P to AA)
                            $sheet->setCellValue('AB' . $currentRow, '=SUM(P' . $currentRow . ':AA' . $currentRow . ')');
                            $currentRow++;
                        }

                        // Add thin borders to data rows
                        if ($data->count() > 0) {
                            $sheet->getStyle('A' . $startRow . ':AB' . $endRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                        }

                        // Add total row
                        $totalRow = $currentRow;
                        $sheet->setCellValue('B' . $totalRow, 'Total ' . $title);
                        $sheet->getStyle('B' . $totalRow)->getFont()->setBold(true);

                        // Add SUM formulas for each column from C to AB
                        $columns = ['C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB'];
                        foreach ($columns as $col) {
                            $sheet->setCellValue($col . $totalRow, '=SUM(' . $col . $startRow . ':' . $col . $endRow . ')');
                        }

                        // Add orange background to total row (no borders)
                        $orangeColor = 'FFA500';
                        $sheet->getStyle('A' . $totalRow . ':AB' . $totalRow)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                        $sheet->getStyle('A' . $totalRow . ':AB' . $totalRow)->getFill()->getStartColor()->setARGB($orangeColor);

                        // Store section range for grand total calculation
                        $allSectionRanges[] = [
                            'start' => $startRow,
                            'end' => $endRow
                        ];

                        $currentRow++;
                    }
                };

                $currentRow = 4;

                // Track all section start and end rows for grand total
                $allSectionRanges = [];

                // Add Belanja Pegawai section
                $addBelanjaSection($belanjaPegawai, 'Belanja Pegawai - 5.1.01.', $currentRow, $sheet, $allSectionRanges);

                // Add Belanja Barang dan Jasa section
                $addBelanjaSection($belanjaBarangJasa, 'Belanja Barang dan Jasa - 5.1.02.', $currentRow, $sheet, $allSectionRanges);

                // Add Belanja Modal section
                $addBelanjaSection($belanjaModal, 'Belanja Modal - 5.2.', $currentRow, $sheet, $allSectionRanges);

                // Add Grand Total row
                $this->addGrandTotal($sheet, $currentRow, $allSectionRanges);

                // Auto-size columns
                $sheet->getColumnDimension('A')->setAutoSize(true);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);

                // Auto-size month columns (D to O)
                $monthColumns = ['D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O'];
                foreach ($monthColumns as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                // Auto-size realisasi columns (P to AA) using manual array
                $realisasiColumns = ['P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA'];
                foreach ($realisasiColumns as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                // Auto-size Total Realisasi column (AB)
                $sheet->getColumnDimension('AB')->setAutoSize(true);

                // Wrap text for better readability
                $sheet->getStyle('B')->getAlignment()->setWrapText(true);

                // Format DPA column as numbers
                $sheet->getStyle('C')->getNumberFormat()->setFormatCode('#,##0');

                // Format rencana month columns (D-O) as numbers
                $sheet->getStyle('D:O')->getNumberFormat()->setFormatCode('#,##0');

                // Format realisasi month columns (P-AA) as numbers
                $sheet->getStyle('P:AA')->getNumberFormat()->setFormatCode('#,##0');

                // Format Total Realisasi column (AB) as numbers
                $sheet->getStyle('AB')->getNumberFormat()->setFormatCode('#,##0');

                // Freeze panes to lock headers when scrolling
                // Freeze row 3 (headers are in rows 1-3, so freeze from row 4 onwards)
                $sheet->freezePane('A4');

                // Free memory
                unset($skpdData, $groupedData, $belanjaPegawai);
            }

            // Add REKAP SKPD summary sheet at the beginning (leftmost position)
            $this->addRekapSkpdSheet($spreadsheet, $skpdList, 0);

            // Set filename and headers
            $filename = 'Laporan_Belanja_SKPD_' . date('Y-m-d_H-i-s') . '.xlsx';

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            header('Expires: 0');
            header('Pragma: public');

            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
            exit;
        } catch (\Exception $e) {
            // Log error and show user-friendly message
            Log::error('Export failed: ' . $e->getMessage());

            // Reset memory limit
            ini_set('memory_limit', '128M');

            return back()->with('error', 'Export gagal. Data terlalu besar. Silakan coba dengan filter yang lebih spesifik.');
        }
    }

    /**
     * Sanitize sheet name to be valid for Excel
     */
    private function sanitizeSheetName($name)
    {
        // Remove invalid characters and limit length
        $invalid = ['\\', '/', '*', ':', '?', '[', ']'];
        $name = str_replace($invalid, '', $name);
        return substr($name, 0, 31); // Excel sheet name max length is 31 characters
    }

    /**
     * Add grand total row at the bottom of the sheet
     */
    private function addGrandTotal($sheet, &$currentRow, $allSectionRanges)
    {
        if (empty($allSectionRanges)) {
            return;
        }

        // Add empty row before grand total
        $currentRow++;

        // Add grand total row
        $grandTotalRow = $currentRow;
        $sheet->setCellValue('B' . $grandTotalRow, 'TOTAL KESELURUHAN');
        $sheet->getStyle('B' . $grandTotalRow)->getFont()->setBold(true);

        // Calculate grand total by summing all section totals
        $columns = ['C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB'];

        foreach ($columns as $col) {
            $formulaParts = [];
            foreach ($allSectionRanges as $range) {
                $totalRow = $range['end'] + 1; // Total row is right after the data range
                $formulaParts[] = $col . $totalRow;
            }

            if (!empty($formulaParts)) {
                $formula = '=' . implode('+', $formulaParts);
                $sheet->setCellValue($col . $grandTotalRow, $formula);
            }
        }

        // Add green background to grand total row
        $greenColor = '00FF00';
        $sheet->getStyle('A' . $grandTotalRow . ':AB' . $grandTotalRow)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A' . $grandTotalRow . ':AB' . $grandTotalRow)->getFill()->getStartColor()->setARGB($greenColor);

        $currentRow++;
    }

    /**
     * Add REKAP SKPD summary sheet
     */
    private function addRekapSkpdSheet($spreadsheet, $skpdList, $position = null)
    {
        // Create new sheet for REKAP SKPD
        $rekapSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'REKAP SKPD');
        
        if ($position !== null) {
            $spreadsheet->addSheet($rekapSheet, $position);
        } else {
            $spreadsheet->addSheet($rekapSheet);
        }

        // Set title and date with merged cells
        $rekapSheet->setCellValue('A1', 'Rekapitulasi');
        $rekapSheet->mergeCells('A1:AB1');
        $rekapSheet->setCellValue('A2', 'Tanggal: ' . date('d-m-Y H:i:s'));
        $rekapSheet->mergeCells('A2:AB2');

        // Set headers
        $rekapSheet->setCellValue('A4', 'No');
        $rekapSheet->setCellValue('B4', 'Keterangan');
        $rekapSheet->setCellValue('C4', 'DPA');
        $rekapSheet->setCellValue('D4', 'Rencana');
        $rekapSheet->setCellValue('P4', 'Realisasi');
        $rekapSheet->setCellValue('AB4', 'Total Realisasi');

        // Merge Rencana header across 12 columns (D to O)
        $rekapSheet->mergeCells('D4:O4');

        // Merge Realisasi header across 12 columns (P to AA)
        $rekapSheet->mergeCells('P4:AA4');

        // Add month headers for Rencana
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $col = 'D';
        foreach ($months as $month) {
            $rekapSheet->setCellValue($col . '5', $month);
            $col++;
        }

        // Add month headers for Realisasi
        $col = 'P';
        foreach ($months as $month) {
            $rekapSheet->setCellValue($col . '5', $month);
            $col++;
        }

        // Style headers
        $rekapSheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $rekapSheet->getStyle('A4:AB5')->getFont()->setBold(true)->setSize(12);
        $rekapSheet->getStyle('A4:AB5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $rekapSheet->getStyle('D4:O4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $rekapSheet->getStyle('P4:AA4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

        // Apply gray background to headers
        $headerGray = 'D3D3D3';
        $rekapSheet->getStyle('A4:AB5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $rekapSheet->getStyle('A4:AB5')->getFill()->getStartColor()->setARGB($headerGray);

        // Add thin borders to headers
        $rekapSheet->getStyle('A4:AB5')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Define kode rekening patterns
        $kodePatterns = [
            'pegawai' => '5.1.01.',
            'barang_jasa' => '5.1.02.',
            'modal' => '5.2.'
        ];

        $currentRow = 6;
        $totalRowData = [
            'DPA' => 0,
            'Rencana' => array_fill(0, 12, 0),
            'Realisasi' => array_fill(0, 12, 0),
            'TotalRealisasi' => 0
        ];

        foreach ($skpdList as $index => $skpd) {
            // Get SKPD data
            $skpdData = Uraian::where('jenis_rfk', 'pergeseran')
                ->where('tahun', '2025')
                ->where('skpd_id', $skpd->id)
                ->where('ke', $skpd->ke)
                ->where(function ($query) use ($kodePatterns) {
                    foreach ($kodePatterns as $pattern) {
                        $query->orWhere('kode_rekening', 'like', $pattern . '%');
                    }
                })
                ->get();

            // Calculate totals for this SKPD
            $skpdTotals = [
                'DPA' => 0,
                'Rencana' => array_fill(0, 12, 0),
                'Realisasi' => array_fill(0, 12, 0),
                'TotalRealisasi' => 0
            ];

            $rencanaFields = [
                'p_januari_keuangan', 'p_februari_keuangan', 'p_maret_keuangan',
                'p_april_keuangan', 'p_mei_keuangan', 'p_juni_keuangan',
                'p_juli_keuangan', 'p_agustus_keuangan', 'p_september_keuangan',
                'p_oktober_keuangan', 'p_november_keuangan', 'p_desember_keuangan'
            ];

            $realisasiFields = [
                'r_januari_keuangan', 'r_februari_keuangan', 'r_maret_keuangan',
                'r_april_keuangan', 'r_mei_keuangan', 'r_juni_keuangan',
                'r_juli_keuangan', 'r_agustus_keuangan', 'r_september_keuangan',
                'r_oktober_keuangan', 'r_november_keuangan', 'r_desember_keuangan'
            ];

            foreach ($skpdData as $item) {
                $skpdTotals['DPA'] += $item->dpa ?? 0;
                
                foreach ($rencanaFields as $i => $field) {
                    $skpdTotals['Rencana'][$i] += $item->$field ?? 0;
                }
                
                foreach ($realisasiFields as $i => $field) {
                    $skpdTotals['Realisasi'][$i] += $item->$field ?? 0;
                }
            }

            // Calculate total realisasi for this SKPD
            $skpdTotals['TotalRealisasi'] = array_sum($skpdTotals['Realisasi']);

            // Add SKPD data to rekap sheet
            $rekapSheet->setCellValue('A' . $currentRow, $index + 1);
            $rekapSheet->setCellValue('B' . $currentRow, $skpd->nama);
            $rekapSheet->setCellValue('C' . $currentRow, $skpdTotals['DPA']);

            // Add rencana monthly data
            $col = 'D';
            foreach ($skpdTotals['Rencana'] as $value) {
                $rekapSheet->setCellValue($col . $currentRow, $value);
                $col++;
            }

            // Add realisasi monthly data
            $col = 'P';
            foreach ($skpdTotals['Realisasi'] as $value) {
                $rekapSheet->setCellValue($col . $currentRow, $value);
                $col++;
            }

            $rekapSheet->setCellValue('AB' . $currentRow, $skpdTotals['TotalRealisasi']);

            // Add to grand totals
            $totalRowData['DPA'] += $skpdTotals['DPA'];
            foreach ($skpdTotals['Rencana'] as $i => $value) {
                $totalRowData['Rencana'][$i] += $value;
            }
            foreach ($skpdTotals['Realisasi'] as $i => $value) {
                $totalRowData['Realisasi'][$i] += $value;
            }
            $totalRowData['TotalRealisasi'] += $skpdTotals['TotalRealisasi'];

            // Add borders to data row
            $rekapSheet->getStyle('A' . $currentRow . ':AB' . $currentRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            $currentRow++;
        }

        // Add total row
        $totalRow = $currentRow;
        $rekapSheet->setCellValue('B' . $totalRow, 'TOTAL KESELURUHAN');
        $rekapSheet->getStyle('B' . $totalRow)->getFont()->setBold(true);
        $rekapSheet->setCellValue('C' . $totalRow, $totalRowData['DPA']);

        // Add total rencana monthly data
        $col = 'D';
        foreach ($totalRowData['Rencana'] as $value) {
            $rekapSheet->setCellValue($col . $totalRow, $value);
            $col++;
        }

        // Add total realisasi monthly data
        $col = 'P';
        foreach ($totalRowData['Realisasi'] as $value) {
            $rekapSheet->setCellValue($col . $totalRow, $value);
            $col++;
        }

        $rekapSheet->setCellValue('AB' . $totalRow, $totalRowData['TotalRealisasi']);

        // Add green background to total row
        $greenColor = '00FF00';
        $rekapSheet->getStyle('A' . $totalRow . ':AB' . $totalRow)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $rekapSheet->getStyle('A' . $totalRow . ':AB' . $totalRow)->getFill()->getStartColor()->setARGB($greenColor);
        $rekapSheet->getStyle('A' . $totalRow . ':AB' . $totalRow)->getFont()->setBold(true);

        // Auto-size columns
        $rekapSheet->getColumnDimension('A')->setAutoSize(true);
        $rekapSheet->getColumnDimension('B')->setAutoSize(true);
        $rekapSheet->getColumnDimension('C')->setAutoSize(true);

        // Auto-size month columns (D to O)
        $monthColumns = ['D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O'];
        foreach ($monthColumns as $col) {
            $rekapSheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Auto-size realisasi columns (P to AA)
        $realisasiColumns = ['P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA'];
        foreach ($realisasiColumns as $col) {
            $rekapSheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Auto-size Total Realisasi column (AB)
        $rekapSheet->getColumnDimension('AB')->setAutoSize(true);

        // Format numbers
        $rekapSheet->getStyle('C:AB')->getNumberFormat()->setFormatCode('#,##0');

        // Freeze panes
        $rekapSheet->freezePane('A6');
    }
}
