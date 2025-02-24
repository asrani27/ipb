<?php

namespace App\Imports;

use App\Models\MasterProgram;
use App\Models\Program;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProgramImport implements ToModel, WithStartRow, WithChunkReading, ShouldQueue
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        $check = MasterProgram::where('kode', $row[10])->first();
        if ($check == null) {
            $new = new MasterProgram();
            $new->kode = $row[10];
            $new->nama = $row[11];
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
