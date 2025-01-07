<?php

namespace Database\Seeders;

use App\Models\SanBong;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CauHinhKhungGioSeeder extends Seeder
{
    public function run(): void
    {
        $list_data = SanBong::whereNotNull("id_chu_san")->get();
        $khung_gio = [
            ["07:00", "11:00", 20000],
            ["11:01", "16:00", 15000],
            ["16:01", "22:00", 30000],
        ];
        DB::table('cau_hinh_khung_gios')->delete();
        DB::table('cau_hinh_khung_gios')->truncate();
        $list_insert = [];
        foreach ($list_data as $item) {
            foreach ($khung_gio as $key => $value) {
                $list_insert[] = [
                    'id_san'                => $item->id,
                    'ma_san'                => $item->ma_san,
                    'thoi_gian_bat_dau'     => $value[0],
                    'thoi_gian_ket_thuc'    => $value[1],
                    'gia_tien_gio'          => $value[2],
                    'trang_thai'            => 1,
                    'created_at'            => now(),
                    'updated_at'            => now(),
                ];
            }
        }
        DB::table('cau_hinh_khung_gios')->insert($list_insert);
    }
}
