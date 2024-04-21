<?php

namespace App\Console\Commands;

use App\Models\Kegiatan;
use App\Models\MasterKegiatan;
use App\Models\MasterProgram;
use App\Models\MasterSubKegiatan;
use App\Models\Program;
use App\Models\Subkegiatan;
use Illuminate\Console\Command;

class PerbaikanDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fixdata';

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
        $subkegiatan = Subkegiatan::where('tahun', '2024')->get();
        foreach ($subkegiatan as $key => $item) {
            $check = MasterSubKegiatan::where('nama', 'LIKE', '%' . $item->nama . '%')->first();
            if ($check == null) {
            } else {
                $item->update(['kode' => $check->kode]);
                //simpan kode program dan kegiatan
                $checkProgram = Program::where('kode', $check->kode_program)->where('tahun', '2024')->where('skpd_id', $item->skpd_id)->first();
                if ($checkProgram == null) {
                    //tambah
                    $p = new Program();
                    $p->skpd_id = $item->skpd_id;
                    $p->tahun = '2024';
                    $p->nama = MasterProgram::where('kode', $check->kode_program)->first()->nama;
                    $p->kode = $check->kode_program;
                    $p->jenis_rfk = 'murni';
                    $p->save();
                    $item->update(['program_id' => $p->id]);
                } else {
                    $item->update(['program_id' => $checkProgram->id]);
                }

                //simpan kode kegiatan
                $checkKegiatan = Kegiatan::where('kode', $check->kode_kegiatan)->where('tahun', '2024')->where('skpd_id', $item->skpd_id)->first();
                if ($checkKegiatan == null) {
                    //tambah
                    $k = new Kegiatan();
                    $k->skpd_id = $item->skpd_id;
                    $k->tahun = '2024';
                    $k->program_id = Program::where('kode', $check->kode_program)->where('skpd_id', $item->skpd_id)->where('tahun', '2024')->first()->id;
                    $k->nama = MasterKegiatan::where('kode', $check->kode_kegiatan)->first()->nama;
                    $k->kode = $check->kode_kegiatan;
                    $k->jenis_rfk = 'murni';
                    $k->save();
                    $item->update(['kegiatan_id' => $k->id]);
                } else {
                    $item->update(['kegiatan_id' => $checkKegiatan->id]);
                }
            }
        }
    }
}
