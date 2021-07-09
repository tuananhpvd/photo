<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hoadons extends Model
{
    use HasFactory;
    protected $table='hoadons';
    protected $fillable = ['lop_id','ngay','gvbm','noidung','giay_id','sotrang','soluong','ghichu'];    

public function lops()
{
        return $this->belongsTo('App\Models\Lops');
}
}
