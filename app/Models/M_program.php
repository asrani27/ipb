<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_program extends Model
{
    use HasFactory;
    protected $table = 'm_program';
    protected $guarded = ['id'];

    public function kegiatan()
    {
        return $this->hasMany(M_kegiatan::class, 'm_program_id');
    }
}
