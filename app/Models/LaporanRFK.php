<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanRFK extends Model
{
    use HasFactory;
    protected $table = 'laporan_rfk';
    protected $guarded = ['id'];
}
