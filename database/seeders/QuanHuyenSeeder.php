<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuanHuyenSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Hà Nội
            ['id' => 1, 'ten_quan_huyen' => 'Quận Ba Đình', 'id_thanh_pho' => 1],
            ['id' => 2, 'ten_quan_huyen' => 'Quận Hoàn Kiếm', 'id_thanh_pho' => 1],
            ['id' => 3, 'ten_quan_huyen' => 'Quận Tây Hồ', 'id_thanh_pho' => 1],
            ['id' => 4, 'ten_quan_huyen' => 'Quận Long Biên', 'id_thanh_pho' => 1],
            ['id' => 5, 'ten_quan_huyen' => 'Quận Cầu Giấy', 'id_thanh_pho' => 1],
            ['id' => 6, 'ten_quan_huyen' => 'Quận Đống Đa', 'id_thanh_pho' => 1],
            ['id' => 7, 'ten_quan_huyen' => 'Quận Hai Bà Trưng', 'id_thanh_pho' => 1],
            ['id' => 8, 'ten_quan_huyen' => 'Quận Hoàng Mai', 'id_thanh_pho' => 1],
            ['id' => 9, 'ten_quan_huyen' => 'Quận Thanh Xuân', 'id_thanh_pho' => 1],
            ['id' => 16, 'ten_quan_huyen' => 'Huyện Sóc Sơn', 'id_thanh_pho' => 1],
            ['id' => 17, 'ten_quan_huyen' => 'Huyện Đông Anh', 'id_thanh_pho' => 1],
            ['id' => 18, 'ten_quan_huyen' => 'Huyện Gia Lâm', 'id_thanh_pho' => 1],
            ['id' => 19, 'ten_quan_huyen' => 'Quận Nam Từ Liêm', 'id_thanh_pho' => 1],
            ['id' => 20, 'ten_quan_huyen' => 'Huyện Thanh Trì', 'id_thanh_pho' => 1],
            ['id' => 21, 'ten_quan_huyen' => 'Quận Bắc Từ Liêm', 'id_thanh_pho' => 1],
            ['id' => 250, 'ten_quan_huyen' => 'Huyện Mê Linh', 'id_thanh_pho' => 1],
            ['id' => 268, 'ten_quan_huyen' => 'Quận Hà Đông', 'id_thanh_pho' => 1],
            ['id' => 269, 'ten_quan_huyen' => 'Thị xã Sơn Tây', 'id_thanh_pho' => 1],
            ['id' => 271, 'ten_quan_huyen' => 'Huyện Ba Vì', 'id_thanh_pho' => 1],
            ['id' => 272, 'ten_quan_huyen' => 'Huyện Phúc Thọ', 'id_thanh_pho' => 1],
            ['id' => 273, 'ten_quan_huyen' => 'Huyện Đan Phượng', 'id_thanh_pho' => 1],
            ['id' => 274, 'ten_quan_huyen' => 'Huyện Hoài Đức', 'id_thanh_pho' => 1],
            ['id' => 275, 'ten_quan_huyen' => 'Huyện Quốc Oai', 'id_thanh_pho' => 1],
            ['id' => 276, 'ten_quan_huyen' => 'Huyện Thạch Thất', 'id_thanh_pho' => 1],
            ['id' => 277, 'ten_quan_huyen' => 'Huyện Chương Mỹ', 'id_thanh_pho' => 1],
            ['id' => 278, 'ten_quan_huyen' => 'Huyện Thanh Oai', 'id_thanh_pho' => 1],
            ['id' => 279, 'ten_quan_huyen' => 'Huyện Thường Tín', 'id_thanh_pho' => 1],
            ['id' => 280, 'ten_quan_huyen' => 'Huyện Phú Xuyên', 'id_thanh_pho' => 1],
            ['id' => 281, 'ten_quan_huyen' => 'Huyện Ứng Hòa', 'id_thanh_pho' => 1],
            ['id' => 282, 'ten_quan_huyen' => 'Huyện Mỹ Đức', 'id_thanh_pho' => 1],

            // Hà Giang
            ['id' => 24, 'ten_quan_huyen' => 'Thành phố Hà Giang', 'id_thanh_pho' => 2],
            ['id' => 26, 'ten_quan_huyen' => 'Huyện Đồng Văn', 'id_thanh_pho' => 2],
            ['id' => 27, 'ten_quan_huyen' => 'Huyện Mèo Vạc', 'id_thanh_pho' => 2],
            ['id' => 28, 'ten_quan_huyen' => 'Huyện Yên Minh', 'id_thanh_pho' => 2],
            ['id' => 29, 'ten_quan_huyen' => 'Huyện Quản Bạ', 'id_thanh_pho' => 2],
            ['id' => 30, 'ten_quan_huyen' => 'Huyện Vị Xuyên', 'id_thanh_pho' => 2],
            ['id' => 31, 'ten_quan_huyen' => 'Huyện Bắc Mê', 'id_thanh_pho' => 2],
            ['id' => 32, 'ten_quan_huyen' => 'Huyện Hoàng Su Phì', 'id_thanh_pho' => 2],
            ['id' => 33, 'ten_quan_huyen' => 'Huyện Xín Mần', 'id_thanh_pho' => 2],
            ['id' => 34, 'ten_quan_huyen' => 'Huyện Bắc Quang', 'id_thanh_pho' => 2],
            ['id' => 35, 'ten_quan_huyen' => 'Huyện Quang Bình', 'id_thanh_pho' => 2],

            // Cao Bằng
            ['id' => 36, 'ten_quan_huyen' => 'Thành phố Cao Bằng', 'id_thanh_pho' => 3],
            ['id' => 37, 'ten_quan_huyen' => 'Huyện Bảo Lâm', 'id_thanh_pho' => 3],
            ['id' => 38, 'ten_quan_huyen' => 'Huyện Bảo Lạc', 'id_thanh_pho' => 3],
            ['id' => 39, 'ten_quan_huyen' => 'Huyện Thông Nông', 'id_thanh_pho' => 3],
            ['id' => 40, 'ten_quan_huyen' => 'Huyện Hà Quảng', 'id_thanh_pho' => 3],
            ['id' => 41, 'ten_quan_huyen' => 'Huyện Trà Lĩnh', 'id_thanh_pho' => 3],
            ['id' => 42, 'ten_quan_huyen' => 'Huyện Trùng Khánh', 'id_thanh_pho' => 3],
            ['id' => 43, 'ten_quan_huyen' => 'Huyện Hạ Lang', 'id_thanh_pho' => 3],
            ['id' => 44, 'ten_quan_huyen' => 'Huyện Quảng Uyên', 'id_thanh_pho' => 3],
            ['id' => 45, 'ten_quan_huyen' => 'Huyện Phục Hoà', 'id_thanh_pho' => 3],
            ['id' => 46, 'ten_quan_huyen' => 'Huyện Hoà An', 'id_thanh_pho' => 3],
            ['id' => 47, 'ten_quan_huyen' => 'Huyện Nguyên Bình', 'id_thanh_pho' => 3],
            ['id' => 48, 'ten_quan_huyen' => 'Huyện Thạch An', 'id_thanh_pho' => 3],

            // Bắc Kạn
            ['id' => 49, 'ten_quan_huyen' => 'Thành phố Bắc Kạn', 'id_thanh_pho' => 4],
            ['id' => 50, 'ten_quan_huyen' => 'Huyện Pác Nặm', 'id_thanh_pho' => 4],
            ['id' => 51, 'ten_quan_huyen' => 'Huyện Ba Bể', 'id_thanh_pho' => 4],
            ['id' => 52, 'ten_quan_huyen' => 'Huyện Ngân Sơn', 'id_thanh_pho' => 4],
            ['id' => 53, 'ten_quan_huyen' => 'Huyện Bạch Thông', 'id_thanh_pho' => 4],
            ['id' => 54, 'ten_quan_huyen' => 'Huyện Chợ Đồn', 'id_thanh_pho' => 4],
            ['id' => 55, 'ten_quan_huyen' => 'Huyện Chợ Mới', 'id_thanh_pho' => 4],
            ['id' => 56, 'ten_quan_huyen' => 'Huyện Na Rì', 'id_thanh_pho' => 4],

            // Tuyên Quang
            ['id' => 57, 'ten_quan_huyen' => 'Thành phố Tuyên Quang', 'id_thanh_pho' => 5],
            ['id' => 58, 'ten_quan_huyen' => 'Huyện Lâm Bình', 'id_thanh_pho' => 5],
            ['id' => 59, 'ten_quan_huyen' => 'Huyện Na Hang', 'id_thanh_pho' => 5],
            ['id' => 60, 'ten_quan_huyen' => 'Huyện Chiêm Hóa', 'id_thanh_pho' => 5],
            ['id' => 61, 'ten_quan_huyen' => 'Huyện Hàm Yên', 'id_thanh_pho' => 5],
            ['id' => 62, 'ten_quan_huyen' => 'Huyện Yên Sơn', 'id_thanh_pho' => 5],
            ['id' => 63, 'ten_quan_huyen' => 'Huyện Sơn Dương', 'id_thanh_pho' => 5],

            // Đà Nẵng
            ['id' => 490, 'ten_quan_huyen' => 'Quận Liên Chiểu', 'id_thanh_pho' => 32],
            ['id' => 491, 'ten_quan_huyen' => 'Quận Thanh Khê', 'id_thanh_pho' => 32],
            ['id' => 492, 'ten_quan_huyen' => 'Quận Hải Châu', 'id_thanh_pho' => 32],
            ['id' => 493, 'ten_quan_huyen' => 'Quận Sơn Trà', 'id_thanh_pho' => 32],
            ['id' => 494, 'ten_quan_huyen' => 'Quận Ngũ Hành Sơn', 'id_thanh_pho' => 32],
            ['id' => 495, 'ten_quan_huyen' => 'Quận Cẩm Lệ', 'id_thanh_pho' => 32],
            ['id' => 496, 'ten_quan_huyen' => 'Huyện Hòa Vang', 'id_thanh_pho' => 32],
            ['id' => 497, 'ten_quan_huyen' => 'Huyện Hoàng Sa', 'id_thanh_pho' => 32],

            // Tiếp tục thêm các quận huyện khác...
        ];

        DB::table('quan_huyens')->insert($data);
    }
}
