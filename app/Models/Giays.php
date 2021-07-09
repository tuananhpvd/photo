<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giays extends Model
{
    use HasFactory;
    protected $table='giays';
    protected $fillable = ['loaigiay','tien'];  

}
