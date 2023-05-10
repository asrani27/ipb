<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subkegiatan extends Model
{
    use HasFactory;
    protected $table = 'subkegiatan';
    protected $guarded = ['id'];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }
    public function uraian()
    {
        return $this->hasMany(Uraian::class, 'subkegiatan_id');
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
