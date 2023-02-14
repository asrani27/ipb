<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_akun extends Model
{
    use HasFactory;
    protected $table = 'm_akun';
    protected $guarded = ['id'];
    public $timestamps = false;
}
