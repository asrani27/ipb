<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_kegiatan extends Model
{
    use HasFactory;

    protected $table = 'm_kegiatan';
    protected $guarded = ['id'];

    public function program()
    {
        return $this->belongsTo(M_program::class, 'm_program_id');
    }

    public function subkegiatan()
    {
        return $this->hasMany(M_subkegiatan::class, 'm_kegiatan_id');
    }
}
