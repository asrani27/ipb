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
        $kesbangpol = Subkegiatan::where('tahun', $tahun)->where('skpd_id', 6)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan, $jenis) {
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
        $dp3a = Subkegiatan::where('tahun', $tahun)->where('skpd_id', 8)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan, $jenis) {
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
        $dpmptsp = Subkegiatan::where('tahun', $tahun)->where('skpd_id', 16)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan, $jenis) {
            $item->dpa = $item->uraian->where('jenis_rfk', $jenis)->sum('dpa');
            $item->rencana = rencanaSKPD($bulan, $item, $jenis);
            $item->realisasi = realisasiSKPD($bulan, $item, $jenis);
            $item->rencana_fisik = rencanaKumSkpd($item->id, $jenis, $bulan);
            $item->realisasi_fisik = realisasiKumSkpd($item->id, $jenis, $bulan);
            return $item;
        });
        $disbudporapar = Subkegiatan::where('tahun', $tahun)->where('skpd_id', 37)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan, $jenis) {
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
        $spreadsheet->getSheetByName('3 DPUPR')->insertNewRowBefore(12, $dpupr->count() - 1);
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
        // dprkp
        $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('A2', 'Dinas Perumahan Rakyat dan Kawasan Permukiman');
        $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $spreadsheet->getSheetByName('4 DPRKP')->insertNewRowBefore(12, $dprkp->count() - 1);
        $dprkpRow = 11;
        if ($dprkp->count() != 0) {
            foreach ($dprkp as $key => $item) {
                $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('A' . $dprkpRow, $key + 1);
                $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('B' . $dprkpRow, $item->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('C' . $dprkpRow, $item->dpa);
                $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('D' . $dprkpRow, '=C' . $dprkpRow . '/$C$' . $disdik->count() + 11 . '*100');
                $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('E' . $dprkpRow, $item->rencana);
                $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('F' . $dprkpRow, '=E' . $dprkpRow . '/C' . $dprkpRow . '*100');
                $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('G' . $dprkpRow, '=F' . $dprkpRow . '*D' . $dprkpRow . '/100');
                $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('H' . $dprkpRow, $item->realisasi);
                $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('I' . $dprkpRow, '=H' . $dprkpRow . '/C' . $dprkpRow . '*100');
                $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('J' . $dprkpRow, '=I' . $dprkpRow . '*D' . $dprkpRow . '/100');
                $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('K' . $dprkpRow, '=IF(E' . $dprkpRow . '=0,0,H' . $dprkpRow . '/E' . $dprkpRow . '*100)');
                $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('L' . $dprkpRow, '=J' . $dprkpRow . '-G' . $dprkpRow);
                $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('M' . $dprkpRow, '=C' . $dprkpRow . '-H' . $dprkpRow);
                $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('N' . $dprkpRow, $item->rencana_fisik);
                $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('O' . $dprkpRow, '=N' . $dprkpRow . '*D' . $dprkpRow . '/100');
                $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('P' . $dprkpRow, $item->realisasi_fisik);
                $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('Q' . $dprkpRow, '=P' . $dprkpRow . '*D' . $dprkpRow . '/100');
                $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('R' . $dprkpRow, '=IF(N' . $dprkpRow . '=0,0,P' . $dprkpRow . '/N' . $dprkpRow . '*100)');
                $dprkpRow++;
            }
            $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('B' . $dprkp->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('C' . $dprkp->count() + 11, '=SUM(C11:C' . $dprkp->count() + 10 . ')');
            $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('D' . $dprkp->count() + 11, '=SUM(D11:D' . $dprkp->count() + 10 . ')');
            $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('E' . $dprkp->count() + 11, '=SUM(E11:E' . $dprkp->count() + 10 . ')');
            $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('F' . $dprkp->count() + 11, '=SUM(G11:G' . $dprkp->count() + 10 . ')');
            $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('G' . $dprkp->count() + 11, '=SUM(G11:G' . $dprkp->count() + 10 . ')');
            $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('H' . $dprkp->count() + 11, '=SUM(H11:H' . $dprkp->count() + 10 . ')');
            $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('I' . $dprkp->count() + 11, '=SUM(J11:J' . $dprkp->count() + 10 . ')');
            $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('J' . $dprkp->count() + 11, '=SUM(J11:J' . $dprkp->count() + 10 . ')');
            $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('K' . $dprkp->count() + 11, '=IF(E' . $dprkp->count() + 11 . '=0,0,H' . $dprkp->count() + 11 . '/E' . $dprkp->count() + 11 . '*100)');
            $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('L' . $dprkp->count() + 11, '=J' . $dprkp->count() + 11 . '-G' .  $dprkp->count() + 11);
            $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('M' . $dprkp->count() + 11, '=C' . $dprkp->count() + 11 . '-H' .  $dprkp->count() + 11);
            $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('N' . $dprkp->count() + 11, '=SUM(O11:O' . $dprkp->count() + 10 . ')');
            $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('O' . $dprkp->count() + 11, '=SUM(O11:O' . $dprkp->count() + 10 . ')');
            $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('P' . $dprkp->count() + 11, '=SUM(Q11:Q' . $dprkp->count() + 10 . ')');
            $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('Q' . $dprkp->count() + 11, '=SUM(Q11:Q' . $dprkp->count() + 10 . ')');
            $spreadsheet->getSheetByName('4 DPRKP')->setCellValue('R' . $dprkp->count() + 11, '=IF(N' . $dprkp->count() + 11 . '=0,0,P' . $dprkp->count() + 11 . '/N' . $dprkp->count() + 11 . '*100)');
        }

        // satpolpp
        $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('A2', 'Satuan Polisi Pamong Praja');
        $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $spreadsheet->getSheetByName('5 SATPOLPP')->insertNewRowBefore(12, $satpolpp->count() - 1);
        $satpolppRow = 11;
        if ($satpolpp->count() != 0) {
            foreach ($satpolpp as $key => $item) {
                $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('A' . $satpolppRow, $key + 1);
                $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('B' . $satpolppRow, $item->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('C' . $satpolppRow, $item->dpa);
                $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('D' . $satpolppRow, '=C' . $satpolppRow . '/$C$' . $disdik->count() + 11 . '*100');
                $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('E' . $satpolppRow, $item->rencana);
                $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('F' . $satpolppRow, '=E' . $satpolppRow . '/C' . $satpolppRow . '*100');
                $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('G' . $satpolppRow, '=F' . $satpolppRow . '*D' . $satpolppRow . '/100');
                $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('H' . $satpolppRow, $item->realisasi);
                $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('I' . $satpolppRow, '=H' . $satpolppRow . '/C' . $satpolppRow . '*100');
                $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('J' . $satpolppRow, '=I' . $satpolppRow . '*D' . $satpolppRow . '/100');
                $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('K' . $satpolppRow, '=IF(E' . $satpolppRow . '=0,0,H' . $satpolppRow . '/E' . $satpolppRow . '*100)');
                $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('L' . $satpolppRow, '=J' . $satpolppRow . '-G' . $satpolppRow);
                $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('M' . $satpolppRow, '=C' . $satpolppRow . '-H' . $satpolppRow);
                $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('N' . $satpolppRow, $item->rencana_fisik);
                $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('O' . $satpolppRow, '=N' . $satpolppRow . '*D' . $satpolppRow . '/100');
                $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('P' . $satpolppRow, $item->realisasi_fisik);
                $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('Q' . $satpolppRow, '=P' . $satpolppRow . '*D' . $satpolppRow . '/100');
                $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('R' . $satpolppRow, '=IF(N' . $satpolppRow . '=0,0,P' . $satpolppRow . '/N' . $satpolppRow . '*100)');
                $satpolppRow++;
            }
            $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('B' . $satpolpp->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('C' . $satpolpp->count() + 11, '=SUM(C11:C' . $satpolpp->count() + 10 . ')');
            $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('D' . $satpolpp->count() + 11, '=SUM(D11:D' . $satpolpp->count() + 10 . ')');
            $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('E' . $satpolpp->count() + 11, '=SUM(E11:E' . $satpolpp->count() + 10 . ')');
            $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('F' . $satpolpp->count() + 11, '=SUM(G11:G' . $satpolpp->count() + 10 . ')');
            $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('G' . $satpolpp->count() + 11, '=SUM(G11:G' . $satpolpp->count() + 10 . ')');
            $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('H' . $satpolpp->count() + 11, '=SUM(H11:H' . $satpolpp->count() + 10 . ')');
            $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('I' . $satpolpp->count() + 11, '=SUM(J11:J' . $satpolpp->count() + 10 . ')');
            $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('J' . $satpolpp->count() + 11, '=SUM(J11:J' . $satpolpp->count() + 10 . ')');
            $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('K' . $satpolpp->count() + 11, '=IF(E' . $satpolpp->count() + 11 . '=0,0,H' . $satpolpp->count() + 11 . '/E' . $satpolpp->count() + 11 . '*100)');
            $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('L' . $satpolpp->count() + 11, '=J' . $satpolpp->count() + 11 . '-G' .  $satpolpp->count() + 11);
            $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('M' . $satpolpp->count() + 11, '=C' . $satpolpp->count() + 11 . '-H' .  $satpolpp->count() + 11);
            $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('N' . $satpolpp->count() + 11, '=SUM(O11:O' . $satpolpp->count() + 10 . ')');
            $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('O' . $satpolpp->count() + 11, '=SUM(O11:O' . $satpolpp->count() + 10 . ')');
            $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('P' . $satpolpp->count() + 11, '=SUM(Q11:Q' . $satpolpp->count() + 10 . ')');
            $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('Q' . $satpolpp->count() + 11, '=SUM(Q11:Q' . $satpolpp->count() + 10 . ')');
            $spreadsheet->getSheetByName('5 SATPOLPP')->setCellValue('R' . $satpolpp->count() + 11, '=IF(N' . $satpolpp->count() + 11 . '=0,0,P' . $satpolpp->count() + 11 . '/N' . $satpolpp->count() + 11 . '*100)');
        }
        // kesbangpol
        $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('A2', 'Badan Kesatuan Bangsa dan Politik');
        $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $spreadsheet->getSheetByName('6 KESBANGPOL')->insertNewRowBefore(12, $kesbangpol->count() - 1);
        $kesbangpolRow = 11;
        if ($kesbangpol->count() != 0) {
            foreach ($kesbangpol as $key => $item) {
                $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('A' . $kesbangpolRow, $key + 1);
                $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('B' . $kesbangpolRow, $item->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('C' . $kesbangpolRow, $item->dpa);
                $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('D' . $kesbangpolRow, '=C' . $kesbangpolRow . '/$C$' . $disdik->count() + 11 . '*100');
                $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('E' . $kesbangpolRow, $item->rencana);
                $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('F' . $kesbangpolRow, '=E' . $kesbangpolRow . '/C' . $kesbangpolRow . '*100');
                $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('G' . $kesbangpolRow, '=F' . $kesbangpolRow . '*D' . $kesbangpolRow . '/100');
                $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('H' . $kesbangpolRow, $item->realisasi);
                $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('I' . $kesbangpolRow, '=H' . $kesbangpolRow . '/C' . $kesbangpolRow . '*100');
                $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('J' . $kesbangpolRow, '=I' . $kesbangpolRow . '*D' . $kesbangpolRow . '/100');
                $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('K' . $kesbangpolRow, '=IF(E' . $kesbangpolRow . '=0,0,H' . $kesbangpolRow . '/E' . $kesbangpolRow . '*100)');
                $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('L' . $kesbangpolRow, '=J' . $kesbangpolRow . '-G' . $kesbangpolRow);
                $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('M' . $kesbangpolRow, '=C' . $kesbangpolRow . '-H' . $kesbangpolRow);
                $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('N' . $kesbangpolRow, $item->rencana_fisik);
                $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('O' . $kesbangpolRow, '=N' . $kesbangpolRow . '*D' . $kesbangpolRow . '/100');
                $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('P' . $kesbangpolRow, $item->realisasi_fisik);
                $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('Q' . $kesbangpolRow, '=P' . $kesbangpolRow . '*D' . $kesbangpolRow . '/100');
                $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('R' . $kesbangpolRow, '=IF(N' . $kesbangpolRow . '=0,0,P' . $kesbangpolRow . '/N' . $kesbangpolRow . '*100)');
                $kesbangpolRow++;
            }
            $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('B' . $kesbangpol->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('C' . $kesbangpol->count() + 11, '=SUM(C11:C' . $kesbangpol->count() + 10 . ')');
            $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('D' . $kesbangpol->count() + 11, '=SUM(D11:D' . $kesbangpol->count() + 10 . ')');
            $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('E' . $kesbangpol->count() + 11, '=SUM(E11:E' . $kesbangpol->count() + 10 . ')');
            $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('F' . $kesbangpol->count() + 11, '=SUM(G11:G' . $kesbangpol->count() + 10 . ')');
            $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('G' . $kesbangpol->count() + 11, '=SUM(G11:G' . $kesbangpol->count() + 10 . ')');
            $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('H' . $kesbangpol->count() + 11, '=SUM(H11:H' . $kesbangpol->count() + 10 . ')');
            $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('I' . $kesbangpol->count() + 11, '=SUM(J11:J' . $kesbangpol->count() + 10 . ')');
            $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('J' . $kesbangpol->count() + 11, '=SUM(J11:J' . $kesbangpol->count() + 10 . ')');
            $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('K' . $kesbangpol->count() + 11, '=IF(E' . $kesbangpol->count() + 11 . '=0,0,H' . $kesbangpol->count() + 11 . '/E' . $kesbangpol->count() + 11 . '*100)');
            $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('L' . $kesbangpol->count() + 11, '=J' . $kesbangpol->count() + 11 . '-G' .  $kesbangpol->count() + 11);
            $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('M' . $kesbangpol->count() + 11, '=C' . $kesbangpol->count() + 11 . '-H' .  $kesbangpol->count() + 11);
            $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('N' . $kesbangpol->count() + 11, '=SUM(O11:O' . $kesbangpol->count() + 10 . ')');
            $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('O' . $kesbangpol->count() + 11, '=SUM(O11:O' . $kesbangpol->count() + 10 . ')');
            $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('P' . $kesbangpol->count() + 11, '=SUM(Q11:Q' . $kesbangpol->count() + 10 . ')');
            $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('Q' . $kesbangpol->count() + 11, '=SUM(Q11:Q' . $kesbangpol->count() + 10 . ')');
            $spreadsheet->getSheetByName('6 KESBANGPOL')->setCellValue('R' . $kesbangpol->count() + 11, '=IF(N' . $kesbangpol->count() + 11 . '=0,0,P' . $kesbangpol->count() + 11 . '/N' . $kesbangpol->count() + 11 . '*100)');
        }

        // dinsos
        $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('A2', 'Dinas Sosial');
        $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $spreadsheet->getSheetByName('7 DINSOS')->insertNewRowBefore(12, $dinsos->count() - 1);
        $dinsosRow = 11;
        if ($dinsos->count() != 0) {
            foreach ($dinsos as $key => $item) {
                $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('A' . $dinsosRow, $key + 1);
                $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('B' . $dinsosRow, $item->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('C' . $dinsosRow, $item->dpa);
                $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('D' . $dinsosRow, '=C' . $dinsosRow . '/$C$' . $disdik->count() + 11 . '*100');
                $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('E' . $dinsosRow, $item->rencana);
                $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('F' . $dinsosRow, '=E' . $dinsosRow . '/C' . $dinsosRow . '*100');
                $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('G' . $dinsosRow, '=F' . $dinsosRow . '*D' . $dinsosRow . '/100');
                $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('H' . $dinsosRow, $item->realisasi);
                $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('I' . $dinsosRow, '=H' . $dinsosRow . '/C' . $dinsosRow . '*100');
                $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('J' . $dinsosRow, '=I' . $dinsosRow . '*D' . $dinsosRow . '/100');
                $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('K' . $dinsosRow, '=IF(E' . $dinsosRow . '=0,0,H' . $dinsosRow . '/E' . $dinsosRow . '*100)');
                $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('L' . $dinsosRow, '=J' . $dinsosRow . '-G' . $dinsosRow);
                $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('M' . $dinsosRow, '=C' . $dinsosRow . '-H' . $dinsosRow);
                $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('N' . $dinsosRow, $item->rencana_fisik);
                $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('O' . $dinsosRow, '=N' . $dinsosRow . '*D' . $dinsosRow . '/100');
                $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('P' . $dinsosRow, $item->realisasi_fisik);
                $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('Q' . $dinsosRow, '=P' . $dinsosRow . '*D' . $dinsosRow . '/100');
                $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('R' . $dinsosRow, '=IF(N' . $dinsosRow . '=0,0,P' . $dinsosRow . '/N' . $dinsosRow . '*100)');
                $dinsosRow++;
            }
            $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('B' . $dinsos->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('C' . $dinsos->count() + 11, '=SUM(C11:C' . $dinsos->count() + 10 . ')');
            $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('D' . $dinsos->count() + 11, '=SUM(D11:D' . $dinsos->count() + 10 . ')');
            $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('E' . $dinsos->count() + 11, '=SUM(E11:E' . $dinsos->count() + 10 . ')');
            $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('F' . $dinsos->count() + 11, '=SUM(G11:G' . $dinsos->count() + 10 . ')');
            $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('G' . $dinsos->count() + 11, '=SUM(G11:G' . $dinsos->count() + 10 . ')');
            $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('H' . $dinsos->count() + 11, '=SUM(H11:H' . $dinsos->count() + 10 . ')');
            $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('I' . $dinsos->count() + 11, '=SUM(J11:J' . $dinsos->count() + 10 . ')');
            $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('J' . $dinsos->count() + 11, '=SUM(J11:J' . $dinsos->count() + 10 . ')');
            $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('K' . $dinsos->count() + 11, '=IF(E' . $dinsos->count() + 11 . '=0,0,H' . $dinsos->count() + 11 . '/E' . $dinsos->count() + 11 . '*100)');
            $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('L' . $dinsos->count() + 11, '=J' . $dinsos->count() + 11 . '-G' .  $dinsos->count() + 11);
            $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('M' . $dinsos->count() + 11, '=C' . $dinsos->count() + 11 . '-H' .  $dinsos->count() + 11);
            $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('N' . $dinsos->count() + 11, '=SUM(O11:O' . $dinsos->count() + 10 . ')');
            $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('O' . $dinsos->count() + 11, '=SUM(O11:O' . $dinsos->count() + 10 . ')');
            $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('P' . $dinsos->count() + 11, '=SUM(Q11:Q' . $dinsos->count() + 10 . ')');
            $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('Q' . $dinsos->count() + 11, '=SUM(Q11:Q' . $dinsos->count() + 10 . ')');
            $spreadsheet->getSheetByName('7 DINSOS')->setCellValue('R' . $dinsos->count() + 11, '=IF(N' . $dinsos->count() + 11 . '=0,0,P' . $dinsos->count() + 11 . '/N' . $dinsos->count() + 11 . '*100)');
        }

        // dp3a
        $spreadsheet->getSheetByName('8 DP3A')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('8 DP3A')->setCellValue('A2', 'Dinas Pemberdayaan Perempuan dan Perlindungan Anak');
        $spreadsheet->getSheetByName('8 DP3A')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('8 DP3A')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $spreadsheet->getSheetByName('8 DP3A')->insertNewRowBefore(12, $dp3a->count() - 1);
        $dp3aRow = 11;
        if ($dp3a->count() != 0) {
            foreach ($dp3a as $key => $item) {
                $spreadsheet->getSheetByName('8 DP3A')->setCellValue('A' . $dp3aRow, $key + 1);
                $spreadsheet->getSheetByName('8 DP3A')->setCellValue('B' . $dp3aRow, $item->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('8 DP3A')->setCellValue('C' . $dp3aRow, $item->dpa);
                $spreadsheet->getSheetByName('8 DP3A')->setCellValue('D' . $dp3aRow, '=C' . $dp3aRow . '/$C$' . $disdik->count() + 11 . '*100');
                $spreadsheet->getSheetByName('8 DP3A')->setCellValue('E' . $dp3aRow, $item->rencana);
                $spreadsheet->getSheetByName('8 DP3A')->setCellValue('F' . $dp3aRow, '=E' . $dp3aRow . '/C' . $dp3aRow . '*100');
                $spreadsheet->getSheetByName('8 DP3A')->setCellValue('G' . $dp3aRow, '=F' . $dp3aRow . '*D' . $dp3aRow . '/100');
                $spreadsheet->getSheetByName('8 DP3A')->setCellValue('H' . $dp3aRow, $item->realisasi);
                $spreadsheet->getSheetByName('8 DP3A')->setCellValue('I' . $dp3aRow, '=H' . $dp3aRow . '/C' . $dp3aRow . '*100');
                $spreadsheet->getSheetByName('8 DP3A')->setCellValue('J' . $dp3aRow, '=I' . $dp3aRow . '*D' . $dp3aRow . '/100');
                $spreadsheet->getSheetByName('8 DP3A')->setCellValue('K' . $dp3aRow, '=IF(E' . $dp3aRow . '=0,0,H' . $dp3aRow . '/E' . $dp3aRow . '*100)');
                $spreadsheet->getSheetByName('8 DP3A')->setCellValue('L' . $dp3aRow, '=J' . $dp3aRow . '-G' . $dp3aRow);
                $spreadsheet->getSheetByName('8 DP3A')->setCellValue('M' . $dp3aRow, '=C' . $dp3aRow . '-H' . $dp3aRow);
                $spreadsheet->getSheetByName('8 DP3A')->setCellValue('N' . $dp3aRow, $item->rencana_fisik);
                $spreadsheet->getSheetByName('8 DP3A')->setCellValue('O' . $dp3aRow, '=N' . $dp3aRow . '*D' . $dp3aRow . '/100');
                $spreadsheet->getSheetByName('8 DP3A')->setCellValue('P' . $dp3aRow, $item->realisasi_fisik);
                $spreadsheet->getSheetByName('8 DP3A')->setCellValue('Q' . $dp3aRow, '=P' . $dp3aRow . '*D' . $dp3aRow . '/100');
                $spreadsheet->getSheetByName('8 DP3A')->setCellValue('R' . $dp3aRow, '=IF(N' . $dp3aRow . '=0,0,P' . $dp3aRow . '/N' . $dp3aRow . '*100)');
                $dp3aRow++;
            }
            $spreadsheet->getSheetByName('8 DP3A')->setCellValue('B' . $dp3a->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('8 DP3A')->setCellValue('C' . $dp3a->count() + 11, '=SUM(C11:C' . $dp3a->count() + 10 . ')');
            $spreadsheet->getSheetByName('8 DP3A')->setCellValue('D' . $dp3a->count() + 11, '=SUM(D11:D' . $dp3a->count() + 10 . ')');
            $spreadsheet->getSheetByName('8 DP3A')->setCellValue('E' . $dp3a->count() + 11, '=SUM(E11:E' . $dp3a->count() + 10 . ')');
            $spreadsheet->getSheetByName('8 DP3A')->setCellValue('F' . $dp3a->count() + 11, '=SUM(G11:G' . $dp3a->count() + 10 . ')');
            $spreadsheet->getSheetByName('8 DP3A')->setCellValue('G' . $dp3a->count() + 11, '=SUM(G11:G' . $dp3a->count() + 10 . ')');
            $spreadsheet->getSheetByName('8 DP3A')->setCellValue('H' . $dp3a->count() + 11, '=SUM(H11:H' . $dp3a->count() + 10 . ')');
            $spreadsheet->getSheetByName('8 DP3A')->setCellValue('I' . $dp3a->count() + 11, '=SUM(J11:J' . $dp3a->count() + 10 . ')');
            $spreadsheet->getSheetByName('8 DP3A')->setCellValue('J' . $dp3a->count() + 11, '=SUM(J11:J' . $dp3a->count() + 10 . ')');
            $spreadsheet->getSheetByName('8 DP3A')->setCellValue('K' . $dp3a->count() + 11, '=IF(E' . $dp3a->count() + 11 . '=0,0,H' . $dp3a->count() + 11 . '/E' . $dp3a->count() + 11 . '*100)');
            $spreadsheet->getSheetByName('8 DP3A')->setCellValue('L' . $dp3a->count() + 11, '=J' . $dp3a->count() + 11 . '-G' .  $dp3a->count() + 11);
            $spreadsheet->getSheetByName('8 DP3A')->setCellValue('M' . $dp3a->count() + 11, '=C' . $dp3a->count() + 11 . '-H' .  $dp3a->count() + 11);
            $spreadsheet->getSheetByName('8 DP3A')->setCellValue('N' . $dp3a->count() + 11, '=SUM(O11:O' . $dp3a->count() + 10 . ')');
            $spreadsheet->getSheetByName('8 DP3A')->setCellValue('O' . $dp3a->count() + 11, '=SUM(O11:O' . $dp3a->count() + 10 . ')');
            $spreadsheet->getSheetByName('8 DP3A')->setCellValue('P' . $dp3a->count() + 11, '=SUM(Q11:Q' . $dp3a->count() + 10 . ')');
            $spreadsheet->getSheetByName('8 DP3A')->setCellValue('Q' . $dp3a->count() + 11, '=SUM(Q11:Q' . $dp3a->count() + 10 . ')');
            $spreadsheet->getSheetByName('8 DP3A')->setCellValue('R' . $dp3a->count() + 11, '=IF(N' . $dp3a->count() + 11 . '=0,0,P' . $dp3a->count() + 11 . '/N' . $dp3a->count() + 11 . '*100)');
        }
        // dkp3
        $spreadsheet->getSheetByName('9 DKP3')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('9 DKP3')->setCellValue('A2', 'Dinas Ketahanan Pangan, Pertanian dan Perikanan');
        $spreadsheet->getSheetByName('9 DKP3')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('9 DKP3')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $spreadsheet->getSheetByName('9 DKP3')->insertNewRowBefore(12, $dkp3->count() - 1);
        $dkp3Row = 11;
        if ($dkp3->count() != 0) {
            foreach ($dkp3 as $key => $item) {
                $spreadsheet->getSheetByName('9 DKP3')->setCellValue('A' . $dkp3Row, $key + 1);
                $spreadsheet->getSheetByName('9 DKP3')->setCellValue('B' . $dkp3Row, $item->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('9 DKP3')->setCellValue('C' . $dkp3Row, $item->dpa);
                $spreadsheet->getSheetByName('9 DKP3')->setCellValue('D' . $dkp3Row, '=C' . $dkp3Row . '/$C$' . $disdik->count() + 11 . '*100');
                $spreadsheet->getSheetByName('9 DKP3')->setCellValue('E' . $dkp3Row, $item->rencana);
                $spreadsheet->getSheetByName('9 DKP3')->setCellValue('F' . $dkp3Row, '=E' . $dkp3Row . '/C' . $dkp3Row . '*100');
                $spreadsheet->getSheetByName('9 DKP3')->setCellValue('G' . $dkp3Row, '=F' . $dkp3Row . '*D' . $dkp3Row . '/100');
                $spreadsheet->getSheetByName('9 DKP3')->setCellValue('H' . $dkp3Row, $item->realisasi);
                $spreadsheet->getSheetByName('9 DKP3')->setCellValue('I' . $dkp3Row, '=H' . $dkp3Row . '/C' . $dkp3Row . '*100');
                $spreadsheet->getSheetByName('9 DKP3')->setCellValue('J' . $dkp3Row, '=I' . $dkp3Row . '*D' . $dkp3Row . '/100');
                $spreadsheet->getSheetByName('9 DKP3')->setCellValue('K' . $dkp3Row, '=IF(E' . $dkp3Row . '=0,0,H' . $dkp3Row . '/E' . $dkp3Row . '*100)');
                $spreadsheet->getSheetByName('9 DKP3')->setCellValue('L' . $dkp3Row, '=J' . $dkp3Row . '-G' . $dkp3Row);
                $spreadsheet->getSheetByName('9 DKP3')->setCellValue('M' . $dkp3Row, '=C' . $dkp3Row . '-H' . $dkp3Row);
                $spreadsheet->getSheetByName('9 DKP3')->setCellValue('N' . $dkp3Row, $item->rencana_fisik);
                $spreadsheet->getSheetByName('9 DKP3')->setCellValue('O' . $dkp3Row, '=N' . $dkp3Row . '*D' . $dkp3Row . '/100');
                $spreadsheet->getSheetByName('9 DKP3')->setCellValue('P' . $dkp3Row, $item->realisasi_fisik);
                $spreadsheet->getSheetByName('9 DKP3')->setCellValue('Q' . $dkp3Row, '=P' . $dkp3Row . '*D' . $dkp3Row . '/100');
                $spreadsheet->getSheetByName('9 DKP3')->setCellValue('R' . $dkp3Row, '=IF(N' . $dkp3Row . '=0,0,P' . $dkp3Row . '/N' . $dkp3Row . '*100)');
                $dkp3Row++;
            }
            $spreadsheet->getSheetByName('9 DKP3')->setCellValue('B' . $dkp3->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('9 DKP3')->setCellValue('C' . $dkp3->count() + 11, '=SUM(C11:C' . $dkp3->count() + 10 . ')');
            $spreadsheet->getSheetByName('9 DKP3')->setCellValue('D' . $dkp3->count() + 11, '=SUM(D11:D' . $dkp3->count() + 10 . ')');
            $spreadsheet->getSheetByName('9 DKP3')->setCellValue('E' . $dkp3->count() + 11, '=SUM(E11:E' . $dkp3->count() + 10 . ')');
            $spreadsheet->getSheetByName('9 DKP3')->setCellValue('F' . $dkp3->count() + 11, '=SUM(G11:G' . $dkp3->count() + 10 . ')');
            $spreadsheet->getSheetByName('9 DKP3')->setCellValue('G' . $dkp3->count() + 11, '=SUM(G11:G' . $dkp3->count() + 10 . ')');
            $spreadsheet->getSheetByName('9 DKP3')->setCellValue('H' . $dkp3->count() + 11, '=SUM(H11:H' . $dkp3->count() + 10 . ')');
            $spreadsheet->getSheetByName('9 DKP3')->setCellValue('I' . $dkp3->count() + 11, '=SUM(J11:J' . $dkp3->count() + 10 . ')');
            $spreadsheet->getSheetByName('9 DKP3')->setCellValue('J' . $dkp3->count() + 11, '=SUM(J11:J' . $dkp3->count() + 10 . ')');
            $spreadsheet->getSheetByName('9 DKP3')->setCellValue('K' . $dkp3->count() + 11, '=IF(E' . $dkp3->count() + 11 . '=0,0,H' . $dkp3->count() + 11 . '/E' . $dkp3->count() + 11 . '*100)');
            $spreadsheet->getSheetByName('9 DKP3')->setCellValue('L' . $dkp3->count() + 11, '=J' . $dkp3->count() + 11 . '-G' .  $dkp3->count() + 11);
            $spreadsheet->getSheetByName('9 DKP3')->setCellValue('M' . $dkp3->count() + 11, '=C' . $dkp3->count() + 11 . '-H' .  $dkp3->count() + 11);
            $spreadsheet->getSheetByName('9 DKP3')->setCellValue('N' . $dkp3->count() + 11, '=SUM(O11:O' . $dkp3->count() + 10 . ')');
            $spreadsheet->getSheetByName('9 DKP3')->setCellValue('O' . $dkp3->count() + 11, '=SUM(O11:O' . $dkp3->count() + 10 . ')');
            $spreadsheet->getSheetByName('9 DKP3')->setCellValue('P' . $dkp3->count() + 11, '=SUM(Q11:Q' . $dkp3->count() + 10 . ')');
            $spreadsheet->getSheetByName('9 DKP3')->setCellValue('Q' . $dkp3->count() + 11, '=SUM(Q11:Q' . $dkp3->count() + 10 . ')');
            $spreadsheet->getSheetByName('9 DKP3')->setCellValue('R' . $dkp3->count() + 11, '=IF(N' . $dkp3->count() + 11 . '=0,0,P' . $dkp3->count() + 11 . '/N' . $dkp3->count() + 11 . '*100)');
        }

        // dlh
        $spreadsheet->getSheetByName('10 DLH')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('10 DLH')->setCellValue('A2', 'Dinas Lingkungan Hidup');
        $spreadsheet->getSheetByName('10 DLH')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('10 DLH')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $spreadsheet->getSheetByName('10 DLH')->insertNewRowBefore(12, $dlh->count() - 1);
        $dlhRow = 11;
        if ($dlh->count() != 0) {
            foreach ($dlh as $key => $item) {
                $spreadsheet->getSheetByName('10 DLH')->setCellValue('A' . $dlhRow, $key + 1);
                $spreadsheet->getSheetByName('10 DLH')->setCellValue('B' . $dlhRow, $item->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('10 DLH')->setCellValue('C' . $dlhRow, $item->dpa);
                $spreadsheet->getSheetByName('10 DLH')->setCellValue('D' . $dlhRow, '=C' . $dlhRow . '/$C$' . $disdik->count() + 11 . '*100');
                $spreadsheet->getSheetByName('10 DLH')->setCellValue('E' . $dlhRow, $item->rencana);
                $spreadsheet->getSheetByName('10 DLH')->setCellValue('F' . $dlhRow, '=E' . $dlhRow . '/C' . $dlhRow . '*100');
                $spreadsheet->getSheetByName('10 DLH')->setCellValue('G' . $dlhRow, '=F' . $dlhRow . '*D' . $dlhRow . '/100');
                $spreadsheet->getSheetByName('10 DLH')->setCellValue('H' . $dlhRow, $item->realisasi);
                $spreadsheet->getSheetByName('10 DLH')->setCellValue('I' . $dlhRow, '=H' . $dlhRow . '/C' . $dlhRow . '*100');
                $spreadsheet->getSheetByName('10 DLH')->setCellValue('J' . $dlhRow, '=I' . $dlhRow . '*D' . $dlhRow . '/100');
                $spreadsheet->getSheetByName('10 DLH')->setCellValue('K' . $dlhRow, '=IF(E' . $dlhRow . '=0,0,H' . $dlhRow . '/E' . $dlhRow . '*100)');
                $spreadsheet->getSheetByName('10 DLH')->setCellValue('L' . $dlhRow, '=J' . $dlhRow . '-G' . $dlhRow);
                $spreadsheet->getSheetByName('10 DLH')->setCellValue('M' . $dlhRow, '=C' . $dlhRow . '-H' . $dlhRow);
                $spreadsheet->getSheetByName('10 DLH')->setCellValue('N' . $dlhRow, $item->rencana_fisik);
                $spreadsheet->getSheetByName('10 DLH')->setCellValue('O' . $dlhRow, '=N' . $dlhRow . '*D' . $dlhRow . '/100');
                $spreadsheet->getSheetByName('10 DLH')->setCellValue('P' . $dlhRow, $item->realisasi_fisik);
                $spreadsheet->getSheetByName('10 DLH')->setCellValue('Q' . $dlhRow, '=P' . $dlhRow . '*D' . $dlhRow . '/100');
                $spreadsheet->getSheetByName('10 DLH')->setCellValue('R' . $dlhRow, '=IF(N' . $dlhRow . '=0,0,P' . $dlhRow . '/N' . $dlhRow . '*100)');
                $dlhRow++;
            }
            $spreadsheet->getSheetByName('10 DLH')->setCellValue('B' . $dlh->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('10 DLH')->setCellValue('C' . $dlh->count() + 11, '=SUM(C11:C' . $dlh->count() + 10 . ')');
            $spreadsheet->getSheetByName('10 DLH')->setCellValue('D' . $dlh->count() + 11, '=SUM(D11:D' . $dlh->count() + 10 . ')');
            $spreadsheet->getSheetByName('10 DLH')->setCellValue('E' . $dlh->count() + 11, '=SUM(E11:E' . $dlh->count() + 10 . ')');
            $spreadsheet->getSheetByName('10 DLH')->setCellValue('F' . $dlh->count() + 11, '=SUM(G11:G' . $dlh->count() + 10 . ')');
            $spreadsheet->getSheetByName('10 DLH')->setCellValue('G' . $dlh->count() + 11, '=SUM(G11:G' . $dlh->count() + 10 . ')');
            $spreadsheet->getSheetByName('10 DLH')->setCellValue('H' . $dlh->count() + 11, '=SUM(H11:H' . $dlh->count() + 10 . ')');
            $spreadsheet->getSheetByName('10 DLH')->setCellValue('I' . $dlh->count() + 11, '=SUM(J11:J' . $dlh->count() + 10 . ')');
            $spreadsheet->getSheetByName('10 DLH')->setCellValue('J' . $dlh->count() + 11, '=SUM(J11:J' . $dlh->count() + 10 . ')');
            $spreadsheet->getSheetByName('10 DLH')->setCellValue('K' . $dlh->count() + 11, '=IF(E' . $dlh->count() + 11 . '=0,0,H' . $dlh->count() + 11 . '/E' . $dlh->count() + 11 . '*100)');
            $spreadsheet->getSheetByName('10 DLH')->setCellValue('L' . $dlh->count() + 11, '=J' . $dlh->count() + 11 . '-G' .  $dlh->count() + 11);
            $spreadsheet->getSheetByName('10 DLH')->setCellValue('M' . $dlh->count() + 11, '=C' . $dlh->count() + 11 . '-H' .  $dlh->count() + 11);
            $spreadsheet->getSheetByName('10 DLH')->setCellValue('N' . $dlh->count() + 11, '=SUM(O11:O' . $dlh->count() + 10 . ')');
            $spreadsheet->getSheetByName('10 DLH')->setCellValue('O' . $dlh->count() + 11, '=SUM(O11:O' . $dlh->count() + 10 . ')');
            $spreadsheet->getSheetByName('10 DLH')->setCellValue('P' . $dlh->count() + 11, '=SUM(Q11:Q' . $dlh->count() + 10 . ')');
            $spreadsheet->getSheetByName('10 DLH')->setCellValue('Q' . $dlh->count() + 11, '=SUM(Q11:Q' . $dlh->count() + 10 . ')');
            $spreadsheet->getSheetByName('10 DLH')->setCellValue('R' . $dlh->count() + 11, '=IF(N' . $dlh->count() + 11 . '=0,0,P' . $dlh->count() + 11 . '/N' . $dlh->count() + 11 . '*100)');
        }

        // capil
        $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('A2', 'Dinas Pencatatan Sipil');
        $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $spreadsheet->getSheetByName('11 CAPIL')->insertNewRowBefore(12, $capil->count() - 1);
        $capilRow = 11;
        if ($capil->count() != 0) {
            foreach ($capil as $key => $item) {
                $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('A' . $capilRow, $key + 1);
                $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('B' . $capilRow, $item->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('C' . $capilRow, $item->dpa);
                $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('D' . $capilRow, '=C' . $capilRow . '/$C$' . $disdik->count() + 11 . '*100');
                $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('E' . $capilRow, $item->rencana);
                $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('F' . $capilRow, '=E' . $capilRow . '/C' . $capilRow . '*100');
                $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('G' . $capilRow, '=F' . $capilRow . '*D' . $capilRow . '/100');
                $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('H' . $capilRow, $item->realisasi);
                $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('I' . $capilRow, '=H' . $capilRow . '/C' . $capilRow . '*100');
                $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('J' . $capilRow, '=I' . $capilRow . '*D' . $capilRow . '/100');
                $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('K' . $capilRow, '=IF(E' . $capilRow . '=0,0,H' . $capilRow . '/E' . $capilRow . '*100)');
                $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('L' . $capilRow, '=J' . $capilRow . '-G' . $capilRow);
                $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('M' . $capilRow, '=C' . $capilRow . '-H' . $capilRow);
                $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('N' . $capilRow, $item->rencana_fisik);
                $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('O' . $capilRow, '=N' . $capilRow . '*D' . $capilRow . '/100');
                $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('P' . $capilRow, $item->realisasi_fisik);
                $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('Q' . $capilRow, '=P' . $capilRow . '*D' . $capilRow . '/100');
                $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('R' . $capilRow, '=IF(N' . $capilRow . '=0,0,P' . $capilRow . '/N' . $capilRow . '*100)');
                $capilRow++;
            }
            $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('B' . $capil->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('C' . $capil->count() + 11, '=SUM(C11:C' . $capil->count() + 10 . ')');
            $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('D' . $capil->count() + 11, '=SUM(D11:D' . $capil->count() + 10 . ')');
            $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('E' . $capil->count() + 11, '=SUM(E11:E' . $capil->count() + 10 . ')');
            $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('F' . $capil->count() + 11, '=SUM(G11:G' . $capil->count() + 10 . ')');
            $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('G' . $capil->count() + 11, '=SUM(G11:G' . $capil->count() + 10 . ')');
            $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('H' . $capil->count() + 11, '=SUM(H11:H' . $capil->count() + 10 . ')');
            $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('I' . $capil->count() + 11, '=SUM(J11:J' . $capil->count() + 10 . ')');
            $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('J' . $capil->count() + 11, '=SUM(J11:J' . $capil->count() + 10 . ')');
            $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('K' . $capil->count() + 11, '=IF(E' . $capil->count() + 11 . '=0,0,H' . $capil->count() + 11 . '/E' . $capil->count() + 11 . '*100)');
            $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('L' . $capil->count() + 11, '=J' . $capil->count() + 11 . '-G' .  $capil->count() + 11);
            $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('M' . $capil->count() + 11, '=C' . $capil->count() + 11 . '-H' .  $capil->count() + 11);
            $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('N' . $capil->count() + 11, '=SUM(O11:O' . $capil->count() + 10 . ')');
            $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('O' . $capil->count() + 11, '=SUM(O11:O' . $capil->count() + 10 . ')');
            $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('P' . $capil->count() + 11, '=SUM(Q11:Q' . $capil->count() + 10 . ')');
            $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('Q' . $capil->count() + 11, '=SUM(Q11:Q' . $capil->count() + 10 . ')');
            $spreadsheet->getSheetByName('11 CAPIL')->setCellValue('R' . $capil->count() + 11, '=IF(N' . $capil->count() + 11 . '=0,0,P' . $capil->count() + 11 . '/N' . $capil->count() + 11 . '*100)');
        }
        // dppkbpm
        $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('A2', 'Dinas Pengendalian Penduduk, Keluarga Berencana, dan Pemberdayaan Masyarakat');
        $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $spreadsheet->getSheetByName('12 DPPKBPM')->insertNewRowBefore(12, $dppkbpm->count() - 1);
        $dppkbpmRow = 11;
        if ($dppkbpm->count() != 0) {
            foreach ($dppkbpm as $key => $item) {
                $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('A' . $dppkbpmRow, $key + 1);
                $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('B' . $dppkbpmRow, $item->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('C' . $dppkbpmRow, $item->dpa);
                $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('D' . $dppkbpmRow, '=C' . $dppkbpmRow . '/$C$' . $disdik->count() + 11 . '*100');
                $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('E' . $dppkbpmRow, $item->rencana);
                $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('F' . $dppkbpmRow, '=E' . $dppkbpmRow . '/C' . $dppkbpmRow . '*100');
                $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('G' . $dppkbpmRow, '=F' . $dppkbpmRow . '*D' . $dppkbpmRow . '/100');
                $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('H' . $dppkbpmRow, $item->realisasi);
                $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('I' . $dppkbpmRow, '=H' . $dppkbpmRow . '/C' . $dppkbpmRow . '*100');
                $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('J' . $dppkbpmRow, '=I' . $dppkbpmRow . '*D' . $dppkbpmRow . '/100');
                $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('K' . $dppkbpmRow, '=IF(E' . $dppkbpmRow . '=0,0,H' . $dppkbpmRow . '/E' . $dppkbpmRow . '*100)');
                $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('L' . $dppkbpmRow, '=J' . $dppkbpmRow . '-G' . $dppkbpmRow);
                $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('M' . $dppkbpmRow, '=C' . $dppkbpmRow . '-H' . $dppkbpmRow);
                $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('N' . $dppkbpmRow, $item->rencana_fisik);
                $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('O' . $dppkbpmRow, '=N' . $dppkbpmRow . '*D' . $dppkbpmRow . '/100');
                $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('P' . $dppkbpmRow, $item->realisasi_fisik);
                $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('Q' . $dppkbpmRow, '=P' . $dppkbpmRow . '*D' . $dppkbpmRow . '/100');
                $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('R' . $dppkbpmRow, '=IF(N' . $dppkbpmRow . '=0,0,P' . $dppkbpmRow . '/N' . $dppkbpmRow . '*100)');
                $dppkbpmRow++;
            }
            $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('B' . $dppkbpm->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('C' . $dppkbpm->count() + 11, '=SUM(C11:C' . $dppkbpm->count() + 10 . ')');
            $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('D' . $dppkbpm->count() + 11, '=SUM(D11:D' . $dppkbpm->count() + 10 . ')');
            $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('E' . $dppkbpm->count() + 11, '=SUM(E11:E' . $dppkbpm->count() + 10 . ')');
            $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('F' . $dppkbpm->count() + 11, '=SUM(G11:G' . $dppkbpm->count() + 10 . ')');
            $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('G' . $dppkbpm->count() + 11, '=SUM(G11:G' . $dppkbpm->count() + 10 . ')');
            $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('H' . $dppkbpm->count() + 11, '=SUM(H11:H' . $dppkbpm->count() + 10 . ')');
            $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('I' . $dppkbpm->count() + 11, '=SUM(J11:J' . $dppkbpm->count() + 10 . ')');
            $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('J' . $dppkbpm->count() + 11, '=SUM(J11:J' . $dppkbpm->count() + 10 . ')');
            $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('K' . $dppkbpm->count() + 11, '=IF(E' . $dppkbpm->count() + 11 . '=0,0,H' . $dppkbpm->count() + 11 . '/E' . $dppkbpm->count() + 11 . '*100)');
            $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('L' . $dppkbpm->count() + 11, '=J' . $dppkbpm->count() + 11 . '-G' .  $dppkbpm->count() + 11);
            $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('M' . $dppkbpm->count() + 11, '=C' . $dppkbpm->count() + 11 . '-H' .  $dppkbpm->count() + 11);
            $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('N' . $dppkbpm->count() + 11, '=SUM(O11:O' . $dppkbpm->count() + 10 . ')');
            $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('O' . $dppkbpm->count() + 11, '=SUM(O11:O' . $dppkbpm->count() + 10 . ')');
            $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('P' . $dppkbpm->count() + 11, '=SUM(Q11:Q' . $dppkbpm->count() + 10 . ')');
            $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('Q' . $dppkbpm->count() + 11, '=SUM(Q11:Q' . $dppkbpm->count() + 10 . ')');
            $spreadsheet->getSheetByName('12 DPPKBPM')->setCellValue('R' . $dppkbpm->count() + 11, '=IF(N' . $dppkbpm->count() + 11 . '=0,0,P' . $dppkbpm->count() + 11 . '/N' . $dppkbpm->count() + 11 . '*100)');
        }

        // dishub
        $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('A2', 'Dinas Perhubungan');
        $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $spreadsheet->getSheetByName('13 DISHUB')->insertNewRowBefore(12, $dishub->count() - 1);
        $dishubRow = 11;
        if ($dishub->count() != 0) {
            foreach ($dishub as $key => $item) {
                $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('A' . $dishubRow, $key + 1);
                $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('B' . $dishubRow, $item->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('C' . $dishubRow, $item->dpa);
                $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('D' . $dishubRow, '=C' . $dishubRow . '/$C$' . $disdik->count() + 11 . '*100');
                $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('E' . $dishubRow, $item->rencana);
                $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('F' . $dishubRow, '=E' . $dishubRow . '/C' . $dishubRow . '*100');
                $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('G' . $dishubRow, '=F' . $dishubRow . '*D' . $dishubRow . '/100');
                $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('H' . $dishubRow, $item->realisasi);
                $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('I' . $dishubRow, '=H' . $dishubRow . '/C' . $dishubRow . '*100');
                $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('J' . $dishubRow, '=I' . $dishubRow . '*D' . $dishubRow . '/100');
                $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('K' . $dishubRow, '=IF(E' . $dishubRow . '=0,0,H' . $dishubRow . '/E' . $dishubRow . '*100)');
                $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('L' . $dishubRow, '=J' . $dishubRow . '-G' . $dishubRow);
                $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('M' . $dishubRow, '=C' . $dishubRow . '-H' . $dishubRow);
                $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('N' . $dishubRow, $item->rencana_fisik);
                $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('O' . $dishubRow, '=N' . $dishubRow . '*D' . $dishubRow . '/100');
                $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('P' . $dishubRow, $item->realisasi_fisik);
                $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('Q' . $dishubRow, '=P' . $dishubRow . '*D' . $dishubRow . '/100');
                $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('R' . $dishubRow, '=IF(N' . $dishubRow . '=0,0,P' . $dishubRow . '/N' . $dishubRow . '*100)');
                $dishubRow++;
            }
            $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('B' . $dishub->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('C' . $dishub->count() + 11, '=SUM(C11:C' . $dishub->count() + 10 . ')');
            $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('D' . $dishub->count() + 11, '=SUM(D11:D' . $dishub->count() + 10 . ')');
            $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('E' . $dishub->count() + 11, '=SUM(E11:E' . $dishub->count() + 10 . ')');
            $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('F' . $dishub->count() + 11, '=SUM(G11:G' . $dishub->count() + 10 . ')');
            $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('G' . $dishub->count() + 11, '=SUM(G11:G' . $dishub->count() + 10 . ')');
            $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('H' . $dishub->count() + 11, '=SUM(H11:H' . $dishub->count() + 10 . ')');
            $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('I' . $dishub->count() + 11, '=SUM(J11:J' . $dishub->count() + 10 . ')');
            $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('J' . $dishub->count() + 11, '=SUM(J11:J' . $dishub->count() + 10 . ')');
            $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('K' . $dishub->count() + 11, '=IF(E' . $dishub->count() + 11 . '=0,0,H' . $dishub->count() + 11 . '/E' . $dishub->count() + 11 . '*100)');
            $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('L' . $dishub->count() + 11, '=J' . $dishub->count() + 11 . '-G' .  $dishub->count() + 11);
            $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('M' . $dishub->count() + 11, '=C' . $dishub->count() + 11 . '-H' .  $dishub->count() + 11);
            $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('N' . $dishub->count() + 11, '=SUM(O11:O' . $dishub->count() + 10 . ')');
            $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('O' . $dishub->count() + 11, '=SUM(O11:O' . $dishub->count() + 10 . ')');
            $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('P' . $dishub->count() + 11, '=SUM(Q11:Q' . $dishub->count() + 10 . ')');
            $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('Q' . $dishub->count() + 11, '=SUM(Q11:Q' . $dishub->count() + 10 . ')');
            $spreadsheet->getSheetByName('13 DISHUB')->setCellValue('R' . $dishub->count() + 11, '=IF(N' . $dishub->count() + 11 . '=0,0,P' . $dishub->count() + 11 . '/N' . $dishub->count() + 11 . '*100)');
        }
        // diskominfotik
        $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('A2', 'Dinas Komunikasi, Informatika dan Statistik');
        $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->insertNewRowBefore(12, $diskominfotik->count() - 1);
        $diskominfotikRow = 11;
        if ($diskominfotik->count() != 0) {
            foreach ($diskominfotik as $key => $item) {
                $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('A' . $diskominfotikRow, $key + 1);
                $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('B' . $diskominfotikRow, $item->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('C' . $diskominfotikRow, $item->dpa);
                $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('D' . $diskominfotikRow, '=C' . $diskominfotikRow . '/$C$' . $disdik->count() + 11 . '*100');
                $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('E' . $diskominfotikRow, $item->rencana);
                $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('F' . $diskominfotikRow, '=E' . $diskominfotikRow . '/C' . $diskominfotikRow . '*100');
                $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('G' . $diskominfotikRow, '=F' . $diskominfotikRow . '*D' . $diskominfotikRow . '/100');
                $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('H' . $diskominfotikRow, $item->realisasi);
                $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('I' . $diskominfotikRow, '=H' . $diskominfotikRow . '/C' . $diskominfotikRow . '*100');
                $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('J' . $diskominfotikRow, '=I' . $diskominfotikRow . '*D' . $diskominfotikRow . '/100');
                $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('K' . $diskominfotikRow, '=IF(E' . $diskominfotikRow . '=0,0,H' . $diskominfotikRow . '/E' . $diskominfotikRow . '*100)');
                $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('L' . $diskominfotikRow, '=J' . $diskominfotikRow . '-G' . $diskominfotikRow);
                $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('M' . $diskominfotikRow, '=C' . $diskominfotikRow . '-H' . $diskominfotikRow);
                $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('N' . $diskominfotikRow, $item->rencana_fisik);
                $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('O' . $diskominfotikRow, '=N' . $diskominfotikRow . '*D' . $diskominfotikRow . '/100');
                $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('P' . $diskominfotikRow, $item->realisasi_fisik);
                $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('Q' . $diskominfotikRow, '=P' . $diskominfotikRow . '*D' . $diskominfotikRow . '/100');
                $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('R' . $diskominfotikRow, '=IF(N' . $diskominfotikRow . '=0,0,P' . $diskominfotikRow . '/N' . $diskominfotikRow . '*100)');
                $diskominfotikRow++;
            }
            $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('B' . $diskominfotik->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('C' . $diskominfotik->count() + 11, '=SUM(C11:C' . $diskominfotik->count() + 10 . ')');
            $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('D' . $diskominfotik->count() + 11, '=SUM(D11:D' . $diskominfotik->count() + 10 . ')');
            $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('E' . $diskominfotik->count() + 11, '=SUM(E11:E' . $diskominfotik->count() + 10 . ')');
            $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('F' . $diskominfotik->count() + 11, '=SUM(G11:G' . $diskominfotik->count() + 10 . ')');
            $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('G' . $diskominfotik->count() + 11, '=SUM(G11:G' . $diskominfotik->count() + 10 . ')');
            $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('H' . $diskominfotik->count() + 11, '=SUM(H11:H' . $diskominfotik->count() + 10 . ')');
            $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('I' . $diskominfotik->count() + 11, '=SUM(J11:J' . $diskominfotik->count() + 10 . ')');
            $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('J' . $diskominfotik->count() + 11, '=SUM(J11:J' . $diskominfotik->count() + 10 . ')');
            $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('K' . $diskominfotik->count() + 11, '=IF(E' . $diskominfotik->count() + 11 . '=0,0,H' . $diskominfotik->count() + 11 . '/E' . $diskominfotik->count() + 11 . '*100)');
            $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('L' . $diskominfotik->count() + 11, '=J' . $diskominfotik->count() + 11 . '-G' .  $diskominfotik->count() + 11);
            $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('M' . $diskominfotik->count() + 11, '=C' . $diskominfotik->count() + 11 . '-H' .  $diskominfotik->count() + 11);
            $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('N' . $diskominfotik->count() + 11, '=SUM(O11:O' . $diskominfotik->count() + 10 . ')');
            $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('O' . $diskominfotik->count() + 11, '=SUM(O11:O' . $diskominfotik->count() + 10 . ')');
            $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('P' . $diskominfotik->count() + 11, '=SUM(Q11:Q' . $diskominfotik->count() + 10 . ')');
            $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('Q' . $diskominfotik->count() + 11, '=SUM(Q11:Q' . $diskominfotik->count() + 10 . ')');
            $spreadsheet->getSheetByName('14 DISKOMINFOTIK')->setCellValue('R' . $diskominfotik->count() + 11, '=IF(N' . $diskominfotik->count() + 11 . '=0,0,P' . $diskominfotik->count() + 11 . '/N' . $diskominfotik->count() + 11 . '*100)');
        }
        // diskopumker
        $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('A2', 'Dinas Koperasi, Usaha Mikro dan Tenaga Kerja');
        $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $spreadsheet->getSheetByName('15 DISKOPUMKER')->insertNewRowBefore(12, $diskopumker->count() - 1);
        $diskopumkerRow = 11;
        if ($diskopumker->count() != 0) {
            foreach ($diskopumker as $key => $item) {
                $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('A' . $diskopumkerRow, $key + 1);
                $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('B' . $diskopumkerRow, $item->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('C' . $diskopumkerRow, $item->dpa);
                $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('D' . $diskopumkerRow, '=C' . $diskopumkerRow . '/$C$' . $disdik->count() + 11 . '*100');
                $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('E' . $diskopumkerRow, $item->rencana);
                $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('F' . $diskopumkerRow, '=E' . $diskopumkerRow . '/C' . $diskopumkerRow . '*100');
                $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('G' . $diskopumkerRow, '=F' . $diskopumkerRow . '*D' . $diskopumkerRow . '/100');
                $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('H' . $diskopumkerRow, $item->realisasi);
                $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('I' . $diskopumkerRow, '=H' . $diskopumkerRow . '/C' . $diskopumkerRow . '*100');
                $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('J' . $diskopumkerRow, '=I' . $diskopumkerRow . '*D' . $diskopumkerRow . '/100');
                $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('K' . $diskopumkerRow, '=IF(E' . $diskopumkerRow . '=0,0,H' . $diskopumkerRow . '/E' . $diskopumkerRow . '*100)');
                $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('L' . $diskopumkerRow, '=J' . $diskopumkerRow . '-G' . $diskopumkerRow);
                $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('M' . $diskopumkerRow, '=C' . $diskopumkerRow . '-H' . $diskopumkerRow);
                $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('N' . $diskopumkerRow, $item->rencana_fisik);
                $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('O' . $diskopumkerRow, '=N' . $diskopumkerRow . '*D' . $diskopumkerRow . '/100');
                $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('P' . $diskopumkerRow, $item->realisasi_fisik);
                $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('Q' . $diskopumkerRow, '=P' . $diskopumkerRow . '*D' . $diskopumkerRow . '/100');
                $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('R' . $diskopumkerRow, '=IF(N' . $diskopumkerRow . '=0,0,P' . $diskopumkerRow . '/N' . $diskopumkerRow . '*100)');
                $diskopumkerRow++;
            }
            $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('B' . $diskopumker->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('C' . $diskopumker->count() + 11, '=SUM(C11:C' . $diskopumker->count() + 10 . ')');
            $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('D' . $diskopumker->count() + 11, '=SUM(D11:D' . $diskopumker->count() + 10 . ')');
            $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('E' . $diskopumker->count() + 11, '=SUM(E11:E' . $diskopumker->count() + 10 . ')');
            $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('F' . $diskopumker->count() + 11, '=SUM(G11:G' . $diskopumker->count() + 10 . ')');
            $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('G' . $diskopumker->count() + 11, '=SUM(G11:G' . $diskopumker->count() + 10 . ')');
            $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('H' . $diskopumker->count() + 11, '=SUM(H11:H' . $diskopumker->count() + 10 . ')');
            $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('I' . $diskopumker->count() + 11, '=SUM(J11:J' . $diskopumker->count() + 10 . ')');
            $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('J' . $diskopumker->count() + 11, '=SUM(J11:J' . $diskopumker->count() + 10 . ')');
            $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('K' . $diskopumker->count() + 11, '=IF(E' . $diskopumker->count() + 11 . '=0,0,H' . $diskopumker->count() + 11 . '/E' . $diskopumker->count() + 11 . '*100)');
            $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('L' . $diskopumker->count() + 11, '=J' . $diskopumker->count() + 11 . '-G' .  $diskopumker->count() + 11);
            $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('M' . $diskopumker->count() + 11, '=C' . $diskopumker->count() + 11 . '-H' .  $diskopumker->count() + 11);
            $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('N' . $diskopumker->count() + 11, '=SUM(O11:O' . $diskopumker->count() + 10 . ')');
            $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('O' . $diskopumker->count() + 11, '=SUM(O11:O' . $diskopumker->count() + 10 . ')');
            $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('P' . $diskopumker->count() + 11, '=SUM(Q11:Q' . $diskopumker->count() + 10 . ')');
            $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('Q' . $diskopumker->count() + 11, '=SUM(Q11:Q' . $diskopumker->count() + 10 . ')');
            $spreadsheet->getSheetByName('15 DISKOPUMKER')->setCellValue('R' . $diskopumker->count() + 11, '=IF(N' . $diskopumker->count() + 11 . '=0,0,P' . $diskopumker->count() + 11 . '/N' . $diskopumker->count() + 11 . '*100)');
        }

        // dpmptsp
        $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('A2', 'Dinas Penamaan Modal dan Pelayanan Terpadu Satu Pintu');
        $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $spreadsheet->getSheetByName('16 DPMPTSP')->insertNewRowBefore(12, $dpmptsp->count() - 1);
        $dpmptspRow = 11;
        if ($dpmptsp->count() != 0) {
            foreach ($dpmptsp as $key => $item) {
                $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('A' . $dpmptspRow, $key + 1);
                $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('B' . $dpmptspRow, $item->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('C' . $dpmptspRow, $item->dpa);
                $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('D' . $dpmptspRow, '=C' . $dpmptspRow . '/$C$' . $disdik->count() + 11 . '*100');
                $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('E' . $dpmptspRow, $item->rencana);
                $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('F' . $dpmptspRow, '=E' . $dpmptspRow . '/C' . $dpmptspRow . '*100');
                $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('G' . $dpmptspRow, '=F' . $dpmptspRow . '*D' . $dpmptspRow . '/100');
                $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('H' . $dpmptspRow, $item->realisasi);
                $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('I' . $dpmptspRow, '=H' . $dpmptspRow . '/C' . $dpmptspRow . '*100');
                $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('J' . $dpmptspRow, '=I' . $dpmptspRow . '*D' . $dpmptspRow . '/100');
                $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('K' . $dpmptspRow, '=IF(E' . $dpmptspRow . '=0,0,H' . $dpmptspRow . '/E' . $dpmptspRow . '*100)');
                $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('L' . $dpmptspRow, '=J' . $dpmptspRow . '-G' . $dpmptspRow);
                $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('M' . $dpmptspRow, '=C' . $dpmptspRow . '-H' . $dpmptspRow);
                $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('N' . $dpmptspRow, $item->rencana_fisik);
                $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('O' . $dpmptspRow, '=N' . $dpmptspRow . '*D' . $dpmptspRow . '/100');
                $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('P' . $dpmptspRow, $item->realisasi_fisik);
                $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('Q' . $dpmptspRow, '=P' . $dpmptspRow . '*D' . $dpmptspRow . '/100');
                $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('R' . $dpmptspRow, '=IF(N' . $dpmptspRow . '=0,0,P' . $dpmptspRow . '/N' . $dpmptspRow . '*100)');
                $dpmptspRow++;
            }
            $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('B' . $dpmptsp->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('C' . $dpmptsp->count() + 11, '=SUM(C11:C' . $dpmptsp->count() + 10 . ')');
            $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('D' . $dpmptsp->count() + 11, '=SUM(D11:D' . $dpmptsp->count() + 10 . ')');
            $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('E' . $dpmptsp->count() + 11, '=SUM(E11:E' . $dpmptsp->count() + 10 . ')');
            $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('F' . $dpmptsp->count() + 11, '=SUM(G11:G' . $dpmptsp->count() + 10 . ')');
            $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('G' . $dpmptsp->count() + 11, '=SUM(G11:G' . $dpmptsp->count() + 10 . ')');
            $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('H' . $dpmptsp->count() + 11, '=SUM(H11:H' . $dpmptsp->count() + 10 . ')');
            $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('I' . $dpmptsp->count() + 11, '=SUM(J11:J' . $dpmptsp->count() + 10 . ')');
            $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('J' . $dpmptsp->count() + 11, '=SUM(J11:J' . $dpmptsp->count() + 10 . ')');
            $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('K' . $dpmptsp->count() + 11, '=IF(E' . $dpmptsp->count() + 11 . '=0,0,H' . $dpmptsp->count() + 11 . '/E' . $dpmptsp->count() + 11 . '*100)');
            $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('L' . $dpmptsp->count() + 11, '=J' . $dpmptsp->count() + 11 . '-G' .  $dpmptsp->count() + 11);
            $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('M' . $dpmptsp->count() + 11, '=C' . $dpmptsp->count() + 11 . '-H' .  $dpmptsp->count() + 11);
            $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('N' . $dpmptsp->count() + 11, '=SUM(O11:O' . $dpmptsp->count() + 10 . ')');
            $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('O' . $dpmptsp->count() + 11, '=SUM(O11:O' . $dpmptsp->count() + 10 . ')');
            $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('P' . $dpmptsp->count() + 11, '=SUM(Q11:Q' . $dpmptsp->count() + 10 . ')');
            $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('Q' . $dpmptsp->count() + 11, '=SUM(Q11:Q' . $dpmptsp->count() + 10 . ')');
            $spreadsheet->getSheetByName('16 DPMPTSP')->setCellValue('R' . $dpmptsp->count() + 11, '=IF(N' . $dpmptsp->count() + 11 . '=0,0,P' . $dpmptsp->count() + 11 . '/N' . $dpmptsp->count() + 11 . '*100)');
        }

        // disbudporapar
        $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('A2', 'Dinas Kebudayaan, Kepemudaan, Olahraga dan Pariwisata Kota Banjarmasin');
        $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $spreadsheet->getSheetByName('17 Disbudporapar')->insertNewRowBefore(12, $disbudporapar->count() - 1);
        $disbudporaparRow = 11;
        if ($disbudporapar->count() != 0) {
            foreach ($disbudporapar as $key => $item) {
                $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('A' . $disbudporaparRow, $key + 1);
                $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('B' . $disbudporaparRow, $item->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('C' . $disbudporaparRow, $item->dpa);
                $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('D' . $disbudporaparRow, '=C' . $disbudporaparRow . '/$C$' . $disdik->count() + 11 . '*100');
                $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('E' . $disbudporaparRow, $item->rencana);
                $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('F' . $disbudporaparRow, '=E' . $disbudporaparRow . '/C' . $disbudporaparRow . '*100');
                $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('G' . $disbudporaparRow, '=F' . $disbudporaparRow . '*D' . $disbudporaparRow . '/100');
                $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('H' . $disbudporaparRow, $item->realisasi);
                $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('I' . $disbudporaparRow, '=H' . $disbudporaparRow . '/C' . $disbudporaparRow . '*100');
                $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('J' . $disbudporaparRow, '=I' . $disbudporaparRow . '*D' . $disbudporaparRow . '/100');
                $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('K' . $disbudporaparRow, '=IF(E' . $disbudporaparRow . '=0,0,H' . $disbudporaparRow . '/E' . $disbudporaparRow . '*100)');
                $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('L' . $disbudporaparRow, '=J' . $disbudporaparRow . '-G' . $disbudporaparRow);
                $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('M' . $disbudporaparRow, '=C' . $disbudporaparRow . '-H' . $disbudporaparRow);
                $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('N' . $disbudporaparRow, $item->rencana_fisik);
                $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('O' . $disbudporaparRow, '=N' . $disbudporaparRow . '*D' . $disbudporaparRow . '/100');
                $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('P' . $disbudporaparRow, $item->realisasi_fisik);
                $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('Q' . $disbudporaparRow, '=P' . $disbudporaparRow . '*D' . $disbudporaparRow . '/100');
                $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('R' . $disbudporaparRow, '=IF(N' . $disbudporaparRow . '=0,0,P' . $disbudporaparRow . '/N' . $disbudporaparRow . '*100)');
                $disbudporaparRow++;
            }
            $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('B' . $disbudporapar->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('C' . $disbudporapar->count() + 11, '=SUM(C11:C' . $disbudporapar->count() + 10 . ')');
            $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('D' . $disbudporapar->count() + 11, '=SUM(D11:D' . $disbudporapar->count() + 10 . ')');
            $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('E' . $disbudporapar->count() + 11, '=SUM(E11:E' . $disbudporapar->count() + 10 . ')');
            $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('F' . $disbudporapar->count() + 11, '=SUM(G11:G' . $disbudporapar->count() + 10 . ')');
            $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('G' . $disbudporapar->count() + 11, '=SUM(G11:G' . $disbudporapar->count() + 10 . ')');
            $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('H' . $disbudporapar->count() + 11, '=SUM(H11:H' . $disbudporapar->count() + 10 . ')');
            $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('I' . $disbudporapar->count() + 11, '=SUM(J11:J' . $disbudporapar->count() + 10 . ')');
            $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('J' . $disbudporapar->count() + 11, '=SUM(J11:J' . $disbudporapar->count() + 10 . ')');
            $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('K' . $disbudporapar->count() + 11, '=IF(E' . $disbudporapar->count() + 11 . '=0,0,H' . $disbudporapar->count() + 11 . '/E' . $disbudporapar->count() + 11 . '*100)');
            $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('L' . $disbudporapar->count() + 11, '=J' . $disbudporapar->count() + 11 . '-G' .  $disbudporapar->count() + 11);
            $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('M' . $disbudporapar->count() + 11, '=C' . $disbudporapar->count() + 11 . '-H' .  $disbudporapar->count() + 11);
            $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('N' . $disbudporapar->count() + 11, '=SUM(O11:O' . $disbudporapar->count() + 10 . ')');
            $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('O' . $disbudporapar->count() + 11, '=SUM(O11:O' . $disbudporapar->count() + 10 . ')');
            $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('P' . $disbudporapar->count() + 11, '=SUM(Q11:Q' . $disbudporapar->count() + 10 . ')');
            $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('Q' . $disbudporapar->count() + 11, '=SUM(Q11:Q' . $disbudporapar->count() + 10 . ')');
            $spreadsheet->getSheetByName('17 Disbudporapar')->setCellValue('R' . $disbudporapar->count() + 11, '=IF(N' . $disbudporapar->count() + 11 . '=0,0,P' . $disbudporapar->count() + 11 . '/N' . $disbudporapar->count() + 11 . '*100)');
        }

        // dpa
        $spreadsheet->getSheetByName('18 DPA')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('18 DPA')->setCellValue('A2', 'Dinas Penamaan Modal dan Pelayanan Terpadu Satu Pintu');
        $spreadsheet->getSheetByName('18 DPA')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('18 DPA')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $spreadsheet->getSheetByName('18 DPA')->insertNewRowBefore(12, $dpa->count() - 1);
        $dpaRow = 11;
        if ($dpa->count() != 0) {
            foreach ($dpa as $key => $item) {
                $spreadsheet->getSheetByName('18 DPA')->setCellValue('A' . $dpaRow, $key + 1);
                $spreadsheet->getSheetByName('18 DPA')->setCellValue('B' . $dpaRow, $item->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('18 DPA')->setCellValue('C' . $dpaRow, $item->dpa);
                $spreadsheet->getSheetByName('18 DPA')->setCellValue('D' . $dpaRow, '=C' . $dpaRow . '/$C$' . $disdik->count() + 11 . '*100');
                $spreadsheet->getSheetByName('18 DPA')->setCellValue('E' . $dpaRow, $item->rencana);
                $spreadsheet->getSheetByName('18 DPA')->setCellValue('F' . $dpaRow, '=E' . $dpaRow . '/C' . $dpaRow . '*100');
                $spreadsheet->getSheetByName('18 DPA')->setCellValue('G' . $dpaRow, '=F' . $dpaRow . '*D' . $dpaRow . '/100');
                $spreadsheet->getSheetByName('18 DPA')->setCellValue('H' . $dpaRow, $item->realisasi);
                $spreadsheet->getSheetByName('18 DPA')->setCellValue('I' . $dpaRow, '=H' . $dpaRow . '/C' . $dpaRow . '*100');
                $spreadsheet->getSheetByName('18 DPA')->setCellValue('J' . $dpaRow, '=I' . $dpaRow . '*D' . $dpaRow . '/100');
                $spreadsheet->getSheetByName('18 DPA')->setCellValue('K' . $dpaRow, '=IF(E' . $dpaRow . '=0,0,H' . $dpaRow . '/E' . $dpaRow . '*100)');
                $spreadsheet->getSheetByName('18 DPA')->setCellValue('L' . $dpaRow, '=J' . $dpaRow . '-G' . $dpaRow);
                $spreadsheet->getSheetByName('18 DPA')->setCellValue('M' . $dpaRow, '=C' . $dpaRow . '-H' . $dpaRow);
                $spreadsheet->getSheetByName('18 DPA')->setCellValue('N' . $dpaRow, $item->rencana_fisik);
                $spreadsheet->getSheetByName('18 DPA')->setCellValue('O' . $dpaRow, '=N' . $dpaRow . '*D' . $dpaRow . '/100');
                $spreadsheet->getSheetByName('18 DPA')->setCellValue('P' . $dpaRow, $item->realisasi_fisik);
                $spreadsheet->getSheetByName('18 DPA')->setCellValue('Q' . $dpaRow, '=P' . $dpaRow . '*D' . $dpaRow . '/100');
                $spreadsheet->getSheetByName('18 DPA')->setCellValue('R' . $dpaRow, '=IF(N' . $dpaRow . '=0,0,P' . $dpaRow . '/N' . $dpaRow . '*100)');
                $dpaRow++;
            }
            $spreadsheet->getSheetByName('18 DPA')->setCellValue('B' . $dpa->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('18 DPA')->setCellValue('C' . $dpa->count() + 11, '=SUM(C11:C' . $dpa->count() + 10 . ')');
            $spreadsheet->getSheetByName('18 DPA')->setCellValue('D' . $dpa->count() + 11, '=SUM(D11:D' . $dpa->count() + 10 . ')');
            $spreadsheet->getSheetByName('18 DPA')->setCellValue('E' . $dpa->count() + 11, '=SUM(E11:E' . $dpa->count() + 10 . ')');
            $spreadsheet->getSheetByName('18 DPA')->setCellValue('F' . $dpa->count() + 11, '=SUM(G11:G' . $dpa->count() + 10 . ')');
            $spreadsheet->getSheetByName('18 DPA')->setCellValue('G' . $dpa->count() + 11, '=SUM(G11:G' . $dpa->count() + 10 . ')');
            $spreadsheet->getSheetByName('18 DPA')->setCellValue('H' . $dpa->count() + 11, '=SUM(H11:H' . $dpa->count() + 10 . ')');
            $spreadsheet->getSheetByName('18 DPA')->setCellValue('I' . $dpa->count() + 11, '=SUM(J11:J' . $dpa->count() + 10 . ')');
            $spreadsheet->getSheetByName('18 DPA')->setCellValue('J' . $dpa->count() + 11, '=SUM(J11:J' . $dpa->count() + 10 . ')');
            $spreadsheet->getSheetByName('18 DPA')->setCellValue('K' . $dpa->count() + 11, '=IF(E' . $dpa->count() + 11 . '=0,0,H' . $dpa->count() + 11 . '/E' . $dpa->count() + 11 . '*100)');
            $spreadsheet->getSheetByName('18 DPA')->setCellValue('L' . $dpa->count() + 11, '=J' . $dpa->count() + 11 . '-G' .  $dpa->count() + 11);
            $spreadsheet->getSheetByName('18 DPA')->setCellValue('M' . $dpa->count() + 11, '=C' . $dpa->count() + 11 . '-H' .  $dpa->count() + 11);
            $spreadsheet->getSheetByName('18 DPA')->setCellValue('N' . $dpa->count() + 11, '=SUM(O11:O' . $dpa->count() + 10 . ')');
            $spreadsheet->getSheetByName('18 DPA')->setCellValue('O' . $dpa->count() + 11, '=SUM(O11:O' . $dpa->count() + 10 . ')');
            $spreadsheet->getSheetByName('18 DPA')->setCellValue('P' . $dpa->count() + 11, '=SUM(Q11:Q' . $dpa->count() + 10 . ')');
            $spreadsheet->getSheetByName('18 DPA')->setCellValue('Q' . $dpa->count() + 11, '=SUM(Q11:Q' . $dpa->count() + 10 . ')');
            $spreadsheet->getSheetByName('18 DPA')->setCellValue('R' . $dpa->count() + 11, '=IF(N' . $dpa->count() + 11 . '=0,0,P' . $dpa->count() + 11 . '/N' . $dpa->count() + 11 . '*100)');
        }

        // perdagin
        $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('A2', 'Dinas Penamaan Modal dan Pelayanan Terpadu Satu Pintu');
        $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $spreadsheet->getSheetByName('19 Perdagin')->insertNewRowBefore(12, $perdagin->count() - 1);
        $perdaginRow = 11;
        if ($perdagin->count() != 0) {
            foreach ($perdagin as $key => $item) {
                $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('A' . $perdaginRow, $key + 1);
                $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('B' . $perdaginRow, $item->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('C' . $perdaginRow, $item->perdagin);
                $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('D' . $perdaginRow, '=C' . $perdaginRow . '/$C$' . $disdik->count() + 11 . '*100');
                $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('E' . $perdaginRow, $item->rencana);
                $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('F' . $perdaginRow, '=E' . $perdaginRow . '/C' . $perdaginRow . '*100');
                $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('G' . $perdaginRow, '=F' . $perdaginRow . '*D' . $perdaginRow . '/100');
                $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('H' . $perdaginRow, $item->realisasi);
                $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('I' . $perdaginRow, '=H' . $perdaginRow . '/C' . $perdaginRow . '*100');
                $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('J' . $perdaginRow, '=I' . $perdaginRow . '*D' . $perdaginRow . '/100');
                $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('K' . $perdaginRow, '=IF(E' . $perdaginRow . '=0,0,H' . $perdaginRow . '/E' . $perdaginRow . '*100)');
                $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('L' . $perdaginRow, '=J' . $perdaginRow . '-G' . $perdaginRow);
                $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('M' . $perdaginRow, '=C' . $perdaginRow . '-H' . $perdaginRow);
                $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('N' . $perdaginRow, $item->rencana_fisik);
                $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('O' . $perdaginRow, '=N' . $perdaginRow . '*D' . $perdaginRow . '/100');
                $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('P' . $perdaginRow, $item->realisasi_fisik);
                $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('Q' . $perdaginRow, '=P' . $perdaginRow . '*D' . $perdaginRow . '/100');
                $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('R' . $perdaginRow, '=IF(N' . $perdaginRow . '=0,0,P' . $perdaginRow . '/N' . $perdaginRow . '*100)');
                $perdaginRow++;
            }
            $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('B' . $perdagin->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('C' . $perdagin->count() + 11, '=SUM(C11:C' . $perdagin->count() + 10 . ')');
            $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('D' . $perdagin->count() + 11, '=SUM(D11:D' . $perdagin->count() + 10 . ')');
            $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('E' . $perdagin->count() + 11, '=SUM(E11:E' . $perdagin->count() + 10 . ')');
            $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('F' . $perdagin->count() + 11, '=SUM(G11:G' . $perdagin->count() + 10 . ')');
            $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('G' . $perdagin->count() + 11, '=SUM(G11:G' . $perdagin->count() + 10 . ')');
            $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('H' . $perdagin->count() + 11, '=SUM(H11:H' . $perdagin->count() + 10 . ')');
            $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('I' . $perdagin->count() + 11, '=SUM(J11:J' . $perdagin->count() + 10 . ')');
            $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('J' . $perdagin->count() + 11, '=SUM(J11:J' . $perdagin->count() + 10 . ')');
            $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('K' . $perdagin->count() + 11, '=IF(E' . $perdagin->count() + 11 . '=0,0,H' . $perdagin->count() + 11 . '/E' . $perdagin->count() + 11 . '*100)');
            $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('L' . $perdagin->count() + 11, '=J' . $perdagin->count() + 11 . '-G' .  $perdagin->count() + 11);
            $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('M' . $perdagin->count() + 11, '=C' . $perdagin->count() + 11 . '-H' .  $perdagin->count() + 11);
            $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('N' . $perdagin->count() + 11, '=SUM(O11:O' . $perdagin->count() + 10 . ')');
            $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('O' . $perdagin->count() + 11, '=SUM(O11:O' . $perdagin->count() + 10 . ')');
            $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('P' . $perdagin->count() + 11, '=SUM(Q11:Q' . $perdagin->count() + 10 . ')');
            $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('Q' . $perdagin->count() + 11, '=SUM(Q11:Q' . $perdagin->count() + 10 . ')');
            $spreadsheet->getSheetByName('19 Perdagin')->setCellValue('R' . $perdagin->count() + 11, '=IF(N' . $perdagin->count() + 11 . '=0,0,P' . $perdagin->count() + 11 . '/N' . $perdagin->count() + 11 . '*100)');
        }
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}
