<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatasInput extends Model
{
    use HasFactory;
    protected $table = 'batas_input';
    protected $guarded = ['id'];
}
