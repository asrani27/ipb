<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_m extends Model
{
    use HasFactory;
    protected $table = 't_m';
    protected $guarded = ['id'];
    public function t_input()
    {
        return $this->belongsTo(T_input::class, 't_input_id');
    }
}
