<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThueSan extends Model
{
    protected $table = 'thue_sans';
    protected $fillable = [
        'ma_thue_san',
        'thoi_gian_bat_dau',
        'thoi_gian_ket_thuc',
        'so_gio_thue',
        'trang_thai',
        'thanh_tien',
        'ma_khach_hang',
        'id_khach_hang',
        'ma_san',
        'id_san',
        'thanh_toan',
        'so_tien_coc',
    ];

}
