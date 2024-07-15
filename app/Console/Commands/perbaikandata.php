<?php

namespace App\Console\Commands;

use App\Models\Uraian;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\M_kegiatan;
use App\Models\M_program;
use App\Models\M_subkegiatan;
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
        $data = Subkegiatan::whereIn('skpd_id', [39, 40, 41, 42, 43, 44, 45, 46, 47])->get();
        //$data = Subkegiatan::whereIn('skpd_id', [39])->get();
        foreach ($data as $i) {
            foreach ($i->uraian as $k) {
                $k->update(['skpd_id' => $i->skpd_id]);
                $check = Uraian::where('skpd_id', $i->skpd_id)->where('jenis_rfk', 'pergeseran')->where('ke', 1)->first();
                if ($check == null) {
                    $param = $k->toArray();
                    $param['jenis_rfk'] = 'pergeseran';
                    $param['ke'] = 1;

                    Uraian::create($param);
                } else {
                }
            }
        }
    }
}
