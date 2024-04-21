<?php

namespace App\Console\Commands;

use App\Models\MasterProgram;
use App\Models\MasterKegiatan;
use Illuminate\Console\Command;
use App\Models\MasterSubKegiatan;
use Illuminate\Support\Facades\Http;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class TarikDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tarikdata';

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
        $path = public_path('/excel/kodepks.xlsx');

        $reader = new Xlsx();
        $spreadsheet = $reader->load($path);
        $sheet = $spreadsheet->getActiveSheet();
        /** Load $inputFileName to a Spreadsheet Object  **/
        $sheetInfo = $reader->listWorksheetInfo($path);
        $totalRows = $sheetInfo[0]['totalRows'];
        $data = [];
        for ($row = 4; $row <= $totalRows; $row++) {
            $kode = $sheet->getCell("B{$row}")->getValue();
            $nama = $sheet->getCell("C{$row}")->getValue();
            $data[] = [
                'kode' => $kode,
                'nama' => $nama
            ];
        }

        foreach ($data as $key => $item) {
            if (strlen($item['kode']) == 7) {
                //program
                $p = new MasterProgram();
                $p->nama = $item['nama'];
                $p->kode = $item['kode'];
                $p->save();
            }
            if (strlen($item['kode']) == 12) {
                //kegiatan
                $k = new MasterKegiatan();
                $k->nama = $item['nama'];
                $k->kode = $item['kode'];
                $k->kode_program = substr($item['kode'], 0, 7);
                $k->save();
            }
            if (strlen($item['kode']) == 17) {
                //subkegiatan
                $s = new MasterSubKegiatan();
                $s->nama = $item['nama'];
                $s->kode = $item['kode'];
                $s->kode_program = substr($item['kode'], 0, 7);
                $s->kode_kegiatan = substr($item['kode'], 0, 12);
                $s->save();
            }
        }
    }
}
