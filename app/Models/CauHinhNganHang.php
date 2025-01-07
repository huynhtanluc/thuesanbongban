<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CauHinhNganHang extends Model
{
    protected $table = 'cau_hinh_ngan_hangs';
    protected $fillable = [
        'ma_cau_hinh_ngan_hang',
        'ten_chu_tai_khoan',
        'so_tai_khoan',
        'ngan_hang',
        'anh_qr',
        'trang_thai',
        'ma_khach_hang',
        'id_khach_hang',
    ];
}
