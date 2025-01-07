<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class QuanTriVien extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'quan_tri_viens';
    protected $fillable = [
        'ma_quan_tri_vien',
        'ho_va_ten',
        'email',
        'password',
        'trang_thai',
        'ma_chuc_vu',
        'id_chuc_vu',
        'is_master'
    ];
}
