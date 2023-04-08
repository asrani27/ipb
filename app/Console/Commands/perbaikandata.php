<?php

namespace App\Console\Commands;

use App\Models\Uraian;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\Subkegiatan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class perbaikandata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'perbaikandata';

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
        //menambah field jenis_rfk di program, kegiatan, subkegiatan, dan uraian, mengisi data jenis rfk
        //dd(Auth::user()->skpd);
        $program = Program::get();
        foreach ($program as $item) {
            $item->update(['jenis_rfk' => 'murni']);
        }

        $kegiatan = Kegiatan::get();
        foreach ($kegiatan as $item) {
            $item->update(['jenis_rfk' => 'murni']);
        }

        $subkegiatan = Subkegiatan::get();
        foreach ($subkegiatan as $item) {
            $item->update(['jenis_rfk' => 'murni']);
        }

        $uraian = Uraian::get();
        foreach ($uraian as $item) {
            $item->update(['jenis_rfk' => 'murni']);
        }
        // foreach ($program as $key => $item) {
        //     if ($item->skpd_id == null) {
        //         $item->update([
        //             'skpd_id' => $item->bidang->skpd_id,
        //         ]);
        //     }
        // }

        // $kegiatan = Kegiatan::get();

        // foreach ($kegiatan as $key => $item) {
        //     if ($item->bidang_id == null) {
        //         $item->update([
        //             'bidang_id' => $item->program->bidang_id,
        //         ]);
        //     }
        //     if ($item->skpd_id == null) {
        //         $item->update([
        //             'skpd_id' => $item->program->skpd_id,
        //         ]);
        //     }
        //     if ($item->tahun == null) {
        //         $item->update([
        //             'tahun' => $item->program->tahun,
        //         ]);
        //     }
        // }
        // foreach ($data as $key => $item) {
        //     $item->update([
        //         'p_januari_fisik' => $item->p_januari_keuangan == 0 ? 0 : ($item->p_januari_keuangan / $item->dpa) * 100,
        //         'p_februasi_fisik' => $item->p_februasi_keuangan == 0 ? 0 : ($item->p_februasi_keuangan / $item->dpa) * 100,
        //         'p_maret_fisik' => $item->p_maret_keuangan == 0 ? 0 : ($item->p_maret_keuangan / $item->dpa) * 100,
        //         'p_april_fisik' => $item->p_april_keuangan == 0 ? 0 : ($item->p_april_keuangan / $item->dpa) * 100,
        //         'p_mei_fisik' => $item->p_mei_keuangan == 0 ? 0 : ($item->p_mei_keuangan / $item->dpa) * 100,
        //         'p_juni_fisik' => $item->p_juni_keuangan == 0 ? 0 : ($item->p_juni_keuangan / $item->dpa) * 100,
        //         'p_juli_fisik' => $item->p_juli_keuangan == 0 ? 0 : ($item->p_juli_keuangan / $item->dpa) * 100,
        //         'p_agustus_fisik' => $item->p_agustus_keuangan == 0 ? 0 : ($item->p_agustus_keuangan / $item->dpa) * 100,
        //         'p_september_fisik' => $item->p_september_keuangan == 0 ? 0 : ($item->p_september_keuangan / $item->dpa) * 100,
        //         'p_oktober_fisik' => $item->p_oktober_keuangan == 0 ? 0 : ($item->p_oktober_keuangan / $item->dpa) * 100,
        //         'p_november_fisik' => $item->p_november_keuangan == 0 ? 0 : ($item->p_november_keuangan / $item->dpa) * 100,
        //         'p_desember_fisik' => $item->p_desember_keuangan == 0 ? 0 : ($item->p_desember_keuangan / $item->dpa) * 100
        //     ]);
        // }
    }
}
