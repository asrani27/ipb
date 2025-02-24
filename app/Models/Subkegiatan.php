<?php

namespace App\Models;

use App\Models\T_m;
use App\Models\PPTK;
use App\Models\Skpd;
use App\Models\Uraian;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\Kelurahan;
use App\Models\MasterProgram;
use App\Models\MasterKegiatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public function nama_program()
    {
        $program = MasterProgram::where('kode', $this->kode_program())->first();
        if ($program) {
            return $program->nama;
        } else {
            return '-';
        }
    }
    public function kode_kegiatan()
    {
        $string = $this->kode;

        // Memecah string menjadi array berdasarkan titik
        $parts = explode('.', $string);

        // Menggabungkan 3 bagian pertama
        return implode('.', array_slice($parts, 0, 5));
    }

    public function nama_kegiatan()
    {
        $kegiatan = MasterKegiatan::where('kode', $this->kode_kegiatan())->first();
        if ($kegiatan) {
            return $kegiatan->nama;
        } else {
            return '-';
        }
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
