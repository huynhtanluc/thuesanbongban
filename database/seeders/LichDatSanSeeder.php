<?php

namespace Database\Seeders;

use App\Models\ChuSan;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LichDatSanSeeder extends Seeder
{
    public function run(): void
    {
        {
            DB::table('thue_sans')->delete();
            DB::table('thue_sans')->truncate();

            $bookings = [];
            $timeSlots = [
                ['07:00', '11:00'],
                ['11:01', '16:00'],
                ['16:01', '22:00']
            ];

            $customers = [
                ['id' => 1, 'ma_khach_hang' => 'KH001'],
                ['id' => 2, 'ma_khach_hang' => 'KH002'],
                ['id' => 3, 'ma_khach_hang' => 'KH003']
            ];

            $list_chu_san = [
                ['id' => 1, 'ma_khach_hang' => 'KH001'],
                ['id' => 2, 'ma_khach_hang' => 'KH002'],
            ];

            for($i = 1; $i <= 50; $i++) {
                // Random date between Dec 25-31, 2024
                $date = Carbon::create(2025, 1, rand(1, 10));

                // Random time slot
                $timeSlot = $timeSlots[array_rand($timeSlots)];

                // Random customer
                $customer = $customers[array_rand($customers)];
                $chu_san  = $list_chu_san[array_rand($list_chu_san)];

                $san      = ChuSan::join('san_bongs', 'chu_sans.id_san', 'san_bongs.id')
                                  ->where('id_khach_hang', $chu_san['id'])
                                  ->select('san_bongs.*')
                                  ->inRandomOrder()->first();

                $startTime = Carbon::parse($date->format('Y-m-d') . ' ' . $timeSlot[0]);
                $endTime = Carbon::parse($date->format('Y-m-d') . ' ' . $timeSlot[1]);
                $hours = $startTime->diffInHours($endTime);
                $thanh_tien = round($hours * (rand(15, 30) * 1000), -3);
                $tien_coc   = round($thanh_tien * 0.3, -3);
                $thanh_toan = Carbon::today() >= $startTime ? 2 : rand(0, 2);

                $bookings[] = [
                    'ma_thue_san'        => 'TS' . str_pad($i, 3, '0', STR_PAD_LEFT),
                    'thoi_gian_bat_dau'  => $startTime,
                    'thoi_gian_ket_thuc' => $endTime,
                    'so_gio_thue'        => $hours,
                    'trang_thai'         => $thanh_toan == 2 ? 1 : ($thanh_toan == 1 ? 1 : 0), // 0: Chưa duyệt, 1: Đã duyệt
                    'thanh_tien'         => $thanh_tien,
                    'ma_khach_hang'      => $customer['ma_khach_hang'],
                    'id_khach_hang'      => $customer['id'],
                    'ma_san'             => $san->ma_san,
                    'id_san'             => $san->id,
                    'thanh_toan'         => $thanh_toan, // 0: Chưa thanh toán, 1: Đã cọc, 2: Đã thanh toán
                    'so_tien_coc'        => $thanh_toan == 2 ? $thanh_tien : ($thanh_toan == 1 ? $tien_coc : 0),
                    'created_at'         => now(),
                    'updated_at'         => now(),
                ];
            }

            DB::table('thue_sans')->insert($bookings);
        }
    }
}
