<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanBong extends Model
{
    protected $table = 'san_bongs';

    protected $fillable = [
        'ma_san',
        'ten_san',
        'dien_tich',
        'gia_dau_thau',
        'trang_thai',
        'trang_thai_dau_thau',
        'phan_tram_coc',
        'id_chu_san',
        'id_khu_vuc',
    ];
}
