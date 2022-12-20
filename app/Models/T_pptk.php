<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_pptk extends Model
{
    use HasFactory;
    protected $table = 't_pptk';
    protected $guarded = ['id'];
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }
    public function subkegiatan()
    {
        return $this->belongsTo(Subkegiatan::class, 'subkegiatan_id');
    }
}
