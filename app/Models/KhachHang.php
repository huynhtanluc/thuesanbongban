<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class KhachHang extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'khach_hangs';

    protected $fillable = [
        'ma_khach_hang',
        'ho_va_ten',
        'email',
        'password',
        'ngay_sinh',
        'so_dien_thoai',
        'chung_minh_thu',
        'anh',
        'gioi_tinh',
        'tinh_trang',
        'hash_reset',
        'hash_active',
        'id_chu_san'
    ];
}
