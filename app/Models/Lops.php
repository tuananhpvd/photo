<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lops extends Model
{
    use HasFactory;
    protected $table='lops';
        protected $fillable = ['tenlop','siso','noptien','gvcn']; 

public function hoadons()
{
        return $this->hasMany('App\Models\Hoadons');
}
}
