<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThanhPho extends Model
{
    protected $table = 'thanh_phos';
    protected $fillable = ['ma_thanh_pho', 'ten_thanh_pho', 'trang_thai'];
}
