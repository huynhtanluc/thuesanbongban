<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KhuVucSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('khu_vucs')->delete();
        DB::table('khu_vucs')->insert([
            [
                'id'            => 1,
                'ma_khu_vuc'    => 'KV001',
                'ten_khu_vuc'   => 'Loại Sân A',
                'trang_thai'    => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'id'            => 2,
                'ma_khu_vuc'    => 'KV002',
                'ten_khu_vuc'   => 'Loại Sân B',
                'trang_thai'    => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'id'            => 3,
                'ma_khu_vuc'    => 'KV003',
                'ten_khu_vuc'   => 'Loại Sân C',
                'trang_thai'    => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'id'            => 4,
                'ma_khu_vuc'    => 'KV004',
                'ten_khu_vuc'   => 'Loại Sân D',
                'trang_thai'    => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'id'            => 5,
                'ma_khu_vuc'    => 'KV005',
                'ten_khu_vuc'   => 'Loại Sân E',
                'trang_thai'    => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
