<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tpermohonan extends Model
{
    use HasFactory;
    protected $table = 't_permohonan';
    protected $guarded = ['id'];

    public function krk()
    {
        return $this->hasOne(Tkrk::class, 't_permohonan_id');
    }
}
