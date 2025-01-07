<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietKhachHangChuSan extends Model
{
    protected $table = 'chi_tiet_khach_hang_chu_sans';
    protected $fillable = ['id_khach_hang', 'id_chu_san', 'is_chu_san_tao'];
}
