<?php

namespace App\Imports;

use App\Models\MasterSubKegiatan;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class SubKegiatanImport implements ToModel, WithStartRow, WithChunkReading, ShouldQueue
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $check = MasterSubKegiatan::where('kode', $row[14])->first();
        if ($check == null) {
            $new = new MasterSubKegiatan();
            $new->kode = $row[14];
            $new->nama = $row[15];
            $new->save();
        } else {
        }
    }
    public function startRow(): int
    {
        return 2;
    }
    public function chunkSize(): int
    {
        return 500; // Import 500 data per batch
    }
}
