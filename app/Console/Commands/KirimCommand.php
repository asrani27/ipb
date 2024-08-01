<?php

namespace App\Console\Commands;

use App\Models\Skpd;
use App\Models\LaporanRFK;
use App\Models\Subkegiatan;
use Illuminate\Console\Command;

class KirimCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kirimAdmin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim Laporan RFK Ke Admin Pembangunan';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $bulan = 'januari';
        $tahun = '2024';
        $skpd = Skpd::where('is_aktif', 1)->get();
        foreach ($skpd as $org) {
            $jenis = jenisRfk($bulan, $tahun);
            $check = LaporanRFK::where('tahun', $tahun)->where('bulan', nomorBulan(ucfirst($bulan)))->where('skpd_id', $org->id)->first();
            if ($check == null) {
                $dataskpd = Subkegiatan::where('tahun', $tahun)->where('skpd_id', $org->id)->get()->map(function ($item) use ($bulan, $jenis) {
                    if ($jenis == 'pergeseran') {
                        $ke = $org->ke;
                        $item->dpa = $item->uraian->where('jenis_rfk', $jenis)->where('ke', $ke)->sum('dpa');
                    } else {
                        $item->dpa = $item->uraian->where('jenis_rfk', $jenis)->sum('dpa');
                    }

                    $item->rencana = rencanaSKPD($bulan, $item, $jenis);
                    $item->realisasi = realisasiSKPD($bulan, $item, $jenis);
                    $item->rencana_fisik = rencanaKumSkpd($item->id, $jenis, $bulan);
                    $item->realisasi_fisik = realisasiKumSkpd($item->id, $jenis, $bulan);
                    return $item->only('id', 'tahun', 'skpd_id', 'bidang_id', 'program_id', 'kegiatan_id', 'nama', 'jenis_rfk', 'pptk_id', 'kode', 'dpa', 'rencana', 'realisasi', 'rencana_fisik', 'realisasi_fisik');
                });
                $data = json_encode($dataskpd);

                $param['bulan'] = nomorBulan(ucfirst($bulan));
                $param['tahun'] = $tahun;
                $param['jenis'] = $jenis;
                if ($jenis == 'pergeseran') {
                    $param['ke'] = $org->ke;
                } else {
                    $param['ke'] = null;
                }
                $param['skpd_id'] = $org->id;
                $param['data'] = $data;
                $param['status'] = null;

                LaporanRFK::create($param);
            }
        }
    }
}
