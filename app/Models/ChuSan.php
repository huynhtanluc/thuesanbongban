<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ChuSan extends Model
{
    protected $table = 'chu_sans';
    protected $fillable = [
        'ma_chu_san',
        'gia_thue_san',
        'thoi_han',
        'trang_thai_duyet',
        'ma_khach_hang',
        'id_khach_hang',
        'ma_san',
        'id_san',
        'ma_quan_tri_vien',
        'id_quan_tri_vien',
        'id_mat_bang',
    ];

    public function scopeCheckSanAvailable($query, $id_san)
    {
        return $query->where('id_san', $id_san)
                    ->where('trang_thai_duyet', 1)
                    ->where(function($q) {
                        $q->whereRaw('DATE_ADD(created_at, INTERVAL thoi_han MONTH) > ?', [Carbon::now()]);
                    })
                    ->exists();
    }
}
