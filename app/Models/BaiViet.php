<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    protected $table = "bai_viets";
    protected $fillable = [
        "ma_bai_viet",
        "ten_bai_viet",
        "noi_dung",
        "noi_dung_ngan",
        "hinh_anh",
        "trang_thai",
        "ma_chu_san",
        "id_chu_san"
    ];

}
