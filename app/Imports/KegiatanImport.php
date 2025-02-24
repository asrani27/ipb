<?php

namespace App\Imports;

use App\Models\Kegiatan;
use App\Models\MasterKegiatan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class KegiatanImport implements ToModel, WithStartRow, WithChunkReading, ShouldQueue
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        $check = MasterKegiatan::where('kode', $row[12])->first();
        if ($check == null) {
            $new = new MasterKegiatan();
            $new->kode = $row[12];
            $new->nama = strtoupper($row[13]);
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
