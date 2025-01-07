<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChiTietChuSanKhachHangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('chi_tiet_khach_hang_chu_sans')->delete();
        DB::table('chi_tiet_khach_hang_chu_sans')->truncate();
        DB::table('chi_tiet_khach_hang_chu_sans')->insert([
            'id_khach_hang' => 3,
            'id_chu_san' => 1,
            'is_chu_san_tao' => 1,
        ]);
    }
}
