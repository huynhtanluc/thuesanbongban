<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KhachHangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('khach_hangs')->delete();
        DB::table('khach_hangs')->truncate();
        DB::table('khach_hangs')->insert([
            [
                'ma_khach_hang'  => 'KH001',
                'ho_va_ten'      => 'Nguyễn Văn An',
                'email'          => 'nguyenvanan@gmail.com',
                'password'       => bcrypt('123456'),
                'ngay_sinh'      => '1990-01-15',
                'so_dien_thoai'  => '0123456789',
                'chung_minh_thu' => '123456789',
                'anh'            => null,
                'gioi_tinh'      => 1,
                'tinh_trang'     => 1,
                'hash_reset'     => null,
                'id_chu_san'     => 0,
                'hash_active'    => null,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'ma_khach_hang'  => 'KH002',
                'ho_va_ten'      => 'Trần Thị Bình',
                'email'          => 'tranthiminh@gmail.com',
                'password'       => bcrypt('123456'),
                'ngay_sinh'      => '1995-05-20',
                'so_dien_thoai'  => '0987654321',
                'chung_minh_thu' => '987654321',
                'anh'            => null,
                'gioi_tinh'      => 0,
                'tinh_trang'     => 1,
                'hash_reset'     => null,
                'id_chu_san'     => 0,
                'hash_active'    => null,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'ma_khach_hang'  => 'KH003',
                'ho_va_ten'      => 'Lê Văn Cường',
                'email'          => 'levancuong@gmail.com',
                'password'       => bcrypt('123456'),
                'ngay_sinh'      => '1988-12-10',
                'so_dien_thoai'  => '0369852147',
                'chung_minh_thu' => '147258369',
                'anh'            => null,
                'gioi_tinh'      => 1,
                'tinh_trang'     => 1,
                'hash_reset'     => null,
                'id_chu_san'     => 0,
                'hash_active'    => null,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}
