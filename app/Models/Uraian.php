<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uraian extends Model
{
    use HasFactory;
    protected $table = 'uraiansubkegiatan';
    protected $guarded = ['id'];
    public function subkegiatan()
    {
        return $this->belongsTo(Subkegiatan::class, 'subkegiatan_id');
    }
}
