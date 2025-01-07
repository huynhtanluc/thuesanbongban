<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class QuanTriVienSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('quan_tri_viens')->delete();
        DB::table('quan_tri_viens')->insert([
            [
                'id'                => 1,
                'ma_quan_tri_vien'  => 'MASTERADMIN',
                'ho_va_ten'         => 'Master Admin',
                'email'             => 'master@gmail.com',
                'password'          => bcrypt('123456'),
                'trang_thai'        => 1,
                'is_master'         => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'id'                => 2,
                'ma_quan_tri_vien'  => 'ADMIN001',
                'ho_va_ten'         => 'Admin 1',
                'email'             => 'admin1@gmail.com',
                'password'          => bcrypt('123456'),
                'trang_thai'        => 1,
                'is_master'         => 0,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'id'                => 3,
                'ma_quan_tri_vien'  => 'ADMIN002',
                'ho_va_ten'         => 'Admin 2',
                'email'             => 'admin2@gmail.com',
                'password'          => bcrypt('123456'),
                'trang_thai'        => 1,
                'is_master'         => 0,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}
