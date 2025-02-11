<?php

namespace App\Imports;

use App\Models\MasterSubKegiatan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SubKegiatanImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Pastikan indeks yang diakses ada di dalam array
        if (!isset($row[0]) || !isset($row[1])) {
            return null; // Lewati baris jika data tidak lengkap
        }

        return MasterSubKegiatan::firstOrCreate(
            ['kode' => $row[0]], // Cek berdasarkan kode_akun
            ['kode' => $row[0], 'nama' => $row[1]]  // Jika belum ada, simpan nama_akun
        );
    }
    public function startRow(): int
    {
        return 2;
    }
}
