<?php

namespace App\Console\Commands;

use App\Models\Kegiatan;
use App\Models\Permasalahan;
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
        $data = Permasalahan::get()->map(function ($item) {
            $item->skpd_id = Kegiatan::find($item->kegiatan_id) == null ? 0 : Kegiatan::find($item->kegiatan_id)->skpd_id;
            $item->save();
            return $item;
        });
    }
}
