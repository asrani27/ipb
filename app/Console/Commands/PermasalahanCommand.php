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
    protected $signature = 'fixpermasalahan';

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
        $subkegiatan = Subkegiatan::where('tahun', '2024')->where('jenis_rfk', 'murni')->get();
        foreach ($subkegiatan as $key => $item) {
            $check = $item->masalah->where('tahun', '2024')->where('bulan', '11')->count();
            if ($check === 0) {
                $param['tahun'] = '2024';
                $param['bulan'] = '11';
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
        // $data = Permasalahan::get()->map(function ($item) {
        //     $item->skpd_id = Kegiatan::find($item->kegiatan_id) == null ? 0 : Kegiatan::find($item->kegiatan_id)->skpd_id;
        //     $item->save();
        //     return $item;
        // });
    }
}
