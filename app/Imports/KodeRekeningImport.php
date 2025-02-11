<?php

namespace App\Imports;

use App\Models\KodeRekening;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class KodeRekeningImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Pastikan indeks yang diakses ada di dalam array
        if (!isset($row[2]) || !isset($row[3])) {
            return null; // Lewati baris jika data tidak lengkap
        }

        return KodeRekening::firstOrCreate(
            ['kode_akun' => $row[2]], // Cek berdasarkan kode_akun
            ['kode_akun' => $row[2], 'nama_akun' => $row[3]]  // Jika belum ada, simpan nama_akun
        );
    }
    public function startRow(): int
    {
        return 2;
    }
}
