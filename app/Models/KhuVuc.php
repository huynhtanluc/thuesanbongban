<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhuVuc extends Model
{
    protected $table = 'khu_vucs';

    protected $fillable = [
        'ma_khu_vuc',
        'ten_khu_vuc',
        'trang_thai',
        'id_chu_san'
    ];
}
