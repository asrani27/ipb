<?php

namespace App\Http\Controllers;

use App\Models\Subkegiatan;
use App\Models\Uraian;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SuperadminController extends Controller
{
    public function laporan()
    {
        return view('superadmin.laporan.index');
    }

    public function export()
    {
        $bulan = request()->get('bulan');
        $tahun = request()->get('tahun');
        $jenis = request()->get('jenis');

        $disdik = Subkegiatan::where('tahun', $tahun)->where('skpd_id', 1)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan, $jenis) {
            $item->dpa = $item->uraian->where('jenis_rfk', $jenis)->sum('dpa');
            $item->rencana = rencanaSKPD($bulan, $item, $jenis);
            $item->realisasi = realisasiSKPD($bulan, $item, $jenis);
            $item->rencana_fisik = rencanaKumSkpd($item->id, $jenis, $bulan);
            $item->realisasi_fisik = realisasiKumSkpd($item->id, $jenis, $bulan);
            return $item;
        });

        $dinkes = Subkegiatan::where('tahun', $tahun)->where('skpd_id', 34)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan, $jenis) {
            $item->dpa = $item->uraian->where('jenis_rfk', $jenis)->sum('dpa');
            $item->rencana = rencanaSKPD($bulan, $item, $jenis);
            $item->realisasi = realisasiSKPD($bulan, $item, $jenis);
            $item->rencana_fisik = rencanaKumSkpd($item->id, $jenis, $bulan);
            $item->realisasi_fisik = realisasiKumSkpd($item->id, $jenis, $bulan);
            return $item;
        });

        $dpupr = Subkegiatan::where('tahun', $tahun)->where('skpd_id', 3)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan, $jenis) {
            $item->dpa = $item->uraian->where('jenis_rfk', $jenis)->sum('dpa');
            $item->rencana = rencanaSKPD($bulan, $item, $jenis);
            $item->realisasi = realisasiSKPD($bulan, $item, $jenis);
            $item->rencana_fisik = rencanaKumSkpd($item->id, $jenis, $bulan);
            $item->realisasi_fisik = realisasiKumSkpd($item->id, $jenis, $bulan);
            return $item;
        });
        $dprkp = Subkegiatan::where('tahun', $tahun)->where('skpd_id', 4)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan, $jenis) {
            $item->dpa = $item->uraian->where('jenis_rfk', $jenis)->sum('dpa');
            $item->rencana = rencanaSKPD($bulan, $item, $jenis);
            $item->realisasi = realisasiSKPD($bulan, $item, $jenis);
            $item->rencana_fisik = rencanaKumSkpd($item->id, $jenis, $bulan);
            $item->realisasi_fisik = realisasiKumSkpd($item->id, $jenis, $bulan);
            return $item;
        });
        $satpolpp = Subkegiatan::where('tahun', $tahun)->where('skpd_id', 5)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan, $jenis) {
            $item->dpa = $item->uraian->where('jenis_rfk', $jenis)->sum('dpa');
            $item->rencana = rencanaSKPD($bulan, $item, $jenis);
            $item->realisasi = realisasiSKPD($bulan, $item, $jenis);
            $item->rencana_fisik = rencanaKumSkpd($item->id, $jenis, $bulan);
            $item->realisasi_fisik = realisasiKumSkpd($item->id, $jenis, $bulan);
            return $item;
        });
        $kesbang = Subkegiatan::where('tahun', $tahun)->where('skpd_id', 6)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan, $jenis) {
            $item->dpa = $item->uraian->where('jenis_rfk', $jenis)->sum('dpa');
            $item->rencana = rencanaSKPD($bulan, $item, $jenis);
            $item->realisasi = realisasiSKPD($bulan, $item, $jenis);
            $item->rencana_fisik = rencanaKumSkpd($item->id, $jenis, $bulan);
            $item->realisasi_fisik = realisasiKumSkpd($item->id, $jenis, $bulan);
            return $item;
        });
        $dinsos = Subkegiatan::where('tahun', $tahun)->where('skpd_id', 7)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan, $jenis) {
            $item->dpa = $item->uraian->where('jenis_rfk', $jenis)->sum('dpa');
            $item->rencana = rencanaSKPD($bulan, $item, $jenis);
            $item->realisasi = realisasiSKPD($bulan, $item, $jenis);
            $item->rencana_fisik = rencanaKumSkpd($item->id, $jenis, $bulan);
            $item->realisasi_fisik = realisasiKumSkpd($item->id, $jenis, $bulan);
            return $item;
        });
        $dkp3 = Subkegiatan::where('tahun', $tahun)->where('skpd_id', 9)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan, $jenis) {
            $item->dpa = $item->uraian->where('jenis_rfk', $jenis)->sum('dpa');
            $item->rencana = rencanaSKPD($bulan, $item, $jenis);
            $item->realisasi = realisasiSKPD($bulan, $item, $jenis);
            $item->rencana_fisik = rencanaKumSkpd($item->id, $jenis, $bulan);
            $item->realisasi_fisik = realisasiKumSkpd($item->id, $jenis, $bulan);
            return $item;
        });
        $dlh = Subkegiatan::where('tahun', $tahun)->where('skpd_id', 10)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan, $jenis) {
            $item->dpa = $item->uraian->where('jenis_rfk', $jenis)->sum('dpa');
            $item->rencana = rencanaSKPD($bulan, $item, $jenis);
            $item->realisasi = realisasiSKPD($bulan, $item, $jenis);
            $item->rencana_fisik = rencanaKumSkpd($item->id, $jenis, $bulan);
            $item->realisasi_fisik = realisasiKumSkpd($item->id, $jenis, $bulan);
            return $item;
        });

        $capil = Subkegiatan::where('tahun', $tahun)->where('skpd_id', 11)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan, $jenis) {
            $item->dpa = $item->uraian->where('jenis_rfk', $jenis)->sum('dpa');
            $item->rencana = rencanaSKPD($bulan, $item, $jenis);
            $item->realisasi = realisasiSKPD($bulan, $item, $jenis);
            $item->rencana_fisik = rencanaKumSkpd($item->id, $jenis, $bulan);
            $item->realisasi_fisik = realisasiKumSkpd($item->id, $jenis, $bulan);
            return $item;
        });

        $dppkbpm = Subkegiatan::where('tahun', $tahun)->where('skpd_id', 12)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan, $jenis) {
            $item->dpa = $item->uraian->where('jenis_rfk', $jenis)->sum('dpa');
            $item->rencana = rencanaSKPD($bulan, $item, $jenis);
            $item->realisasi = realisasiSKPD($bulan, $item, $jenis);
            $item->rencana_fisik = rencanaKumSkpd($item->id, $jenis, $bulan);
            $item->realisasi_fisik = realisasiKumSkpd($item->id, $jenis, $bulan);
            return $item;
        });
        $dishub = Subkegiatan::where('tahun', $tahun)->where('skpd_id', 13)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan, $jenis) {
            $item->dpa = $item->uraian->where('jenis_rfk', $jenis)->sum('dpa');
            $item->rencana = rencanaSKPD($bulan, $item, $jenis);
            $item->realisasi = realisasiSKPD($bulan, $item, $jenis);
            $item->rencana_fisik = rencanaKumSkpd($item->id, $jenis, $bulan);
            $item->realisasi_fisik = realisasiKumSkpd($item->id, $jenis, $bulan);
            return $item;
        });
        $diskominfotik = Subkegiatan::where('tahun', $tahun)->where('skpd_id', 14)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan, $jenis) {
            $item->dpa = $item->uraian->where('jenis_rfk', $jenis)->sum('dpa');
            $item->rencana = rencanaSKPD($bulan, $item, $jenis);
            $item->realisasi = realisasiSKPD($bulan, $item, $jenis);
            $item->rencana_fisik = rencanaKumSkpd($item->id, $jenis, $bulan);
            $item->realisasi_fisik = realisasiKumSkpd($item->id, $jenis, $bulan);
            return $item;
        });
        $diskopumker = Subkegiatan::where('tahun', $tahun)->where('skpd_id', 15)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan, $jenis) {
            $item->dpa = $item->uraian->where('jenis_rfk', $jenis)->sum('dpa');
            $item->rencana = rencanaSKPD($bulan, $item, $jenis);
            $item->realisasi = realisasiSKPD($bulan, $item, $jenis);
            $item->rencana_fisik = rencanaKumSkpd($item->id, $jenis, $bulan);
            $item->realisasi_fisik = realisasiKumSkpd($item->id, $jenis, $bulan);
            return $item;
        });
        $dpa = Subkegiatan::where('tahun', $tahun)->where('skpd_id', 19)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan, $jenis) {
            $item->dpa = $item->uraian->where('jenis_rfk', $jenis)->sum('dpa');
            $item->rencana = rencanaSKPD($bulan, $item, $jenis);
            $item->realisasi = realisasiSKPD($bulan, $item, $jenis);
            $item->rencana_fisik = rencanaKumSkpd($item->id, $jenis, $bulan);
            $item->realisasi_fisik = realisasiKumSkpd($item->id, $jenis, $bulan);
            return $item;
        });
        $perdagin = Subkegiatan::where('tahun', $tahun)->where('skpd_id', 20)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan, $jenis) {
            $item->dpa = $item->uraian->where('jenis_rfk', $jenis)->sum('dpa');
            $item->rencana = rencanaSKPD($bulan, $item, $jenis);
            $item->realisasi = realisasiSKPD($bulan, $item, $jenis);
            $item->rencana_fisik = rencanaKumSkpd($item->id, $jenis, $bulan);
            $item->realisasi_fisik = realisasiKumSkpd($item->id, $jenis, $bulan);
            return $item;
        });
        //dd($disdik);

        $filename = 'Laporan_rfk_' . namaBulan($bulan) . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=$filename");
        header('Cache-Control: max-age=0');

        $path = public_path('/excel/laporan_rf.xlsx');

        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load($path);

        // DISDIK
        $spreadsheet->getSheetByName('1 Disdik')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('1 Disdik')->setCellValue('A2', 'DINAS PENDIDIKAN');
        $spreadsheet->getSheetByName('1 Disdik')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('1 Disdik')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $spreadsheet->getSheetByName('1 Disdik')->insertNewRowBefore(12, $disdik->count() - 1);
        $disdikRow = 11;

        if ($disdik->count() != 0) {
            foreach ($disdik as $key => $item_disdik) {
                $spreadsheet->getSheetByName('1 Disdik')->setCellValue('A' . $disdikRow, $key + 1);
                $spreadsheet->getSheetByName('1 Disdik')->setCellValue('B' . $disdikRow, $item_disdik->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('1 Disdik')->setCellValue('C' . $disdikRow, $item_disdik->dpa);
                $spreadsheet->getSheetByName('1 Disdik')->setCellValue('D' . $disdikRow, '=C' . $disdikRow . '/$C$' . $disdik->count() + 11 . '*100');
                $spreadsheet->getSheetByName('1 Disdik')->setCellValue('E' . $disdikRow, $item_disdik->rencana);
                $spreadsheet->getSheetByName('1 Disdik')->setCellValue('F' . $disdikRow, '=E' . $disdikRow . '/C' . $disdikRow . '*100');
                $spreadsheet->getSheetByName('1 Disdik')->setCellValue('G' . $disdikRow, '=F' . $disdikRow . '*D' . $disdikRow . '/100');
                $spreadsheet->getSheetByName('1 Disdik')->setCellValue('H' . $disdikRow, $item_disdik->realisasi);
                $spreadsheet->getSheetByName('1 Disdik')->setCellValue('I' . $disdikRow, '=H' . $disdikRow . '/C' . $disdikRow . '*100');
                $spreadsheet->getSheetByName('1 Disdik')->setCellValue('J' . $disdikRow, '=I' . $disdikRow . '*D' . $disdikRow . '/100');
                $spreadsheet->getSheetByName('1 Disdik')->setCellValue('K' . $disdikRow, '=IF(E' . $disdikRow . '=0,0,H' . $disdikRow . '/E' . $disdikRow . '*100)');
                $spreadsheet->getSheetByName('1 Disdik')->setCellValue('L' . $disdikRow, '=J' . $disdikRow . '-G' . $disdikRow);
                $spreadsheet->getSheetByName('1 Disdik')->setCellValue('M' . $disdikRow, '=C' . $disdikRow . '-H' . $disdikRow);
                $spreadsheet->getSheetByName('1 Disdik')->setCellValue('N' . $disdikRow, $item_disdik->rencana_fisik);
                $spreadsheet->getSheetByName('1 Disdik')->setCellValue('O' . $disdikRow, '=N' . $disdikRow . '*D' . $disdikRow . '/100');
                $spreadsheet->getSheetByName('1 Disdik')->setCellValue('P' . $disdikRow, $item_disdik->realisasi_fisik);
                $spreadsheet->getSheetByName('1 Disdik')->setCellValue('Q' . $disdikRow, '=P' . $disdikRow . '*D' . $disdikRow . '/100');
                $spreadsheet->getSheetByName('1 Disdik')->setCellValue('R' . $disdikRow, '=IF(N' . $disdikRow . '=0,0,P' . $disdikRow . '/N' . $disdikRow . '*100)');
                $disdikRow++;
            }
            $spreadsheet->getSheetByName('1 Disdik')->setCellValue('B' . $disdik->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('1 Disdik')->setCellValue('C' . $disdik->count() + 11, '=SUM(C11:C' . $disdik->count() + 10 . ')');
            $spreadsheet->getSheetByName('1 Disdik')->setCellValue('D' . $disdik->count() + 11, '=SUM(D11:D' . $disdik->count() + 10 . ')');
            $spreadsheet->getSheetByName('1 Disdik')->setCellValue('E' . $disdik->count() + 11, '=SUM(E11:E' . $disdik->count() + 10 . ')');
            $spreadsheet->getSheetByName('1 Disdik')->setCellValue('F' . $disdik->count() + 11, '=SUM(G11:G' . $disdik->count() + 10 . ')');
            $spreadsheet->getSheetByName('1 Disdik')->setCellValue('G' . $disdik->count() + 11, '=SUM(G11:G' . $disdik->count() + 10 . ')');
            $spreadsheet->getSheetByName('1 Disdik')->setCellValue('H' . $disdik->count() + 11, '=SUM(H11:H' . $disdik->count() + 10 . ')');
            $spreadsheet->getSheetByName('1 Disdik')->setCellValue('I' . $disdik->count() + 11, '=SUM(J11:J' . $disdik->count() + 10 . ')');
            $spreadsheet->getSheetByName('1 Disdik')->setCellValue('J' . $disdik->count() + 11, '=SUM(J11:J' . $disdik->count() + 10 . ')');
            $spreadsheet->getSheetByName('1 Disdik')->setCellValue('K' . $disdik->count() + 11, '=IF(E' . $disdik->count() + 11 . '=0,0,H' . $disdik->count() + 11 . '/E' . $disdik->count() + 11 . '*100)');
            $spreadsheet->getSheetByName('1 Disdik')->setCellValue('L' . $disdik->count() + 11, '=J' . $disdik->count() + 11 . '-G' .  $disdik->count() + 11);
            $spreadsheet->getSheetByName('1 Disdik')->setCellValue('M' . $disdik->count() + 11, '=C' . $disdik->count() + 11 . '-H' .  $disdik->count() + 11);
            $spreadsheet->getSheetByName('1 Disdik')->setCellValue('N' . $disdik->count() + 11, '=SUM(O11:O' . $disdik->count() + 10 . ')');
            $spreadsheet->getSheetByName('1 Disdik')->setCellValue('O' . $disdik->count() + 11, '=SUM(O11:O' . $disdik->count() + 10 . ')');
            $spreadsheet->getSheetByName('1 Disdik')->setCellValue('P' . $disdik->count() + 11, '=SUM(Q11:Q' . $disdik->count() + 10 . ')');
            $spreadsheet->getSheetByName('1 Disdik')->setCellValue('Q' . $disdik->count() + 11, '=SUM(Q11:Q' . $disdik->count() + 10 . ')');
            $spreadsheet->getSheetByName('1 Disdik')->setCellValue('R' . $disdik->count() + 11, '=IF(N' . $disdik->count() + 11 . '=0,0,P' . $disdik->count() + 11 . '/N' . $disdik->count() + 11 . '*100)');
        }

        // DINKES
        $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('A2', 'DINAS KESEHATAN');
        $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $spreadsheet->getSheetByName('2 Dinkes')->insertNewRowBefore(12, $dinkes->count() - 1);
        $dinkesRow = 11;
        if ($dinkes->count() != 0) {
            foreach ($dinkes as $key => $item) {
                $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('A' . $dinkesRow, $key + 1);
                $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('B' . $dinkesRow, $item->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('C' . $dinkesRow, $item->dpa);
                $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('D' . $dinkesRow, '=C' . $dinkesRow . '/$C$' . $disdik->count() + 11 . '*100');
                $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('E' . $dinkesRow, $item->rencana);
                $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('F' . $dinkesRow, '=E' . $dinkesRow . '/C' . $dinkesRow . '*100');
                $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('G' . $dinkesRow, '=F' . $dinkesRow . '*D' . $dinkesRow . '/100');
                $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('H' . $dinkesRow, $item->realisasi);
                $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('I' . $dinkesRow, '=H' . $dinkesRow . '/C' . $dinkesRow . '*100');
                $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('J' . $dinkesRow, '=I' . $dinkesRow . '*D' . $dinkesRow . '/100');
                $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('K' . $dinkesRow, '=IF(E' . $dinkesRow . '=0,0,H' . $dinkesRow . '/E' . $dinkesRow . '*100)');
                $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('L' . $dinkesRow, '=J' . $dinkesRow . '-G' . $dinkesRow);
                $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('M' . $dinkesRow, '=C' . $dinkesRow . '-H' . $dinkesRow);
                $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('N' . $dinkesRow, $item->rencana_fisik);
                $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('O' . $dinkesRow, '=N' . $dinkesRow . '*D' . $dinkesRow . '/100');
                $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('P' . $dinkesRow, $item->realisasi_fisik);
                $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('Q' . $dinkesRow, '=P' . $dinkesRow . '*D' . $dinkesRow . '/100');
                $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('R' . $dinkesRow, '=IF(N' . $dinkesRow . '=0,0,P' . $dinkesRow . '/N' . $dinkesRow . '*100)');
                $dinkesRow++;
            }
            $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('B' . $dinkes->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('C' . $dinkes->count() + 11, '=SUM(C11:C' . $dinkes->count() + 10 . ')');
            $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('D' . $dinkes->count() + 11, '=SUM(D11:D' . $dinkes->count() + 10 . ')');
            $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('E' . $dinkes->count() + 11, '=SUM(E11:E' . $dinkes->count() + 10 . ')');
            $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('F' . $dinkes->count() + 11, '=SUM(G11:G' . $dinkes->count() + 10 . ')');
            $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('G' . $dinkes->count() + 11, '=SUM(G11:G' . $dinkes->count() + 10 . ')');
            $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('H' . $dinkes->count() + 11, '=SUM(H11:H' . $dinkes->count() + 10 . ')');
            $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('I' . $dinkes->count() + 11, '=SUM(J11:J' . $dinkes->count() + 10 . ')');
            $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('J' . $dinkes->count() + 11, '=SUM(J11:J' . $dinkes->count() + 10 . ')');
            $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('K' . $dinkes->count() + 11, '=IF(E' . $dinkes->count() + 11 . '=0,0,H' . $dinkes->count() + 11 . '/E' . $dinkes->count() + 11 . '*100)');
            $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('L' . $dinkes->count() + 11, '=J' . $dinkes->count() + 11 . '-G' .  $dinkes->count() + 11);
            $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('M' . $dinkes->count() + 11, '=C' . $dinkes->count() + 11 . '-H' .  $dinkes->count() + 11);
            $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('N' . $dinkes->count() + 11, '=SUM(O11:O' . $dinkes->count() + 10 . ')');
            $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('O' . $dinkes->count() + 11, '=SUM(O11:O' . $dinkes->count() + 10 . ')');
            $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('P' . $dinkes->count() + 11, '=SUM(Q11:Q' . $dinkes->count() + 10 . ')');
            $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('Q' . $dinkes->count() + 11, '=SUM(Q11:Q' . $dinkes->count() + 10 . ')');
            $spreadsheet->getSheetByName('2 Dinkes')->setCellValue('R' . $dinkes->count() + 11, '=IF(N' . $dinkes->count() + 11 . '=0,0,P' . $dinkes->count() + 11 . '/N' . $dinkes->count() + 11 . '*100)');
        }
        // DPUPR
        $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('A2', 'Dinas Pekerjaan Umum dan Penataan Ruang');
        $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $spreadsheet->getSheetByName('3 DPUPR')->insertNewRowBefore(12, $dinkes->count() - 1);
        $dpuprRow = 11;
        if ($dpupr->count() != 0) {
            foreach ($dpupr as $key => $item) {
                $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('A' . $dpuprRow, $key + 1);
                $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('B' . $dpuprRow, $item->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('C' . $dpuprRow, $item->dpa);
                $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('D' . $dpuprRow, '=C' . $dpuprRow . '/$C$' . $disdik->count() + 11 . '*100');
                $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('E' . $dpuprRow, $item->rencana);
                $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('F' . $dpuprRow, '=E' . $dpuprRow . '/C' . $dpuprRow . '*100');
                $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('G' . $dpuprRow, '=F' . $dpuprRow . '*D' . $dpuprRow . '/100');
                $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('H' . $dpuprRow, $item->realisasi);
                $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('I' . $dpuprRow, '=H' . $dpuprRow . '/C' . $dpuprRow . '*100');
                $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('J' . $dpuprRow, '=I' . $dpuprRow . '*D' . $dpuprRow . '/100');
                $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('K' . $dpuprRow, '=IF(E' . $dpuprRow . '=0,0,H' . $dpuprRow . '/E' . $dpuprRow . '*100)');
                $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('L' . $dpuprRow, '=J' . $dpuprRow . '-G' . $dpuprRow);
                $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('M' . $dpuprRow, '=C' . $dpuprRow . '-H' . $dpuprRow);
                $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('N' . $dpuprRow, $item->rencana_fisik);
                $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('O' . $dpuprRow, '=N' . $dpuprRow . '*D' . $dpuprRow . '/100');
                $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('P' . $dpuprRow, $item->realisasi_fisik);
                $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('Q' . $dpuprRow, '=P' . $dpuprRow . '*D' . $dpuprRow . '/100');
                $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('R' . $dpuprRow, '=IF(N' . $dpuprRow . '=0,0,P' . $dpuprRow . '/N' . $dpuprRow . '*100)');
                $dpuprRow++;
            }
            $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('B' . $dpupr->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('C' . $dpupr->count() + 11, '=SUM(C11:C' . $dpupr->count() + 10 . ')');
            $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('D' . $dpupr->count() + 11, '=SUM(D11:D' . $dpupr->count() + 10 . ')');
            $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('E' . $dpupr->count() + 11, '=SUM(E11:E' . $dpupr->count() + 10 . ')');
            $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('F' . $dpupr->count() + 11, '=SUM(G11:G' . $dpupr->count() + 10 . ')');
            $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('G' . $dpupr->count() + 11, '=SUM(G11:G' . $dpupr->count() + 10 . ')');
            $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('H' . $dpupr->count() + 11, '=SUM(H11:H' . $dpupr->count() + 10 . ')');
            $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('I' . $dpupr->count() + 11, '=SUM(J11:J' . $dpupr->count() + 10 . ')');
            $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('J' . $dpupr->count() + 11, '=SUM(J11:J' . $dpupr->count() + 10 . ')');
            $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('K' . $dpupr->count() + 11, '=IF(E' . $dpupr->count() + 11 . '=0,0,H' . $dpupr->count() + 11 . '/E' . $dpupr->count() + 11 . '*100)');
            $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('L' . $dpupr->count() + 11, '=J' . $dpupr->count() + 11 . '-G' .  $dpupr->count() + 11);
            $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('M' . $dpupr->count() + 11, '=C' . $dpupr->count() + 11 . '-H' .  $dpupr->count() + 11);
            $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('N' . $dpupr->count() + 11, '=SUM(O11:O' . $dpupr->count() + 10 . ')');
            $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('O' . $dpupr->count() + 11, '=SUM(O11:O' . $dpupr->count() + 10 . ')');
            $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('P' . $dpupr->count() + 11, '=SUM(Q11:Q' . $dpupr->count() + 10 . ')');
            $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('Q' . $dpupr->count() + 11, '=SUM(Q11:Q' . $dpupr->count() + 10 . ')');
            $spreadsheet->getSheetByName('3 DPUPR')->setCellValue('R' . $dpupr->count() + 11, '=IF(N' . $dpupr->count() + 11 . '=0,0,P' . $dpupr->count() + 11 . '/N' . $dpupr->count() + 11 . '*100)');
        }


        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}
