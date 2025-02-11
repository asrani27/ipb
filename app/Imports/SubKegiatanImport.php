<?php

namespace App\Imports;

use App\Models\MasterSubKegiatan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class SubKegiatanImport implements ToModel, WithStartRow, WithChunkReading
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
        // Pecah string menjadi array berdasarkan titik
        $parts = explode('.', $row[0]);

        // Ambil bagian untuk "kegiatan" (8 digit pertama)
        $kegiatan = implode('.', array_slice($parts, 0, 5));

        // Ambil bagian untuk "program" (5 digit pertama)
        $program = implode('.', array_slice($parts, 0, 3));

        return MasterSubKegiatan::firstOrCreate(
            ['kode' => $row[0]], // Cek berdasarkan kode_akun
            ['kode_program' => $program, 'kode_kegiatan' => $kegiatan, 'kode' => $row[0], 'nama' => $row[1]]  // Jika belum ada, simpan nama_akun
        );
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
