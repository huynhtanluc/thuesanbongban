<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CauHinhKhungGio extends Model
{
    protected $table = 'cau_hinh_khung_gios';
    protected $fillable = [
        'ma_khung_gio',
        'thoi_gian_bat_dau',
        'thoi_gian_ket_thuc',
        'gia_tien_gio',
        'trang_thai',
        'ma_san',
        'id_san',
    ];
}
