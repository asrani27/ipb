<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permasalahan extends Model
{
    use HasFactory;
    protected $table = 't_m';
    protected $guarded = ['id'];
}
