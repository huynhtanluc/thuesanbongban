<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThanhPhoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 1, 'ten_thanh_pho' => 'Thành phố Hà Nội'],
            ['id' => 2, 'ten_thanh_pho' => 'Tỉnh Hà Giang'],
            ['id' => 3, 'ten_thanh_pho' => 'Tỉnh Cao Bằng'],
            ['id' => 4, 'ten_thanh_pho' => 'Tỉnh Bắc Kạn'],
            ['id' => 5, 'ten_thanh_pho' => 'Tỉnh Tuyên Quang'],
            ['id' => 6, 'ten_thanh_pho' => 'Tỉnh Lào Cai'],
            ['id' => 7, 'ten_thanh_pho' => 'Tỉnh Điện Biên'],
            ['id' => 8, 'ten_thanh_pho' => 'Tỉnh Lai Châu'],
            ['id' => 9, 'ten_thanh_pho' => 'Tỉnh Sơn La'],
            ['id' => 10, 'ten_thanh_pho' => 'Tỉnh Yên Bái'],
            ['id' => 11, 'ten_thanh_pho' => 'Tỉnh Hoà Bình'],
            ['id' => 12, 'ten_thanh_pho' => 'Tỉnh Thái Nguyên'],
            ['id' => 13, 'ten_thanh_pho' => 'Tỉnh Lạng Sơn'],
            ['id' => 14, 'ten_thanh_pho' => 'Tỉnh Quảng Ninh'],
            ['id' => 15, 'ten_thanh_pho' => 'Tỉnh Bắc Giang'],
            ['id' => 16, 'ten_thanh_pho' => 'Tỉnh Phú Thọ'],
            ['id' => 17, 'ten_thanh_pho' => 'Tỉnh Vĩnh Phúc'],
            ['id' => 18, 'ten_thanh_pho' => 'Tỉnh Bắc Ninh'],
            ['id' => 19, 'ten_thanh_pho' => 'Tỉnh Hải Dương'],
            ['id' => 20, 'ten_thanh_pho' => 'Thành phố Hải Phòng'],
            ['id' => 21, 'ten_thanh_pho' => 'Tỉnh Hưng Yên'],
            ['id' => 22, 'ten_thanh_pho' => 'Tỉnh Thái Bình'],
            ['id' => 23, 'ten_thanh_pho' => 'Tỉnh Hà Nam'],
            ['id' => 24, 'ten_thanh_pho' => 'Tỉnh Nam Định'],
            ['id' => 25, 'ten_thanh_pho' => 'Tỉnh Ninh Bình'],
            ['id' => 26, 'ten_thanh_pho' => 'Tỉnh Thanh Hóa'],
            ['id' => 27, 'ten_thanh_pho' => 'Tỉnh Nghệ An'],
            ['id' => 28, 'ten_thanh_pho' => 'Tỉnh Hà Tĩnh'],
            ['id' => 29, 'ten_thanh_pho' => 'Tỉnh Quảng Bình'],
            ['id' => 30, 'ten_thanh_pho' => 'Tỉnh Quảng Trị'],
            ['id' => 31, 'ten_thanh_pho' => 'Tỉnh Thừa Thiên Huế'],
            ['id' => 32, 'ten_thanh_pho' => 'Thành phố Đà Nẵng'],
            ['id' => 33, 'ten_thanh_pho' => 'Tỉnh Quảng Nam'],
            ['id' => 34, 'ten_thanh_pho' => 'Tỉnh Quảng Ngãi'],
            ['id' => 35, 'ten_thanh_pho' => 'Tỉnh Bình Định'],
            ['id' => 36, 'ten_thanh_pho' => 'Tỉnh Phú Yên'],
            ['id' => 37, 'ten_thanh_pho' => 'Tỉnh Khánh Hòa'],
            ['id' => 38, 'ten_thanh_pho' => 'Tỉnh Ninh Thuận'],
            ['id' => 39, 'ten_thanh_pho' => 'Tỉnh Bình Thuận'],
            ['id' => 40, 'ten_thanh_pho' => 'Tỉnh Kon Tum'],
            ['id' => 41, 'ten_thanh_pho' => 'Tỉnh Gia Lai'],
            ['id' => 42, 'ten_thanh_pho' => 'Tỉnh Đắk Lắk'],
            ['id' => 43, 'ten_thanh_pho' => 'Tỉnh Đắk Nông'],
            ['id' => 44, 'ten_thanh_pho' => 'Tỉnh Lâm Đồng'],
            ['id' => 45, 'ten_thanh_pho' => 'Tỉnh Bình Phước'],
            ['id' => 46, 'ten_thanh_pho' => 'Tỉnh Tây Ninh'],
            ['id' => 47, 'ten_thanh_pho' => 'Tỉnh Bình Dương'],
            ['id' => 48, 'ten_thanh_pho' => 'Tỉnh Đồng Nai'],
            ['id' => 49, 'ten_thanh_pho' => 'Tỉnh Bà Rịa - Vũng Tàu'],
            ['id' => 50, 'ten_thanh_pho' => 'Thành phố Hồ Chí Minh'],
            ['id' => 51, 'ten_thanh_pho' => 'Tỉnh Long An'],
            ['id' => 52, 'ten_thanh_pho' => 'Tỉnh Tiền Giang'],
            ['id' => 53, 'ten_thanh_pho' => 'Tỉnh Bến Tre'],
            ['id' => 54, 'ten_thanh_pho' => 'Tỉnh Trà Vinh'],
            ['id' => 55, 'ten_thanh_pho' => 'Tỉnh Vĩnh Long'],
            ['id' => 56, 'ten_thanh_pho' => 'Tỉnh Đồng Tháp'],
            ['id' => 57, 'ten_thanh_pho' => 'Tỉnh An Giang'],
            ['id' => 58, 'ten_thanh_pho' => 'Tỉnh Kiên Giang'],
            ['id' => 59, 'ten_thanh_pho' => 'Thành phố Cần Thơ'],
            ['id' => 60, 'ten_thanh_pho' => 'Tỉnh Hậu Giang'],
            ['id' => 61, 'ten_thanh_pho' => 'Tỉnh Sóc Trăng'],
            ['id' => 62, 'ten_thanh_pho' => 'Tỉnh Bạc Liêu'],
            ['id' => 63, 'ten_thanh_pho' => 'Tỉnh Cà Mau']
        ];

        DB::table('thanh_phos')->insert($data);
    }
}
