<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_subkegiatan extends Model
{
    use HasFactory;

    protected $table = 'm_subkegiatan';
    protected $guarded = ['id'];
    public function kegiatan()
    {
        return $this->belongsTo(M_kegiatan::class, 'm_kegiatan_id');
    }
}
