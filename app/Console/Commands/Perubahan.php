<?php

namespace App\Console\Commands;

use Log;
use App\Models\Skpd;
use App\Models\Uraian;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Perubahan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'perubahan';

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
        DB::beginTransaction();
        try {
            $tahun = '2024';
            $skpd = Skpd::where('ke', '!=', null)->get();
            foreach ($skpd as $key => $item) {

                $data = Uraian::where('skpd_id', $item->id)->where('jenis_rfk', 'pergeseran')->where('tahun', $tahun)->where('ke', (int) $item->ke)->get()->toArray();

                foreach ($data as $key2 => $item2) {
                    $item2['jenis_rfk'] = 'perubahan';
                    $item2['ke'] = null;
                    Uraian::create($item2);
                }
                $item->update([
                    'murni' => 0,
                    'perubahan' => 1,
                    'pergeseran' => 0,
                ]);
            }
            DB::commit();
            $this->info('Proses selesai. Data telah diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Transaction failed: ' . $e->getMessage());
            $this->error('Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }
}
