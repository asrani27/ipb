<?php

namespace App\Console\Commands;

use App\Models\Kegiatan;
use App\Models\Permasalahan;
use App\Models\Subkegiatan;
use Illuminate\Console\Command;

class PermasalahanCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fixpermasalahan {--tahun=} {--bulan=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        // Ambil nilai tahun dan bulan dari parameter
        $tahun = $this->option('tahun') ?? date('Y'); // Default tahun saat ini jika tidak diberikan
        $bulan = $this->option('bulan') ?? date('m'); // Default bulan saat ini jika tidak diberikan

        $subkegiatan = Subkegiatan::where('tahun', $tahun)->where('jenis_rfk', 'murni')->get();
        foreach ($subkegiatan as $key => $item) {
            $check = $item->masalah->where('tahun', $tahun)->where('bulan', $bulan)->count();
            if ($check === 0) {
                $param['tahun'] = $tahun;
                $param['bulan'] = $bulan;
                $param['program_id'] = $item->program_id;
                $param['kegiatan_id'] = $item->kegiatan_id;
                $param['subkegiatan_id'] = $item->id;
                $param['skpd_id'] = $item->skpd_id;

                $param['deskripsi'] = 'tidak ada masalah';
                $param['permasalahan'] = 'tidak ada masalah';
                $param['upaya'] = 'tidak ada masalah';
                $param['pihak_pembantu'] = 'tidak ada masalah';

                Permasalahan::create($param);

                $this->info("Data berhasil disimpan untuk Subkegiatan ID: {$item->id}");
            }
        }

        return 0;
    }
}
