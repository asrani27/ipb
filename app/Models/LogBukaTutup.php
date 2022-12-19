<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogBukaTutup extends Model
{
    use HasFactory;
    protected $table = 'log_buka_tutup';
    protected $guarded = ['id'];
}
