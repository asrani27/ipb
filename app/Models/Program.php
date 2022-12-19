<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $table = 'program';
    protected $guarded = ['id'];

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'program_id');
    }
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }
}
