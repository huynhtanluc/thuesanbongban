<?php

namespace Database\Seeders;

use App\Models\ChuSan;
use App\Models\SanBong;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChuSanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('chu_sans')->delete();
        DB::table('chu_sans')->truncate();
        DB::table('chu_sans')->insert([
            [
                'id_khach_hang'         => 1,
                'id_san'                => 1,
                'id_quan_tri_vien'      => 1,
                'ma_chu_san'            => 'CS001',
                'ma_san'                => 'SB001',
                'ma_khach_hang'         => 'KH001',
                'ma_quan_tri_vien'      => 'QTV001',
                'gia_thue_san'          => 2000000,
                'thoi_han'              => '2024-12-31',
                'trang_thai_duyet'      => 1,
                'id_mat_bang'           => 1,
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
            [
                'id_khach_hang'         => 1,
                'id_san'                => 2,
                'id_quan_tri_vien'      => 1,
                'ma_chu_san'            => 'CS001',
                'ma_san'                => 'SB002',
                'ma_khach_hang'         => 'KH001',
                'ma_quan_tri_vien'      => 'QTV001',
                'gia_thue_san'          => 1800000,
                'thoi_han'              => '2024-12-31',
                'trang_thai_duyet'      => 1,
                'id_mat_bang'           => 2,
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
            [
                'id_khach_hang'         => 1,
                'id_san'                => 3,
                'id_quan_tri_vien'      => 1,
                'ma_chu_san'            => 'CS001',
                'ma_san'                => 'SB003',
                'ma_khach_hang'         => 'KH001',
                'ma_quan_tri_vien'      => 'QTV001',
                'gia_thue_san'          => 2200000,
                'thoi_han'              => '2024-12-31',
                'trang_thai_duyet'      => 1,
                'id_mat_bang'           => 3,
                'created_at'            => now(),
                'updated_at'            => now(),
            ],

            // Chủ sân 2 - quản lý 4 sân
            [
                'id_khach_hang'         => 2,
                'id_san'                => 4,
                'id_quan_tri_vien'      => 1,
                'ma_chu_san'            => 'CS002',
                'ma_san'                => 'SB004',
                'ma_khach_hang'         => 'KH002',
                'ma_quan_tri_vien'      => 'QTV001',
                'gia_thue_san'          => 1900000,
                'thoi_han'              => '2024-12-31',
                'trang_thai_duyet'      => 1,
                'id_mat_bang'           => 6,
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
            [
                'id_khach_hang'         => 2,
                'id_san'                => 5,
                'id_quan_tri_vien'      => 1,
                'ma_chu_san'            => 'CS002',
                'ma_san'                => 'SB005',
                'ma_khach_hang'         => 'KH002',
                'ma_quan_tri_vien'      => 'QTV001',
                'gia_thue_san'          => 1700000,
                'thoi_han'              => '2024-12-31',
                'trang_thai_duyet'      => 1,
                'id_mat_bang'           => 7,
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
            [
                'id_khach_hang'         => 2,
                'id_san'                => 6,
                'id_quan_tri_vien'      => 1,
                'ma_chu_san'            => 'CS002',
                'ma_san'                => 'SB006',
                'ma_khach_hang'         => 'KH002',
                'ma_quan_tri_vien'      => 'QTV001',
                'gia_thue_san'          => 2100000,
                'thoi_han'              => '2024-12-31',
                'trang_thai_duyet'      => 1,
                'id_mat_bang'           => 8,
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
            [
                'id_khach_hang'         => 2,
                'id_san'                => 7,
                'id_quan_tri_vien'      => 1,
                'ma_chu_san'            => 'CS002',
                'ma_san'                => 'SB007',
                'ma_khach_hang'         => 'KH002',
                'ma_quan_tri_vien'      => 'QTV001',
                'gia_thue_san'          => 2000000,
                'thoi_han'              => '2024-12-31',
                'trang_thai_duyet'      => 1,
                'id_mat_bang'           => 9,
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
        ]);

        $list = ChuSan::all();
        foreach ($list as $key => $value) {
            SanBong::where("id", $value->id_san)->update(["id_chu_san" => $value->id]);
        }
    }
}
