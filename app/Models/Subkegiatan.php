<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subkegiatan extends Model
{
    use HasFactory;
    protected $table = 'subkegiatan';
    protected $guarded = ['id'];

    public function pptk()
    {
        return $this->belongsTo(PPTK::class, 'pptk_id');
    }
    public function kode_program()
    {
        $string = $this->kode;

        // Memecah string menjadi array berdasarkan titik
        $parts = explode('.', $string);

        // Menggabungkan 3 bagian pertama
        return implode('.', array_slice($parts, 0, 3));
    }
    public function kode_kegiatan()
    {
        $string = $this->kode;

        // Memecah string menjadi array berdasarkan titik
        $parts = explode('.', $string);

        // Menggabungkan 3 bagian pertama
        return implode('.', array_slice($parts, 0, 5));
    }

    public function skpd()
    {
        return $this->belongsTo(Skpd::class, 'skpd_id');
    }
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id');
    }
    public function uraian()
    {
        return $this->hasMany(Uraian::class, 'subkegiatan_id');
    }
    public function masalah()
    {
        return $this->hasMany(T_m::class, 'subkegiatan_id');
    }
    public function uraianmurni()
    {
        return $this->hasMany(Uraian::class, 'subkegiatan_id')->where('jenis_rfk', 'murni');
    }
    public function uraianpergeseran()
    {
        return $this->hasMany(Uraian::class, 'subkegiatan_id')->where('jenis_rfk', 'pergeseran');
    }
    public function uraianperubahan()
    {
        return $this->hasMany(Uraian::class, 'subkegiatan_id')->where('jenis_rfk', 'perubahan');
    }
}
