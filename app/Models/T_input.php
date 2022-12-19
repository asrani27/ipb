<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_input extends Model
{
    use HasFactory;
    protected $table = 't_input';
    protected $guarded = ['id'];

    public function uraiankegiatan()
    {
        return $this->belongsTo(Uraian::class, 'uraian_id');
    }

    public function st()
    {
        return $this->hasMany(T_st::class, 't_input_id');
    }
    public function pbj()
    {
        return $this->hasMany(T_pbj::class, 't_input_id');
    }
    public function kppbj()
    {
        return $this->hasMany(T_kppbj::class, 't_input_id');
    }
    public function m()
    {
        return $this->hasMany(T_m::class, 't_input_id');
    }
}
