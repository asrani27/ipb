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
        $dinkes = Uraian::where('tahun', $tahun)->where('skpd_id', 34)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan) {
            $item->rencana = superadminRencana($bulan, $item);
            $item->realisasi = superadminRealisasi($bulan, $item);
            $item->rencana_fisik = superadminRencanaFisik($bulan, $item);
            $item->realisasi_fisik = superadminRealisasiFisik($bulan, $item);
            return $item;
        });

        $dpupr = Uraian::where('tahun', $tahun)->where('skpd_id', 3)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan) {
            $item->rencana = superadminRencana($bulan, $item);
            $item->realisasi = superadminRealisasi($bulan, $item);
            $item->rencana_fisik = superadminRencanaFisik($bulan, $item);
            $item->realisasi_fisik = superadminRealisasiFisik($bulan, $item);
            return $item;
        });
        $dprkp = Uraian::where('tahun', $tahun)->where('skpd_id', 4)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan) {
            $item->rencana = superadminRencana($bulan, $item);
            $item->realisasi = superadminRealisasi($bulan, $item);
            $item->rencana_fisik = superadminRencanaFisik($bulan, $item);
            $item->realisasi_fisik = superadminRealisasiFisik($bulan, $item);
            return $item;
        });
        $satpolpp = Uraian::where('tahun', $tahun)->where('skpd_id', 5)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan) {
            $item->rencana = superadminRencana($bulan, $item);
            $item->realisasi = superadminRealisasi($bulan, $item);
            $item->rencana_fisik = superadminRencanaFisik($bulan, $item);
            $item->realisasi_fisik = superadminRealisasiFisik($bulan, $item);
            return $item;
        });
        $kesbang = Uraian::where('tahun', $tahun)->where('skpd_id', 6)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan) {
            $item->rencana = superadminRencana($bulan, $item);
            $item->realisasi = superadminRealisasi($bulan, $item);
            $item->rencana_fisik = superadminRencanaFisik($bulan, $item);
            $item->realisasi_fisik = superadminRealisasiFisik($bulan, $item);
            return $item;
        });
        $dinsos = Uraian::where('tahun', $tahun)->where('skpd_id', 7)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan) {
            $item->rencana = superadminRencana($bulan, $item);
            $item->realisasi = superadminRealisasi($bulan, $item);
            $item->rencana_fisik = superadminRencanaFisik($bulan, $item);
            $item->realisasi_fisik = superadminRealisasiFisik($bulan, $item);
            return $item;
        });
        $dkp3 = Uraian::where('tahun', $tahun)->where('skpd_id', 9)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan) {
            $item->rencana = superadminRencana($bulan, $item);
            $item->realisasi = superadminRealisasi($bulan, $item);
            $item->rencana_fisik = superadminRencanaFisik($bulan, $item);
            $item->realisasi_fisik = superadminRealisasiFisik($bulan, $item);
            return $item;
        });
        $dlh = Uraian::where('tahun', $tahun)->where('skpd_id', 10)->where('jenis_rfk', $jenis)->get()->map(function ($item) use ($bulan) {
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
        $dinkesRow = 11;
        if ($dinkes->count() != 0) {
            $spreadsheet->getSheetByName('Dinkes')->insertNewRowBefore(12, $dinkes->count() - 1);
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
        }

        // DPUPR
        $spreadsheet->getSheetByName('DPUPR')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('DPUPR')->setCellValue('A2', 'Dinas Pekerjaan Umum dan Penataan Ruang');
        $spreadsheet->getSheetByName('DPUPR')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('DPUPR')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $dpuprRow = 11;
        if ($dpupr->count() != 0) {
            $spreadsheet->getSheetByName('DPUPR')->insertNewRowBefore(12, $dpupr->count() - 1);
            foreach ($dpupr as $key => $item_dinkes) {
                $spreadsheet->getSheetByName('DPUPR')->setCellValue('A' . $dpuprRow, $key + 1);
                $spreadsheet->getSheetByName('DPUPR')->setCellValue('B' . $dpuprRow, $item_dinkes->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('DPUPR')->setCellValue('C' . $dpuprRow, $item_dinkes->dpa);
                $spreadsheet->getSheetByName('DPUPR')->setCellValue('D' . $dpuprRow, '=C' . $dpuprRow . '/$C$' . $dpupr->count() + 11 . '*100');
                $spreadsheet->getSheetByName('DPUPR')->setCellValue('E' . $dpuprRow, $item_dinkes->rencana);
                $spreadsheet->getSheetByName('DPUPR')->setCellValue('F' . $dpuprRow, '=E' . $dpuprRow . '/C' . $dpuprRow . '*100');
                $spreadsheet->getSheetByName('DPUPR')->setCellValue('G' . $dpuprRow, '=F' . $dpuprRow . '*D' . $dpuprRow . '/100');
                $spreadsheet->getSheetByName('DPUPR')->setCellValue('H' . $dpuprRow, $item_dinkes->realisasi);
                $spreadsheet->getSheetByName('DPUPR')->setCellValue('I' . $dpuprRow, '=H' . $dpuprRow . '/C' . $dpuprRow . '*100');
                $spreadsheet->getSheetByName('DPUPR')->setCellValue('J' . $dpuprRow, '=I' . $dpuprRow . '*D' . $dpuprRow . '/100');

                if ($item_dinkes->rencana == 0) {
                    $spreadsheet->getSheetByName('DPUPR')->setCellValue('K' . $dpuprRow, '0');
                } else {
                    $spreadsheet->getSheetByName('DPUPR')->setCellValue('K' . $dpuprRow, '=H' . $dpuprRow . '/E' . $dpuprRow . '*100');
                }

                $spreadsheet->getSheetByName('DPUPR')->setCellValue('L' . $dpuprRow, '=J' . $dpuprRow . '-G' . $dpuprRow);
                $spreadsheet->getSheetByName('DPUPR')->setCellValue('M' . $dpuprRow, '=C' . $dpuprRow . '-H' . $dpuprRow);
                $spreadsheet->getSheetByName('DPUPR')->setCellValue('N' . $dpuprRow, $item_dinkes->rencana_fisik);
                $spreadsheet->getSheetByName('DPUPR')->setCellValue('O' . $dpuprRow, '=N' . $dpuprRow . '*D' . $dpuprRow . '/100');
                $spreadsheet->getSheetByName('DPUPR')->setCellValue('P' . $dpuprRow, $item_dinkes->realisasi_fisik);
                $spreadsheet->getSheetByName('DPUPR')->setCellValue('Q' . $dpuprRow, '=P' . $dpuprRow . '*D' . $dpuprRow . '/100');

                if ($item_dinkes->rencana_fisik == 0) {
                    $spreadsheet->getSheetByName('DPUPR')->setCellValue('R' . $dpuprRow, '0');
                } else {
                    $spreadsheet->getSheetByName('DPUPR')->setCellValue('R' . $dpuprRow, '=P' . $dpuprRow . '/N' . $dpuprRow . '*100');
                }
                $dpuprRow++;
            }
            $spreadsheet->getSheetByName('DPUPR')->setCellValue('B' . $dpupr->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('DPUPR')->setCellValue('C' . $dpupr->count() + 11, '=SUM(C11:C' . $dpupr->count() + 10 . ')');
            $spreadsheet->getSheetByName('DPUPR')->setCellValue('D' . $dpupr->count() + 11, '=SUM(D11:D' . $dpupr->count() + 10 . ')');
            $spreadsheet->getSheetByName('DPUPR')->setCellValue('E' . $dpupr->count() + 11, '=SUM(E11:E' . $dpupr->count() + 10 . ')');
            $spreadsheet->getSheetByName('DPUPR')->setCellValue('F' . $dpupr->count() + 11, '=SUM(G11:G' . $dpupr->count() + 10 . ')');
            $spreadsheet->getSheetByName('DPUPR')->setCellValue('G' . $dpupr->count() + 11, '=SUM(G11:G' . $dpupr->count() + 10 . ')');
            $spreadsheet->getSheetByName('DPUPR')->setCellValue('H' . $dpupr->count() + 11, '=SUM(H11:H' . $dpupr->count() + 10 . ')');
            $spreadsheet->getSheetByName('DPUPR')->setCellValue('I' . $dpupr->count() + 11, '=SUM(J11:J' . $dpupr->count() + 10 . ')');
            $spreadsheet->getSheetByName('DPUPR')->setCellValue('J' . $dpupr->count() + 11, '=SUM(J11:J' . $dpupr->count() + 10 . ')');
            if ($dpupr->sum('rencana') == 0) {
                $spreadsheet->getSheetByName('DPUPR')->setCellValue('K' . $dpupr->count() + 11, '0');
            } else {
                $spreadsheet->getSheetByName('DPUPR')->setCellValue('K' . $dpupr->count() + 11, '=H' . $dpupr->count() + 11 . '/E' . $dpupr->count() + 11 . '*100');
            }

            $spreadsheet->getSheetByName('DPUPR')->setCellValue('L' . $dpupr->count() + 11, '=J' . $dpupr->count() + 11 . '-G' .  $dpupr->count() + 11);
            $spreadsheet->getSheetByName('DPUPR')->setCellValue('M' . $dpupr->count() + 11, '=C' . $dpupr->count() + 11 . '-H' .  $dpupr->count() + 11);
            $spreadsheet->getSheetByName('DPUPR')->setCellValue('N' . $dpupr->count() + 11, '=SUM(O11:O' . $dpupr->count() + 10 . ')');
            $spreadsheet->getSheetByName('DPUPR')->setCellValue('O' . $dpupr->count() + 11, '=SUM(O11:O' . $dpupr->count() + 10 . ')');
            $spreadsheet->getSheetByName('DPUPR')->setCellValue('P' . $dpupr->count() + 11, '=SUM(Q11:Q' . $dpupr->count() + 10 . ')');
            $spreadsheet->getSheetByName('DPUPR')->setCellValue('Q' . $dpupr->count() + 11, '=SUM(Q11:Q' . $dpupr->count() + 10 . ')');
            if ($dpupr->sum('rencana_fisik') == 0) {
                $spreadsheet->getSheetByName('DPUPR')->setCellValue('R' . $dpupr->count() + 11, '0');
            } else {
                $spreadsheet->getSheetByName('DPUPR')->setCellValue('R' . $dpupr->count() + 11, '=P' . $dpupr->count() + 11 . '/N' . $dpupr->count() + 11 . '*100');
            }
        }

        // DPRKP
        $spreadsheet->getSheetByName('DPRKP')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('DPRKP')->setCellValue('A2', 'Dinas Perumahan Rakyat dan Kawasan Permukiman');
        $spreadsheet->getSheetByName('DPRKP')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('DPRKP')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $dprkpRow = 11;
        if ($dprkp->count() != 0) {
            $spreadsheet->getSheetByName('DPRKP')->insertNewRowBefore(12, $dprkp->count() - 1);
            foreach ($dprkp as $key => $item_dinkes) {
                $spreadsheet->getSheetByName('DPRKP')->setCellValue('A' . $dprkpRow, $key + 1);
                $spreadsheet->getSheetByName('DPRKP')->setCellValue('B' . $dprkpRow, $item_dinkes->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('DPRKP')->setCellValue('C' . $dprkpRow, $item_dinkes->dpa);
                $spreadsheet->getSheetByName('DPRKP')->setCellValue('D' . $dprkpRow, '=C' . $dprkpRow . '/$C$' . $dprkp->count() + 11 . '*100');
                $spreadsheet->getSheetByName('DPRKP')->setCellValue('E' . $dprkpRow, $item_dinkes->rencana);
                $spreadsheet->getSheetByName('DPRKP')->setCellValue('F' . $dprkpRow, '=E' . $dprkpRow . '/C' . $dprkpRow . '*100');
                $spreadsheet->getSheetByName('DPRKP')->setCellValue('G' . $dprkpRow, '=F' . $dprkpRow . '*D' . $dprkpRow . '/100');
                $spreadsheet->getSheetByName('DPRKP')->setCellValue('H' . $dprkpRow, $item_dinkes->realisasi);
                $spreadsheet->getSheetByName('DPRKP')->setCellValue('I' . $dprkpRow, '=H' . $dprkpRow . '/C' . $dprkpRow . '*100');
                $spreadsheet->getSheetByName('DPRKP')->setCellValue('J' . $dprkpRow, '=I' . $dprkpRow . '*D' . $dprkpRow . '/100');

                if ($item_dinkes->rencana == 0) {
                    $spreadsheet->getSheetByName('DPRKP')->setCellValue('K' . $dprkpRow, '0');
                } else {
                    $spreadsheet->getSheetByName('DPRKP')->setCellValue('K' . $dprkpRow, '=H' . $dprkpRow . '/E' . $dprkpRow . '*100');
                }

                $spreadsheet->getSheetByName('DPRKP')->setCellValue('L' . $dprkpRow, '=J' . $dprkpRow . '-G' . $dprkpRow);
                $spreadsheet->getSheetByName('DPRKP')->setCellValue('M' . $dprkpRow, '=C' . $dprkpRow . '-H' . $dprkpRow);
                $spreadsheet->getSheetByName('DPRKP')->setCellValue('N' . $dprkpRow, $item_dinkes->rencana_fisik);
                $spreadsheet->getSheetByName('DPRKP')->setCellValue('O' . $dprkpRow, '=N' . $dprkpRow . '*D' . $dprkpRow . '/100');
                $spreadsheet->getSheetByName('DPRKP')->setCellValue('P' . $dprkpRow, $item_dinkes->realisasi_fisik);
                $spreadsheet->getSheetByName('DPRKP')->setCellValue('Q' . $dprkpRow, '=P' . $dprkpRow . '*D' . $dprkpRow . '/100');

                if ($item_dinkes->rencana_fisik == 0) {
                    $spreadsheet->getSheetByName('DPRKP')->setCellValue('R' . $dprkpRow, '0');
                } else {
                    $spreadsheet->getSheetByName('DPRKP')->setCellValue('R' . $dprkpRow, '=P' . $dprkpRow . '/N' . $dprkpRow . '*100');
                }
                $dprkpRow++;
            }
            $spreadsheet->getSheetByName('DPRKP')->setCellValue('B' . $dprkp->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('DPRKP')->setCellValue('C' . $dprkp->count() + 11, '=SUM(C11:C' . $dprkp->count() + 10 . ')');
            $spreadsheet->getSheetByName('DPRKP')->setCellValue('D' . $dprkp->count() + 11, '=SUM(D11:D' . $dprkp->count() + 10 . ')');
            $spreadsheet->getSheetByName('DPRKP')->setCellValue('E' . $dprkp->count() + 11, '=SUM(E11:E' . $dprkp->count() + 10 . ')');
            $spreadsheet->getSheetByName('DPRKP')->setCellValue('F' . $dprkp->count() + 11, '=SUM(G11:G' . $dprkp->count() + 10 . ')');
            $spreadsheet->getSheetByName('DPRKP')->setCellValue('G' . $dprkp->count() + 11, '=SUM(G11:G' . $dprkp->count() + 10 . ')');
            $spreadsheet->getSheetByName('DPRKP')->setCellValue('H' . $dprkp->count() + 11, '=SUM(H11:H' . $dprkp->count() + 10 . ')');
            $spreadsheet->getSheetByName('DPRKP')->setCellValue('I' . $dprkp->count() + 11, '=SUM(J11:J' . $dprkp->count() + 10 . ')');
            $spreadsheet->getSheetByName('DPRKP')->setCellValue('J' . $dprkp->count() + 11, '=SUM(J11:J' . $dprkp->count() + 10 . ')');
            if ($dprkp->sum('rencana') == 0) {
                $spreadsheet->getSheetByName('DPRKP')->setCellValue('K' . $dprkp->count() + 11, '0');
            } else {
                $spreadsheet->getSheetByName('DPRKP')->setCellValue('K' . $dprkp->count() + 11, '=H' . $dprkp->count() + 11 . '/E' . $dprkp->count() + 11 . '*100');
            }

            $spreadsheet->getSheetByName('DPRKP')->setCellValue('L' . $dprkp->count() + 11, '=J' . $dprkp->count() + 11 . '-G' .  $dprkp->count() + 11);
            $spreadsheet->getSheetByName('DPRKP')->setCellValue('M' . $dprkp->count() + 11, '=C' . $dprkp->count() + 11 . '-H' .  $dprkp->count() + 11);
            $spreadsheet->getSheetByName('DPRKP')->setCellValue('N' . $dprkp->count() + 11, '=SUM(O11:O' . $dprkp->count() + 10 . ')');
            $spreadsheet->getSheetByName('DPRKP')->setCellValue('O' . $dprkp->count() + 11, '=SUM(O11:O' . $dprkp->count() + 10 . ')');
            $spreadsheet->getSheetByName('DPRKP')->setCellValue('P' . $dprkp->count() + 11, '=SUM(Q11:Q' . $dprkp->count() + 10 . ')');
            $spreadsheet->getSheetByName('DPRKP')->setCellValue('Q' . $dprkp->count() + 11, '=SUM(Q11:Q' . $dprkp->count() + 10 . ')');
            if ($dprkp->sum('rencana_fisik') == 0) {
                $spreadsheet->getSheetByName('DPRKP')->setCellValue('R' . $dprkp->count() + 11, '0');
            } else {
                $spreadsheet->getSheetByName('DPRKP')->setCellValue('R' . $dprkp->count() + 11, '=P' . $dprkp->count() + 11 . '/N' . $dprkp->count() + 11 . '*100');
            }
        }

        // SATPOL PP
        $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('A2', 'Satuan Polisi Pamong Praja');
        $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $satpolppRow = 11;
        if ($satpolpp->count() != 0) {
            $spreadsheet->getSheetByName('SATPOLPP')->insertNewRowBefore(12, $satpolpp->count() - 1);
            foreach ($satpolpp as $key => $item_dinkes) {
                $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('A' . $satpolppRow, $key + 1);
                $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('B' . $satpolppRow, $item_dinkes->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('C' . $satpolppRow, $item_dinkes->dpa);
                $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('D' . $satpolppRow, '=C' . $satpolppRow . '/$C$' . $satpolpp->count() + 11 . '*100');
                $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('E' . $satpolppRow, $item_dinkes->rencana);
                $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('F' . $satpolppRow, '=E' . $satpolppRow . '/C' . $satpolppRow . '*100');
                $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('G' . $satpolppRow, '=F' . $satpolppRow . '*D' . $satpolppRow . '/100');
                $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('H' . $satpolppRow, $item_dinkes->realisasi);
                $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('I' . $satpolppRow, '=H' . $satpolppRow . '/C' . $satpolppRow . '*100');
                $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('J' . $satpolppRow, '=I' . $satpolppRow . '*D' . $satpolppRow . '/100');

                if ($item_dinkes->rencana == 0) {
                    $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('K' . $satpolppRow, '0');
                } else {
                    $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('K' . $satpolppRow, '=H' . $satpolppRow . '/E' . $satpolppRow . '*100');
                }

                $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('L' . $satpolppRow, '=J' . $satpolppRow . '-G' . $satpolppRow);
                $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('M' . $satpolppRow, '=C' . $satpolppRow . '-H' . $satpolppRow);
                $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('N' . $satpolppRow, $item_dinkes->rencana_fisik);
                $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('O' . $satpolppRow, '=N' . $satpolppRow . '*D' . $satpolppRow . '/100');
                $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('P' . $satpolppRow, $item_dinkes->realisasi_fisik);
                $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('Q' . $satpolppRow, '=P' . $satpolppRow . '*D' . $satpolppRow . '/100');

                if ($item_dinkes->rencana_fisik == 0) {
                    $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('R' . $satpolppRow, '0');
                } else {
                    $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('R' . $satpolppRow, '=P' . $satpolppRow . '/N' . $satpolppRow . '*100');
                }
                $satpolppRow++;
            }
            $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('B' . $satpolpp->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('C' . $satpolpp->count() + 11, '=SUM(C11:C' . $satpolpp->count() + 10 . ')');
            $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('D' . $satpolpp->count() + 11, '=SUM(D11:D' . $satpolpp->count() + 10 . ')');
            $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('E' . $satpolpp->count() + 11, '=SUM(E11:E' . $satpolpp->count() + 10 . ')');
            $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('F' . $satpolpp->count() + 11, '=SUM(G11:G' . $satpolpp->count() + 10 . ')');
            $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('G' . $satpolpp->count() + 11, '=SUM(G11:G' . $satpolpp->count() + 10 . ')');
            $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('H' . $satpolpp->count() + 11, '=SUM(H11:H' . $satpolpp->count() + 10 . ')');
            $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('I' . $satpolpp->count() + 11, '=SUM(J11:J' . $satpolpp->count() + 10 . ')');
            $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('J' . $satpolpp->count() + 11, '=SUM(J11:J' . $satpolpp->count() + 10 . ')');
            if ($satpolpp->sum('rencana') == 0) {
                $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('K' . $satpolpp->count() + 11, '0');
            } else {
                $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('K' . $satpolpp->count() + 11, '=H' . $satpolpp->count() + 11 . '/E' . $satpolpp->count() + 11 . '*100');
            }

            $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('L' . $satpolpp->count() + 11, '=J' . $satpolpp->count() + 11 . '-G' .  $satpolpp->count() + 11);
            $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('M' . $satpolpp->count() + 11, '=C' . $satpolpp->count() + 11 . '-H' .  $satpolpp->count() + 11);
            $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('N' . $satpolpp->count() + 11, '=SUM(O11:O' . $satpolpp->count() + 10 . ')');
            $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('O' . $satpolpp->count() + 11, '=SUM(O11:O' . $satpolpp->count() + 10 . ')');
            $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('P' . $satpolpp->count() + 11, '=SUM(Q11:Q' . $satpolpp->count() + 10 . ')');
            $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('Q' . $satpolpp->count() + 11, '=SUM(Q11:Q' . $satpolpp->count() + 10 . ')');
            if ($satpolpp->sum('rencana_fisik') == 0) {
                $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('R' . $satpolpp->count() + 11, '0');
            } else {
                $spreadsheet->getSheetByName('SATPOLPP')->setCellValue('R' . $satpolpp->count() + 11, '=P' . $satpolpp->count() + 11 . '/N' . $satpolpp->count() + 11 . '*100');
            }
        }


        // kesbang
        $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('A2', 'Badan Kesatuan Bangsa dan Politik');
        $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $kesbangRow = 11;
        if ($kesbang->count() != 0) {
            $spreadsheet->getSheetByName('KESBANGPOL')->insertNewRowBefore(12, $kesbang->count() - 1);
            foreach ($kesbang as $key => $item_dinkes) {
                $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('A' . $kesbangRow, $key + 1);
                $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('B' . $kesbangRow, $item_dinkes->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('C' . $kesbangRow, $item_dinkes->dpa);
                $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('D' . $kesbangRow, '=C' . $kesbangRow . '/$C$' . $kesbang->count() + 11 . '*100');
                $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('E' . $kesbangRow, $item_dinkes->rencana);
                $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('F' . $kesbangRow, '=E' . $kesbangRow . '/C' . $kesbangRow . '*100');
                $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('G' . $kesbangRow, '=F' . $kesbangRow . '*D' . $kesbangRow . '/100');
                $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('H' . $kesbangRow, $item_dinkes->realisasi);
                $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('I' . $kesbangRow, '=H' . $kesbangRow . '/C' . $kesbangRow . '*100');
                $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('J' . $kesbangRow, '=I' . $kesbangRow . '*D' . $kesbangRow . '/100');

                if ($item_dinkes->rencana == 0) {
                    $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('K' . $kesbangRow, '0');
                } else {
                    $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('K' . $kesbangRow, '=H' . $kesbangRow . '/E' . $kesbangRow . '*100');
                }

                $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('L' . $kesbangRow, '=J' . $kesbangRow . '-G' . $kesbangRow);
                $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('M' . $kesbangRow, '=C' . $kesbangRow . '-H' . $kesbangRow);
                $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('N' . $kesbangRow, $item_dinkes->rencana_fisik);
                $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('O' . $kesbangRow, '=N' . $kesbangRow . '*D' . $kesbangRow . '/100');
                $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('P' . $kesbangRow, $item_dinkes->realisasi_fisik);
                $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('Q' . $kesbangRow, '=P' . $kesbangRow . '*D' . $kesbangRow . '/100');

                if ($item_dinkes->rencana_fisik == 0) {
                    $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('R' . $kesbangRow, '0');
                } else {
                    $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('R' . $kesbangRow, '=P' . $kesbangRow . '/N' . $kesbangRow . '*100');
                }
                $kesbangRow++;
            }
            $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('B' . $kesbang->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('C' . $kesbang->count() + 11, '=SUM(C11:C' . $kesbang->count() + 10 . ')');
            $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('D' . $kesbang->count() + 11, '=SUM(D11:D' . $kesbang->count() + 10 . ')');
            $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('E' . $kesbang->count() + 11, '=SUM(E11:E' . $kesbang->count() + 10 . ')');
            $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('F' . $kesbang->count() + 11, '=SUM(G11:G' . $kesbang->count() + 10 . ')');
            $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('G' . $kesbang->count() + 11, '=SUM(G11:G' . $kesbang->count() + 10 . ')');
            $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('H' . $kesbang->count() + 11, '=SUM(H11:H' . $kesbang->count() + 10 . ')');
            $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('I' . $kesbang->count() + 11, '=SUM(J11:J' . $kesbang->count() + 10 . ')');
            $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('J' . $kesbang->count() + 11, '=SUM(J11:J' . $kesbang->count() + 10 . ')');
            if ($kesbang->sum('rencana') == 0) {
                $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('K' . $kesbang->count() + 11, '0');
            } else {
                $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('K' . $kesbang->count() + 11, '=H' . $kesbang->count() + 11 . '/E' . $kesbang->count() + 11 . '*100');
            }

            $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('L' . $kesbang->count() + 11, '=J' . $kesbang->count() + 11 . '-G' .  $kesbang->count() + 11);
            $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('M' . $kesbang->count() + 11, '=C' . $kesbang->count() + 11 . '-H' .  $kesbang->count() + 11);
            $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('N' . $kesbang->count() + 11, '=SUM(O11:O' . $kesbang->count() + 10 . ')');
            $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('O' . $kesbang->count() + 11, '=SUM(O11:O' . $kesbang->count() + 10 . ')');
            $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('P' . $kesbang->count() + 11, '=SUM(Q11:Q' . $kesbang->count() + 10 . ')');
            $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('Q' . $kesbang->count() + 11, '=SUM(Q11:Q' . $kesbang->count() + 10 . ')');
            if ($kesbang->sum('rencana_fisik') == 0) {
                $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('R' . $kesbang->count() + 11, '0');
            } else {
                $spreadsheet->getSheetByName('KESBANGPOL')->setCellValue('R' . $kesbang->count() + 11, '=P' . $kesbang->count() + 11 . '/N' . $kesbang->count() + 11 . '*100');
            }
        }


        // dinsosP
        $spreadsheet->getSheetByName('DINSOS')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('DINSOS')->setCellValue('A2', 'DINAS SOSIAL');
        $spreadsheet->getSheetByName('DINSOS')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('DINSOS')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $dinsosRow = 11;
        if ($dinsos->count() != 0) {
            $spreadsheet->getSheetByName('DINSOS')->insertNewRowBefore(12, $dinsos->count() - 1);
            foreach ($dinsos as $key => $item_dinkes) {
                $spreadsheet->getSheetByName('DINSOS')->setCellValue('A' . $dinsosRow, $key + 1);
                $spreadsheet->getSheetByName('DINSOS')->setCellValue('B' . $dinsosRow, $item_dinkes->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('DINSOS')->setCellValue('C' . $dinsosRow, $item_dinkes->dpa);
                $spreadsheet->getSheetByName('DINSOS')->setCellValue('D' . $dinsosRow, '=C' . $dinsosRow . '/$C$' . $dinsos->count() + 11 . '*100');
                $spreadsheet->getSheetByName('DINSOS')->setCellValue('E' . $dinsosRow, $item_dinkes->rencana);
                $spreadsheet->getSheetByName('DINSOS')->setCellValue('F' . $dinsosRow, '=E' . $dinsosRow . '/C' . $dinsosRow . '*100');
                $spreadsheet->getSheetByName('DINSOS')->setCellValue('G' . $dinsosRow, '=F' . $dinsosRow . '*D' . $dinsosRow . '/100');
                $spreadsheet->getSheetByName('DINSOS')->setCellValue('H' . $dinsosRow, $item_dinkes->realisasi);
                $spreadsheet->getSheetByName('DINSOS')->setCellValue('I' . $dinsosRow, '=H' . $dinsosRow . '/C' . $dinsosRow . '*100');
                $spreadsheet->getSheetByName('DINSOS')->setCellValue('J' . $dinsosRow, '=I' . $dinsosRow . '*D' . $dinsosRow . '/100');

                if ($item_dinkes->rencana == 0) {
                    $spreadsheet->getSheetByName('DINSOS')->setCellValue('K' . $dinsosRow, '0');
                } else {
                    $spreadsheet->getSheetByName('DINSOS')->setCellValue('K' . $dinsosRow, '=H' . $dinsosRow . '/E' . $dinsosRow . '*100');
                }

                $spreadsheet->getSheetByName('DINSOS')->setCellValue('L' . $dinsosRow, '=J' . $dinsosRow . '-G' . $dinsosRow);
                $spreadsheet->getSheetByName('DINSOS')->setCellValue('M' . $dinsosRow, '=C' . $dinsosRow . '-H' . $dinsosRow);
                $spreadsheet->getSheetByName('DINSOS')->setCellValue('N' . $dinsosRow, $item_dinkes->rencana_fisik);
                $spreadsheet->getSheetByName('DINSOS')->setCellValue('O' . $dinsosRow, '=N' . $dinsosRow . '*D' . $dinsosRow . '/100');
                $spreadsheet->getSheetByName('DINSOS')->setCellValue('P' . $dinsosRow, $item_dinkes->realisasi_fisik);
                $spreadsheet->getSheetByName('DINSOS')->setCellValue('Q' . $dinsosRow, '=P' . $dinsosRow . '*D' . $dinsosRow . '/100');

                if ($item_dinkes->rencana_fisik == 0) {
                    $spreadsheet->getSheetByName('DINSOS')->setCellValue('R' . $dinsosRow, '0');
                } else {
                    $spreadsheet->getSheetByName('DINSOS')->setCellValue('R' . $dinsosRow, '=P' . $dinsosRow . '/N' . $dinsosRow . '*100');
                }
                $dinsosRow++;
            }
            $spreadsheet->getSheetByName('DINSOS')->setCellValue('B' . $dinsos->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('DINSOS')->setCellValue('C' . $dinsos->count() + 11, '=SUM(C11:C' . $dinsos->count() + 10 . ')');
            $spreadsheet->getSheetByName('DINSOS')->setCellValue('D' . $dinsos->count() + 11, '=SUM(D11:D' . $dinsos->count() + 10 . ')');
            $spreadsheet->getSheetByName('DINSOS')->setCellValue('E' . $dinsos->count() + 11, '=SUM(E11:E' . $dinsos->count() + 10 . ')');
            $spreadsheet->getSheetByName('DINSOS')->setCellValue('F' . $dinsos->count() + 11, '=SUM(G11:G' . $dinsos->count() + 10 . ')');
            $spreadsheet->getSheetByName('DINSOS')->setCellValue('G' . $dinsos->count() + 11, '=SUM(G11:G' . $dinsos->count() + 10 . ')');
            $spreadsheet->getSheetByName('DINSOS')->setCellValue('H' . $dinsos->count() + 11, '=SUM(H11:H' . $dinsos->count() + 10 . ')');
            $spreadsheet->getSheetByName('DINSOS')->setCellValue('I' . $dinsos->count() + 11, '=SUM(J11:J' . $dinsos->count() + 10 . ')');
            $spreadsheet->getSheetByName('DINSOS')->setCellValue('J' . $dinsos->count() + 11, '=SUM(J11:J' . $dinsos->count() + 10 . ')');
            if ($dinsos->sum('rencana') == 0) {
                $spreadsheet->getSheetByName('DINSOS')->setCellValue('K' . $dinsos->count() + 11, '0');
            } else {
                $spreadsheet->getSheetByName('DINSOS')->setCellValue('K' . $dinsos->count() + 11, '=H' . $dinsos->count() + 11 . '/E' . $dinsos->count() + 11 . '*100');
            }

            $spreadsheet->getSheetByName('DINSOS')->setCellValue('L' . $dinsos->count() + 11, '=J' . $dinsos->count() + 11 . '-G' .  $dinsos->count() + 11);
            $spreadsheet->getSheetByName('DINSOS')->setCellValue('M' . $dinsos->count() + 11, '=C' . $dinsos->count() + 11 . '-H' .  $dinsos->count() + 11);
            $spreadsheet->getSheetByName('DINSOS')->setCellValue('N' . $dinsos->count() + 11, '=SUM(O11:O' . $dinsos->count() + 10 . ')');
            $spreadsheet->getSheetByName('DINSOS')->setCellValue('O' . $dinsos->count() + 11, '=SUM(O11:O' . $dinsos->count() + 10 . ')');
            $spreadsheet->getSheetByName('DINSOS')->setCellValue('P' . $dinsos->count() + 11, '=SUM(Q11:Q' . $dinsos->count() + 10 . ')');
            $spreadsheet->getSheetByName('DINSOS')->setCellValue('Q' . $dinsos->count() + 11, '=SUM(Q11:Q' . $dinsos->count() + 10 . ')');
            if ($dinsos->sum('rencana_fisik') == 0) {
                $spreadsheet->getSheetByName('DINSOS')->setCellValue('R' . $dinsos->count() + 11, '0');
            } else {
                $spreadsheet->getSheetByName('DINSOS')->setCellValue('R' . $dinsos->count() + 11, '=P' . $dinsos->count() + 11 . '/N' . $dinsos->count() + 11 . '*100');
            }
        }

        // dkp3P
        $spreadsheet->getSheetByName('DKP3')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('DKP3')->setCellValue('A2', 'Dinas Ketahanan Pangan, Pertanian dan Perikanan');
        $spreadsheet->getSheetByName('DKP3')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('DKP3')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $dkp3Row = 11;
        if ($dkp3->count() != 0) {
            $spreadsheet->getSheetByName('DKP3')->insertNewRowBefore(12, $dkp3->count() - 1);
            foreach ($dkp3 as $key => $item_dinkes) {
                $spreadsheet->getSheetByName('DKP3')->setCellValue('A' . $dkp3Row, $key + 1);
                $spreadsheet->getSheetByName('DKP3')->setCellValue('B' . $dkp3Row, $item_dinkes->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('DKP3')->setCellValue('C' . $dkp3Row, $item_dinkes->dpa);
                $spreadsheet->getSheetByName('DKP3')->setCellValue('D' . $dkp3Row, '=C' . $dkp3Row . '/$C$' . $dkp3->count() + 11 . '*100');
                $spreadsheet->getSheetByName('DKP3')->setCellValue('E' . $dkp3Row, $item_dinkes->rencana);
                $spreadsheet->getSheetByName('DKP3')->setCellValue('F' . $dkp3Row, '=E' . $dkp3Row . '/C' . $dkp3Row . '*100');
                $spreadsheet->getSheetByName('DKP3')->setCellValue('G' . $dkp3Row, '=F' . $dkp3Row . '*D' . $dkp3Row . '/100');
                $spreadsheet->getSheetByName('DKP3')->setCellValue('H' . $dkp3Row, $item_dinkes->realisasi);
                $spreadsheet->getSheetByName('DKP3')->setCellValue('I' . $dkp3Row, '=H' . $dkp3Row . '/C' . $dkp3Row . '*100');
                $spreadsheet->getSheetByName('DKP3')->setCellValue('J' . $dkp3Row, '=I' . $dkp3Row . '*D' . $dkp3Row . '/100');

                if ($item_dinkes->rencana == 0) {
                    $spreadsheet->getSheetByName('DKP3')->setCellValue('K' . $dkp3Row, '0');
                } else {
                    $spreadsheet->getSheetByName('DKP3')->setCellValue('K' . $dkp3Row, '=H' . $dkp3Row . '/E' . $dkp3Row . '*100');
                }

                $spreadsheet->getSheetByName('DKP3')->setCellValue('L' . $dkp3Row, '=J' . $dkp3Row . '-G' . $dkp3Row);
                $spreadsheet->getSheetByName('DKP3')->setCellValue('M' . $dkp3Row, '=C' . $dkp3Row . '-H' . $dkp3Row);
                $spreadsheet->getSheetByName('DKP3')->setCellValue('N' . $dkp3Row, $item_dinkes->rencana_fisik);
                $spreadsheet->getSheetByName('DKP3')->setCellValue('O' . $dkp3Row, '=N' . $dkp3Row . '*D' . $dkp3Row . '/100');
                $spreadsheet->getSheetByName('DKP3')->setCellValue('P' . $dkp3Row, $item_dinkes->realisasi_fisik);
                $spreadsheet->getSheetByName('DKP3')->setCellValue('Q' . $dkp3Row, '=P' . $dkp3Row . '*D' . $dkp3Row . '/100');

                if ($item_dinkes->rencana_fisik == 0) {
                    $spreadsheet->getSheetByName('DKP3')->setCellValue('R' . $dkp3Row, '0');
                } else {
                    $spreadsheet->getSheetByName('DKP3')->setCellValue('R' . $dkp3Row, '=P' . $dkp3Row . '/N' . $dkp3Row . '*100');
                }
                $dkp3Row++;
            }
            $spreadsheet->getSheetByName('DKP3')->setCellValue('B' . $dkp3->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('DKP3')->setCellValue('C' . $dkp3->count() + 11, '=SUM(C11:C' . $dkp3->count() + 10 . ')');
            $spreadsheet->getSheetByName('DKP3')->setCellValue('D' . $dkp3->count() + 11, '=SUM(D11:D' . $dkp3->count() + 10 . ')');
            $spreadsheet->getSheetByName('DKP3')->setCellValue('E' . $dkp3->count() + 11, '=SUM(E11:E' . $dkp3->count() + 10 . ')');
            $spreadsheet->getSheetByName('DKP3')->setCellValue('F' . $dkp3->count() + 11, '=SUM(G11:G' . $dkp3->count() + 10 . ')');
            $spreadsheet->getSheetByName('DKP3')->setCellValue('G' . $dkp3->count() + 11, '=SUM(G11:G' . $dkp3->count() + 10 . ')');
            $spreadsheet->getSheetByName('DKP3')->setCellValue('H' . $dkp3->count() + 11, '=SUM(H11:H' . $dkp3->count() + 10 . ')');
            $spreadsheet->getSheetByName('DKP3')->setCellValue('I' . $dkp3->count() + 11, '=SUM(J11:J' . $dkp3->count() + 10 . ')');
            $spreadsheet->getSheetByName('DKP3')->setCellValue('J' . $dkp3->count() + 11, '=SUM(J11:J' . $dkp3->count() + 10 . ')');
            if ($dkp3->sum('rencana') == 0) {
                $spreadsheet->getSheetByName('DKP3')->setCellValue('K' . $dkp3->count() + 11, '0');
            } else {
                $spreadsheet->getSheetByName('DKP3')->setCellValue('K' . $dkp3->count() + 11, '=H' . $dkp3->count() + 11 . '/E' . $dkp3->count() + 11 . '*100');
            }

            $spreadsheet->getSheetByName('DKP3')->setCellValue('L' . $dkp3->count() + 11, '=J' . $dkp3->count() + 11 . '-G' .  $dkp3->count() + 11);
            $spreadsheet->getSheetByName('DKP3')->setCellValue('M' . $dkp3->count() + 11, '=C' . $dkp3->count() + 11 . '-H' .  $dkp3->count() + 11);
            $spreadsheet->getSheetByName('DKP3')->setCellValue('N' . $dkp3->count() + 11, '=SUM(O11:O' . $dkp3->count() + 10 . ')');
            $spreadsheet->getSheetByName('DKP3')->setCellValue('O' . $dkp3->count() + 11, '=SUM(O11:O' . $dkp3->count() + 10 . ')');
            $spreadsheet->getSheetByName('DKP3')->setCellValue('P' . $dkp3->count() + 11, '=SUM(Q11:Q' . $dkp3->count() + 10 . ')');
            $spreadsheet->getSheetByName('DKP3')->setCellValue('Q' . $dkp3->count() + 11, '=SUM(Q11:Q' . $dkp3->count() + 10 . ')');
            if ($dkp3->sum('rencana_fisik') == 0) {
                $spreadsheet->getSheetByName('DKP3')->setCellValue('R' . $dkp3->count() + 11, '0');
            } else {
                $spreadsheet->getSheetByName('DKP3')->setCellValue('R' . $dkp3->count() + 11, '=P' . $dkp3->count() + 11 . '/N' . $dkp3->count() + 11 . '*100');
            }
        }


        // dlhP
        $spreadsheet->getSheetByName('DLH')->setCellValue('A1', 'LAPORAN REALISASI FISIK DAN KEUANGAN');
        $spreadsheet->getSheetByName('DLH')->setCellValue('A2', 'DINAS LINGKUNGAN HIDUP');
        $spreadsheet->getSheetByName('DLH')->setCellValue('A3', 'TAHUN ANGGARAN ' . $tahun);
        $spreadsheet->getSheetByName('DLH')->setCellValue('A4', 'KONDISI ' . strtoupper(namaBulan($bulan)) . ' ' . $tahun);
        $dlhRow = 11;
        if ($dlh->count() != 0) {
            $spreadsheet->getSheetByName('DLH')->insertNewRowBefore(12, $dlh->count() - 1);
            foreach ($dlh as $key => $item_dinkes) {
                $spreadsheet->getSheetByName('DLH')->setCellValue('A' . $dlhRow, $key + 1);
                $spreadsheet->getSheetByName('DLH')->setCellValue('B' . $dlhRow, $item_dinkes->nama)->getColumnDimension('B')->setAutoSize(TRUE);
                $spreadsheet->getSheetByName('DLH')->setCellValue('C' . $dlhRow, $item_dinkes->dpa);
                $spreadsheet->getSheetByName('DLH')->setCellValue('D' . $dlhRow, '=C' . $dlhRow . '/$C$' . $dlh->count() + 11 . '*100');
                $spreadsheet->getSheetByName('DLH')->setCellValue('E' . $dlhRow, $item_dinkes->rencana);
                $spreadsheet->getSheetByName('DLH')->setCellValue('F' . $dlhRow, '=E' . $dlhRow . '/C' . $dlhRow . '*100');
                $spreadsheet->getSheetByName('DLH')->setCellValue('G' . $dlhRow, '=F' . $dlhRow . '*D' . $dlhRow . '/100');
                $spreadsheet->getSheetByName('DLH')->setCellValue('H' . $dlhRow, $item_dinkes->realisasi);
                $spreadsheet->getSheetByName('DLH')->setCellValue('I' . $dlhRow, '=H' . $dlhRow . '/C' . $dlhRow . '*100');
                $spreadsheet->getSheetByName('DLH')->setCellValue('J' . $dlhRow, '=I' . $dlhRow . '*D' . $dlhRow . '/100');

                if ($item_dinkes->rencana == 0) {
                    $spreadsheet->getSheetByName('DLH')->setCellValue('K' . $dlhRow, '0');
                } else {
                    $spreadsheet->getSheetByName('DLH')->setCellValue('K' . $dlhRow, '=H' . $dlhRow . '/E' . $dlhRow . '*100');
                }

                $spreadsheet->getSheetByName('DLH')->setCellValue('L' . $dlhRow, '=J' . $dlhRow . '-G' . $dlhRow);
                $spreadsheet->getSheetByName('DLH')->setCellValue('M' . $dlhRow, '=C' . $dlhRow . '-H' . $dlhRow);
                $spreadsheet->getSheetByName('DLH')->setCellValue('N' . $dlhRow, $item_dinkes->rencana_fisik);
                $spreadsheet->getSheetByName('DLH')->setCellValue('O' . $dlhRow, '=N' . $dlhRow . '*D' . $dlhRow . '/100');
                $spreadsheet->getSheetByName('DLH')->setCellValue('P' . $dlhRow, $item_dinkes->realisasi_fisik);
                $spreadsheet->getSheetByName('DLH')->setCellValue('Q' . $dlhRow, '=P' . $dlhRow . '*D' . $dlhRow . '/100');

                if ($item_dinkes->rencana_fisik == 0) {
                    $spreadsheet->getSheetByName('DLH')->setCellValue('R' . $dlhRow, '0');
                } else {
                    $spreadsheet->getSheetByName('DLH')->setCellValue('R' . $dlhRow, '=P' . $dlhRow . '/N' . $dlhRow . '*100');
                }
                $dlhRow++;
            }
            $spreadsheet->getSheetByName('DLH')->setCellValue('B' . $dlh->count() + 11, 'TOTALNYA');
            $spreadsheet->getSheetByName('DLH')->setCellValue('C' . $dlh->count() + 11, '=SUM(C11:C' . $dlh->count() + 10 . ')');
            $spreadsheet->getSheetByName('DLH')->setCellValue('D' . $dlh->count() + 11, '=SUM(D11:D' . $dlh->count() + 10 . ')');
            $spreadsheet->getSheetByName('DLH')->setCellValue('E' . $dlh->count() + 11, '=SUM(E11:E' . $dlh->count() + 10 . ')');
            $spreadsheet->getSheetByName('DLH')->setCellValue('F' . $dlh->count() + 11, '=SUM(G11:G' . $dlh->count() + 10 . ')');
            $spreadsheet->getSheetByName('DLH')->setCellValue('G' . $dlh->count() + 11, '=SUM(G11:G' . $dlh->count() + 10 . ')');
            $spreadsheet->getSheetByName('DLH')->setCellValue('H' . $dlh->count() + 11, '=SUM(H11:H' . $dlh->count() + 10 . ')');
            $spreadsheet->getSheetByName('DLH')->setCellValue('I' . $dlh->count() + 11, '=SUM(J11:J' . $dlh->count() + 10 . ')');
            $spreadsheet->getSheetByName('DLH')->setCellValue('J' . $dlh->count() + 11, '=SUM(J11:J' . $dlh->count() + 10 . ')');
            if ($dlh->sum('rencana') == 0) {
                $spreadsheet->getSheetByName('DLH')->setCellValue('K' . $dlh->count() + 11, '0');
            } else {
                $spreadsheet->getSheetByName('DLH')->setCellValue('K' . $dlh->count() + 11, '=H' . $dlh->count() + 11 . '/E' . $dlh->count() + 11 . '*100');
            }

            $spreadsheet->getSheetByName('DLH')->setCellValue('L' . $dlh->count() + 11, '=J' . $dlh->count() + 11 . '-G' .  $dlh->count() + 11);
            $spreadsheet->getSheetByName('DLH')->setCellValue('M' . $dlh->count() + 11, '=C' . $dlh->count() + 11 . '-H' .  $dlh->count() + 11);
            $spreadsheet->getSheetByName('DLH')->setCellValue('N' . $dlh->count() + 11, '=SUM(O11:O' . $dlh->count() + 10 . ')');
            $spreadsheet->getSheetByName('DLH')->setCellValue('O' . $dlh->count() + 11, '=SUM(O11:O' . $dlh->count() + 10 . ')');
            $spreadsheet->getSheetByName('DLH')->setCellValue('P' . $dlh->count() + 11, '=SUM(Q11:Q' . $dlh->count() + 10 . ')');
            $spreadsheet->getSheetByName('DLH')->setCellValue('Q' . $dlh->count() + 11, '=SUM(Q11:Q' . $dlh->count() + 10 . ')');
            if ($dlh->sum('rencana_fisik') == 0) {
                $spreadsheet->getSheetByName('DLH')->setCellValue('R' . $dlh->count() + 11, '0');
            } else {
                $spreadsheet->getSheetByName('DLH')->setCellValue('R' . $dlh->count() + 11, '=P' . $dlh->count() + 11 . '/N' . $dlh->count() + 11 . '*100');
            }
        }


        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}
