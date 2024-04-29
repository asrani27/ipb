<?php

namespace App\Http\Controllers;

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

        $disdik = Uraian::where('tahun', $tahun)->where('skpd_id', 1)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan) {
            $item->rencana = superadminRencana($bulan, $item);
            $item->realisasi = superadminRealisasi($bulan, $item);
            $item->rencana_fisik = superadminRencanaFisik($bulan, $item);
            $item->realisasi_fisik = superadminRealisasiFisik($bulan, $item);
            return $item;
        });
        $dinkes = Uraian::where('tahun', $tahun)->where('skpd_id', 2)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan) {
            $item->rencana = superadminRencana($bulan, $item);
            $item->realisasi = superadminRealisasi($bulan, $item);
            $item->rencana_fisik = superadminRencanaFisik($bulan, $item);
            $item->realisasi_fisik = superadminRealisasiFisik($bulan, $item);
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
        $spreadsheet->getSheetByName('Disdik')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('Disdik')->setCellValue('A2', 'DINAS PENDIDIKAN');
        $spreadsheet->getSheetByName('Disdik')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('Disdik')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $spreadsheet->getSheetByName('Disdik')->insertNewRowBefore(12, $disdik->count() - 1);
        $disdikRow = 11;
        foreach ($disdik as $key => $item_disdik) {
            $spreadsheet->getSheetByName('Disdik')->setCellValue('A' . $disdikRow, $key + 1);
            $spreadsheet->getSheetByName('Disdik')->setCellValue('B' . $disdikRow, $item_disdik->nama)->getColumnDimension('B')->setAutoSize(TRUE);
            $spreadsheet->getSheetByName('Disdik')->setCellValue('C' . $disdikRow, $item_disdik->dpa);
            $spreadsheet->getSheetByName('Disdik')->setCellValue('D' . $disdikRow, '=C' . $disdikRow . '/$C$' . $disdik->count() + 11 . '*100');
            $spreadsheet->getSheetByName('Disdik')->setCellValue('E' . $disdikRow, $item_disdik->rencana);
            $spreadsheet->getSheetByName('Disdik')->setCellValue('F' . $disdikRow, '=E' . $disdikRow . '/C' . $disdikRow . '*100');
            $spreadsheet->getSheetByName('Disdik')->setCellValue('G' . $disdikRow, '=F' . $disdikRow . '*D' . $disdikRow . '/100');
            $spreadsheet->getSheetByName('Disdik')->setCellValue('H' . $disdikRow, $item_disdik->realisasi);
            $spreadsheet->getSheetByName('Disdik')->setCellValue('I' . $disdikRow, '=H' . $disdikRow . '/C' . $disdikRow . '*100');
            $spreadsheet->getSheetByName('Disdik')->setCellValue('J' . $disdikRow, '=I' . $disdikRow . '*D' . $disdikRow . '/100');

            if ($item_disdik->rencana == 0) {
                $spreadsheet->getSheetByName('Disdik')->setCellValue('K' . $disdikRow, '0');
            } else {
                $spreadsheet->getSheetByName('Disdik')->setCellValue('K' . $disdikRow, '=H' . $disdikRow . '/E' . $disdikRow . '*100');
            }

            $spreadsheet->getSheetByName('Disdik')->setCellValue('L' . $disdikRow, '=J' . $disdikRow . '-G' . $disdikRow);
            $spreadsheet->getSheetByName('Disdik')->setCellValue('M' . $disdikRow, '=C' . $disdikRow . '-H' . $disdikRow);
            $spreadsheet->getSheetByName('Disdik')->setCellValue('N' . $disdikRow, $item_disdik->rencana_fisik);
            $spreadsheet->getSheetByName('Disdik')->setCellValue('O' . $disdikRow, '=N' . $disdikRow . '*D' . $disdikRow . '/100');
            $spreadsheet->getSheetByName('Disdik')->setCellValue('P' . $disdikRow, $item_disdik->realisasi_fisik);
            $spreadsheet->getSheetByName('Disdik')->setCellValue('Q' . $disdikRow, '=P' . $disdikRow . '*D' . $disdikRow . '/100');

            if ($item_disdik->rencana_fisik == 0) {
                $spreadsheet->getSheetByName('Disdik')->setCellValue('R' . $disdikRow, '0');
            } else {
                $spreadsheet->getSheetByName('Disdik')->setCellValue('R' . $disdikRow, '=P' . $disdikRow . '/N' . $disdikRow . '*100');
            }
            $disdikRow++;
        }
        $spreadsheet->getSheetByName('Disdik')->setCellValue('B' . $disdik->count() + 11, 'TOTALNYA');
        $spreadsheet->getSheetByName('Disdik')->setCellValue('C' . $disdik->count() + 11, '=SUM(C11:C' . $disdik->count() + 10 . ')');
        $spreadsheet->getSheetByName('Disdik')->setCellValue('D' . $disdik->count() + 11, '=SUM(D11:D' . $disdik->count() + 10 . ')');
        $spreadsheet->getSheetByName('Disdik')->setCellValue('E' . $disdik->count() + 11, '=SUM(E11:E' . $disdik->count() + 10 . ')');
        $spreadsheet->getSheetByName('Disdik')->setCellValue('F' . $disdik->count() + 11, '=SUM(G11:G' . $disdik->count() + 10 . ')');
        $spreadsheet->getSheetByName('Disdik')->setCellValue('G' . $disdik->count() + 11, '=SUM(G11:G' . $disdik->count() + 10 . ')');
        $spreadsheet->getSheetByName('Disdik')->setCellValue('H' . $disdik->count() + 11, '=SUM(H11:H' . $disdik->count() + 10 . ')');
        $spreadsheet->getSheetByName('Disdik')->setCellValue('I' . $disdik->count() + 11, '=SUM(J11:J' . $disdik->count() + 10 . ')');
        $spreadsheet->getSheetByName('Disdik')->setCellValue('J' . $disdik->count() + 11, '=SUM(J11:J' . $disdik->count() + 10 . ')');
        if ($disdik->sum('rencana') == 0) {
            $spreadsheet->getSheetByName('Disdik')->setCellValue('K' . $disdik->count() + 11, '0');
        } else {
            $spreadsheet->getSheetByName('Disdik')->setCellValue('K' . $disdik->count() + 11, '=H' . $disdik->count() + 11 . '/E' . $disdik->count() + 11 . '*100');
        }

        $spreadsheet->getSheetByName('Disdik')->setCellValue('L' . $disdik->count() + 11, '=J' . $disdik->count() + 11 . '-G' .  $disdik->count() + 11);
        $spreadsheet->getSheetByName('Disdik')->setCellValue('M' . $disdik->count() + 11, '=C' . $disdik->count() + 11 . '-H' .  $disdik->count() + 11);
        $spreadsheet->getSheetByName('Disdik')->setCellValue('N' . $disdik->count() + 11, '=SUM(O11:O' . $disdik->count() + 10 . ')');
        $spreadsheet->getSheetByName('Disdik')->setCellValue('O' . $disdik->count() + 11, '=SUM(O11:O' . $disdik->count() + 10 . ')');
        $spreadsheet->getSheetByName('Disdik')->setCellValue('P' . $disdik->count() + 11, '=SUM(Q11:Q' . $disdik->count() + 10 . ')');
        $spreadsheet->getSheetByName('Disdik')->setCellValue('Q' . $disdik->count() + 11, '=SUM(Q11:Q' . $disdik->count() + 10 . ')');
        if ($disdik->sum('rencana_fisik') == 0) {
            $spreadsheet->getSheetByName('Disdik')->setCellValue('R' . $disdik->count() + 11, '0');
        } else {
            $spreadsheet->getSheetByName('Disdik')->setCellValue('R' . $disdik->count() + 11, '=P' . $disdik->count() + 11 . '/N' . $disdik->count() + 11 . '*100');
        }

        // DINKES
        $spreadsheet->getSheetByName('Dinkes')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('Dinkes')->setCellValue('A2', 'DINAS KESEHATAN');
        $spreadsheet->getSheetByName('Dinkes')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('Dinkes')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $spreadsheet->getSheetByName('Dinkes')->insertNewRowBefore(12, $dinkes->count() - 1);
        $dinkesRow = 11;
        foreach ($dinkes as $key => $item_dinkes) {
            $spreadsheet->getSheetByName('Dinkes')->setCellValue('A' . $dinkesRow, $key + 1);
            $spreadsheet->getSheetByName('Dinkes')->setCellValue('B' . $dinkesRow, $item_dinkes->nama)->getColumnDimension('B')->setAutoSize(TRUE);
            $spreadsheet->getSheetByName('Dinkes')->setCellValue('C' . $dinkesRow, $item_dinkes->dpa);
            $spreadsheet->getSheetByName('Dinkes')->setCellValue('D' . $dinkesRow, '=C' . $dinkesRow . '/$C$' . $dinkes->count() + 11 . '*100');
            $spreadsheet->getSheetByName('Dinkes')->setCellValue('E' . $dinkesRow, $item_dinkes->rencana);
            $spreadsheet->getSheetByName('Dinkes')->setCellValue('F' . $dinkesRow, '=E' . $dinkesRow . '/C' . $dinkesRow . '*100');
            $spreadsheet->getSheetByName('Dinkes')->setCellValue('G' . $dinkesRow, '=F' . $dinkesRow . '*D' . $dinkesRow . '/100');
            $spreadsheet->getSheetByName('Dinkes')->setCellValue('H' . $dinkesRow, $item_dinkes->realisasi);
            $spreadsheet->getSheetByName('Dinkes')->setCellValue('I' . $dinkesRow, '=H' . $dinkesRow . '/C' . $dinkesRow . '*100');
            $spreadsheet->getSheetByName('Dinkes')->setCellValue('J' . $dinkesRow, '=I' . $dinkesRow . '*D' . $dinkesRow . '/100');

            if ($item_dinkes->rencana == 0) {
                $spreadsheet->getSheetByName('Dinkes')->setCellValue('K' . $dinkesRow, '0');
            } else {
                $spreadsheet->getSheetByName('Dinkes')->setCellValue('K' . $dinkesRow, '=H' . $dinkesRow . '/E' . $dinkesRow . '*100');
            }

            $spreadsheet->getSheetByName('Dinkes')->setCellValue('L' . $dinkesRow, '=J' . $dinkesRow . '-G' . $dinkesRow);
            $spreadsheet->getSheetByName('Dinkes')->setCellValue('M' . $dinkesRow, '=C' . $dinkesRow . '-H' . $dinkesRow);
            $spreadsheet->getSheetByName('Dinkes')->setCellValue('N' . $dinkesRow, $item_dinkes->rencana_fisik);
            $spreadsheet->getSheetByName('Dinkes')->setCellValue('O' . $dinkesRow, '=N' . $dinkesRow . '*D' . $dinkesRow . '/100');
            $spreadsheet->getSheetByName('Dinkes')->setCellValue('P' . $dinkesRow, $item_dinkes->realisasi_fisik);
            $spreadsheet->getSheetByName('Dinkes')->setCellValue('Q' . $dinkesRow, '=P' . $dinkesRow . '*D' . $dinkesRow . '/100');

            if ($item_dinkes->rencana_fisik == 0) {
                $spreadsheet->getSheetByName('Dinkes')->setCellValue('R' . $dinkesRow, '0');
            } else {
                $spreadsheet->getSheetByName('Dinkes')->setCellValue('R' . $dinkesRow, '=P' . $dinkesRow . '/N' . $dinkesRow . '*100');
            }
            $dinkesRow++;
        }
        $spreadsheet->getSheetByName('Dinkes')->setCellValue('B' . $dinkes->count() + 11, 'TOTALNYA');
        $spreadsheet->getSheetByName('Dinkes')->setCellValue('C' . $dinkes->count() + 11, '=SUM(C11:C' . $dinkes->count() + 10 . ')');
        $spreadsheet->getSheetByName('Dinkes')->setCellValue('D' . $dinkes->count() + 11, '=SUM(D11:D' . $dinkes->count() + 10 . ')');
        $spreadsheet->getSheetByName('Dinkes')->setCellValue('E' . $dinkes->count() + 11, '=SUM(E11:E' . $dinkes->count() + 10 . ')');
        $spreadsheet->getSheetByName('Dinkes')->setCellValue('F' . $dinkes->count() + 11, '=SUM(G11:G' . $dinkes->count() + 10 . ')');
        $spreadsheet->getSheetByName('Dinkes')->setCellValue('G' . $dinkes->count() + 11, '=SUM(G11:G' . $dinkes->count() + 10 . ')');
        $spreadsheet->getSheetByName('Dinkes')->setCellValue('H' . $dinkes->count() + 11, '=SUM(H11:H' . $dinkes->count() + 10 . ')');
        $spreadsheet->getSheetByName('Dinkes')->setCellValue('I' . $dinkes->count() + 11, '=SUM(J11:J' . $dinkes->count() + 10 . ')');
        $spreadsheet->getSheetByName('Dinkes')->setCellValue('J' . $dinkes->count() + 11, '=SUM(J11:J' . $dinkes->count() + 10 . ')');
        if ($dinkes->sum('rencana') == 0) {
            $spreadsheet->getSheetByName('Dinkes')->setCellValue('K' . $dinkes->count() + 11, '0');
        } else {
            $spreadsheet->getSheetByName('Dinkes')->setCellValue('K' . $dinkes->count() + 11, '=H' . $dinkes->count() + 11 . '/E' . $dinkes->count() + 11 . '*100');
        }

        $spreadsheet->getSheetByName('Dinkes')->setCellValue('L' . $dinkes->count() + 11, '=J' . $dinkes->count() + 11 . '-G' .  $dinkes->count() + 11);
        $spreadsheet->getSheetByName('Dinkes')->setCellValue('M' . $dinkes->count() + 11, '=C' . $dinkes->count() + 11 . '-H' .  $dinkes->count() + 11);
        $spreadsheet->getSheetByName('Dinkes')->setCellValue('N' . $dinkes->count() + 11, '=SUM(O11:O' . $dinkes->count() + 10 . ')');
        $spreadsheet->getSheetByName('Dinkes')->setCellValue('O' . $dinkes->count() + 11, '=SUM(O11:O' . $dinkes->count() + 10 . ')');
        $spreadsheet->getSheetByName('Dinkes')->setCellValue('P' . $dinkes->count() + 11, '=SUM(Q11:Q' . $dinkes->count() + 10 . ')');
        $spreadsheet->getSheetByName('Dinkes')->setCellValue('Q' . $dinkes->count() + 11, '=SUM(Q11:Q' . $dinkes->count() + 10 . ')');
        if ($dinkes->sum('rencana_fisik') == 0) {
            $spreadsheet->getSheetByName('Dinkes')->setCellValue('R' . $dinkes->count() + 11, '0');
        } else {
            $spreadsheet->getSheetByName('Dinkes')->setCellValue('R' . $dinkes->count() + 11, '=P' . $dinkes->count() + 11 . '/N' . $dinkes->count() + 11 . '*100');
        }


        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}
