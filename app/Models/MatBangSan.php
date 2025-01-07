<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatBangSan extends Model
{
    protected $table = 'mat_bang_sans';
    protected $fillable = [
        'ma_mat_bang',
        'id_chu_san',
        'dia_chi',
        'trang_thai',
        'id_thanh_pho',
        'id_quan_huyen',
        'id_phuong_xa'
    ];
}
