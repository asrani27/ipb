<?php

namespace App\Console\Commands;

use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\Subkegiatan;
use App\Models\MasterProgram;
use App\Models\MasterKegiatan;
use Illuminate\Console\Command;

class fixbagian extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fixbagian';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Memperbaiki kegiatan dan program milik Bagian';

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
        $id = [39, 40, 41, 42, 43, 44, 45, 46, 47];
        $data = Subkegiatan::whereIn('skpd_id', $id)->get()->map(function ($item) {
            $item->kode_program = substr($item->kode, 0, 7);
            $item->kode_kegiatan = substr($item->kode, 0, 12);
            $item->nama_program = MasterProgram::where('kode', $item->kode_program)->first() == null ? null : MasterProgram::where('kode', $item->kode_program)->first()->nama;
            $item->nama_kegiatan = MasterKegiatan::where('kode', $item->kode_kegiatan)->first() == null ? null : MasterKegiatan::where('kode', $item->kode_kegiatan)->first()->nama;
            return $item;
        });

        foreach ($data as $key => $item) {

            $checkProgram = Program::where('skpd_id', $item->skpd_id)->where('kode', $item->kode_program)->where('tahun', '2024')->first();

            if ($checkProgram == null) {
                $p = new Program;
                $p->tahun = '2024';
                $p->skpd_id = $item->skpd_id;
                $p->nama = $item->nama_program;
                $p->kode = $item->kode_program;
                $p->save();
                Subkegiatan::find($item->id)->update(['program_id' => $p->id]);
            } else {
                Subkegiatan::find($item->id)->update(['program_id' => $checkProgram->id]);
            }

            //update kegiatan 

            $checkKegiatan = Kegiatan::where('skpd_id', $item->skpd_id)->where('kode', $item->kode_kegiatan)->where('tahun', '2024')->first();
            if ($checkKegiatan == null) {
                $k = new Kegiatan;
                $k->tahun = '2024';
                $k->skpd_id = $item->skpd_id;
                $k->nama = $item->nama_kegiatan;
                $k->kode = $item->kode_kegiatan;
                $k->save();
                Subkegiatan::find($item->id)->update(['kegiatan_id' => $k->id]);
            } else {
                $checkKegiatan->update(['program_id' => $checkProgram->id]);
                Subkegiatan::find($item->id)->update(['kegiatan_id' => $checkKegiatan->id]);
            }
        }

        return 'sukses';
    }
}
