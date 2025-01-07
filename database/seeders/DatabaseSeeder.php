<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            KhachHangSeeder::class,
            KhuVucSeeder::class,
            SanBongSeeder::class,
            QuanTriVienSeeder::class,
            ChuSanSeeder::class,
            CauHinhKhungGioSeeder::class,
            BaiVietSeeder::class,
            LichDatSanSeeder::class,
            ChiTietChuSanKhachHangSeeder::class,
            ThanhPhoSeeder::class,
            QuanHuyenSeeder::class,
            PhuongXaSeeder::class,
            MatBangSeeder::class,
        ]);
    }
}
