<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSubKegiatan extends Model
{
    use HasFactory;
    protected $table = 'master_subkegiatan';
    protected $guarded = ['id']; // Tambahkan ini
}
