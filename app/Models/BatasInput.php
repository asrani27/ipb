<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatasInput extends Model
{
    use HasFactory;
    protected $table = 'batasinput';
    protected $guarded = ['id'];
}
