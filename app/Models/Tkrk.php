<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tkrk extends Model
{
    use HasFactory;
    protected $table = 't_krk';
    protected $guarded = ['id'];

    public function permohonan()
    {
        return $this->belongsTo(Tpermohonan::class, 't_permohonan_id');
    }
}
