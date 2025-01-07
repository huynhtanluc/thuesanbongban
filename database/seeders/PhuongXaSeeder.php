<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhuongXaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Ba Đình
            ['id' => 1, 'ten_phuong_xa' => 'Phường Phúc Xá', 'id_quan_huyen' => 1],
            ['id' => 2, 'ten_phuong_xa' => 'Phường Trúc Bạch', 'id_quan_huyen' => 1],
            ['id' => 3, 'ten_phuong_xa' => 'Phường Vĩnh Phúc', 'id_quan_huyen' => 1],
            ['id' => 4, 'ten_phuong_xa' => 'Phường Cống Vị', 'id_quan_huyen' => 1],
            ['id' => 5, 'ten_phuong_xa' => 'Phường Liễu Giai', 'id_quan_huyen' => 1],
            ['id' => 6, 'ten_phuong_xa' => 'Phường Nguyễn Trung Trực', 'id_quan_huyen' => 1],
            ['id' => 7, 'ten_phuong_xa' => 'Phường Quán Thánh', 'id_quan_huyen' => 1],
            ['id' => 8, 'ten_phuong_xa' => 'Phường Ngọc Hà', 'id_quan_huyen' => 1],
            ['id' => 9, 'ten_phuong_xa' => 'Phường Điện Biên', 'id_quan_huyen' => 1],
            ['id' => 10, 'ten_phuong_xa' => 'Phường Đội Cấn', 'id_quan_huyen' => 1],
            ['id' => 11, 'ten_phuong_xa' => 'Phường Ngọc Khánh', 'id_quan_huyen' => 1],
            ['id' => 12, 'ten_phuong_xa' => 'Phường Kim Mã', 'id_quan_huyen' => 1],
            ['id' => 13, 'ten_phuong_xa' => 'Phường Giảng Võ', 'id_quan_huyen' => 1],
            ['id' => 14, 'ten_phuong_xa' => 'Phường Thành Công', 'id_quan_huyen' => 1],

            // Hoàn Kiếm
            ['id' => 25, 'ten_phuong_xa' => 'Phường Phúc Tân', 'id_quan_huyen' => 2],
            ['id' => 26, 'ten_phuong_xa' => 'Phường Đồng Xuân', 'id_quan_huyen' => 2],
            ['id' => 27, 'ten_phuong_xa' => 'Phường Hàng Mã', 'id_quan_huyen' => 2],
            ['id' => 28, 'ten_phuong_xa' => 'Phường Hàng Buồm', 'id_quan_huyen' => 2],
            ['id' => 29, 'ten_phuong_xa' => 'Phường Hàng Đào', 'id_quan_huyen' => 2],
            ['id' => 30, 'ten_phuong_xa' => 'Phường Hàng Bồ', 'id_quan_huyen' => 2],
            ['id' => 31, 'ten_phuong_xa' => 'Phường Cửa Đông', 'id_quan_huyen' => 2],
            ['id' => 32, 'ten_phuong_xa' => 'Phường Lý Thái Tổ', 'id_quan_huyen' => 2],
            ['id' => 33, 'ten_phuong_xa' => 'Phường Hàng Bạc', 'id_quan_huyen' => 2],
            ['id' => 34, 'ten_phuong_xa' => 'Phường Hàng Gai', 'id_quan_huyen' => 2],
            ['id' => 35, 'ten_phuong_xa' => 'Phường Chương Dương', 'id_quan_huyen' => 2],
            ['id' => 36, 'ten_phuong_xa' => 'Phường Hàng Trống', 'id_quan_huyen' => 2],
            ['id' => 37, 'ten_phuong_xa' => 'Phường Cửa Nam', 'id_quan_huyen' => 2],
            ['id' => 38, 'ten_phuong_xa' => 'Phường Hàng Bông', 'id_quan_huyen' => 2],
            ['id' => 39, 'ten_phuong_xa' => 'Phường Tràng Tiền', 'id_quan_huyen' => 2],
            ['id' => 40, 'ten_phuong_xa' => 'Phường Trần Hưng Đạo', 'id_quan_huyen' => 2],
            ['id' => 41, 'ten_phuong_xa' => 'Phường Phan Chu Trinh', 'id_quan_huyen' => 2],
            ['id' => 42, 'ten_phuong_xa' => 'Phường Hàng Bài', 'id_quan_huyen' => 2],

            // Quận Liên Chiểu
            ['id' => 5000, 'ten_phuong_xa' => 'Phường Hòa Hiệp Bắc', 'id_quan_huyen' => 490],
            ['id' => 5001, 'ten_phuong_xa' => 'Phường Hòa Hiệp Nam', 'id_quan_huyen' => 490],
            ['id' => 5002, 'ten_phuong_xa' => 'Phường Hòa Khánh Bắc', 'id_quan_huyen' => 490],
            ['id' => 5003, 'ten_phuong_xa' => 'Phường Hòa Khánh Nam', 'id_quan_huyen' => 490],
            ['id' => 5004, 'ten_phuong_xa' => 'Phường Hòa Minh', 'id_quan_huyen' => 490],

            // Quận Thanh Khê
            ['id' => 5005, 'ten_phuong_xa' => 'Phường Tam Thuận', 'id_quan_huyen' => 491],
            ['id' => 5006, 'ten_phuong_xa' => 'Phường Thanh Khê Tây', 'id_quan_huyen' => 491],
            ['id' => 5007, 'ten_phuong_xa' => 'Phường Thanh Khê Đông', 'id_quan_huyen' => 491],
            ['id' => 5008, 'ten_phuong_xa' => 'Phường Xuân Hà', 'id_quan_huyen' => 491],
            ['id' => 5009, 'ten_phuong_xa' => 'Phường Tân Chính', 'id_quan_huyen' => 491],
            ['id' => 5010, 'ten_phuong_xa' => 'Phường Chính Gián', 'id_quan_huyen' => 491],
            ['id' => 5011, 'ten_phuong_xa' => 'Phường Vĩnh Trung', 'id_quan_huyen' => 491],
            ['id' => 5012, 'ten_phuong_xa' => 'Phường Thạc Gián', 'id_quan_huyen' => 491],
            ['id' => 5013, 'ten_phuong_xa' => 'Phường An Khê', 'id_quan_huyen' => 491],
            ['id' => 5014, 'ten_phuong_xa' => 'Phường Hòa Khê', 'id_quan_huyen' => 491],

            // Quận Hải Châu
            ['id' => 5015, 'ten_phuong_xa' => 'Phường Thanh Bình', 'id_quan_huyen' => 492],
            ['id' => 5016, 'ten_phuong_xa' => 'Phường Thuận Phước', 'id_quan_huyen' => 492],
            ['id' => 5017, 'ten_phuong_xa' => 'Phường Thạch Thang', 'id_quan_huyen' => 492],
            ['id' => 5018, 'ten_phuong_xa' => 'Phường Hải Châu I', 'id_quan_huyen' => 492],
            ['id' => 5019, 'ten_phuong_xa' => 'Phường Hải Châu II', 'id_quan_huyen' => 492],
            ['id' => 5020, 'ten_phuong_xa' => 'Phường Phước Ninh', 'id_quan_huyen' => 492],
            ['id' => 5021, 'ten_phuong_xa' => 'Phường Hòa Thuận Tây', 'id_quan_huyen' => 492],
            ['id' => 5022, 'ten_phuong_xa' => 'Phường Hòa Thuận Đông', 'id_quan_huyen' => 492],
            ['id' => 5023, 'ten_phuong_xa' => 'Phường Nam Dương', 'id_quan_huyen' => 492],
            ['id' => 5024, 'ten_phuong_xa' => 'Phường Bình Hiên', 'id_quan_huyen' => 492],
            ['id' => 5025, 'ten_phuong_xa' => 'Phường Bình Thuận', 'id_quan_huyen' => 492],
            ['id' => 5026, 'ten_phuong_xa' => 'Phường Hòa Cường Bắc', 'id_quan_huyen' => 492],
            ['id' => 5027, 'ten_phuong_xa' => 'Phường Hòa Cường Nam', 'id_quan_huyen' => 492],

            // Quận Sơn Trà
            ['id' => 5028, 'ten_phuong_xa' => 'Phường Thọ Quang', 'id_quan_huyen' => 493],
            ['id' => 5029, 'ten_phuong_xa' => 'Phường Nại Hiên Đông', 'id_quan_huyen' => 493],
            ['id' => 5030, 'ten_phuong_xa' => 'Phường Mân Thái', 'id_quan_huyen' => 493],
            ['id' => 5031, 'ten_phuong_xa' => 'Phường An Hải Bắc', 'id_quan_huyen' => 493],
            ['id' => 5032, 'ten_phuong_xa' => 'Phường Phước Mỹ', 'id_quan_huyen' => 493],
            ['id' => 5033, 'ten_phuong_xa' => 'Phường An Hải Tây', 'id_quan_huyen' => 493],
            ['id' => 5034, 'ten_phuong_xa' => 'Phường An Hải Đông', 'id_quan_huyen' => 493],

            // Quận Ngũ Hành Sơn
            ['id' => 5035, 'ten_phuong_xa' => 'Phường Mỹ An', 'id_quan_huyen' => 494],
            ['id' => 5036, 'ten_phuong_xa' => 'Phường Khuê Mỹ', 'id_quan_huyen' => 494],
            ['id' => 5037, 'ten_phuong_xa' => 'Phường Hoà Quý', 'id_quan_huyen' => 494],
            ['id' => 5038, 'ten_phuong_xa' => 'Phường Hoà Hải', 'id_quan_huyen' => 494],

            // Quận Cẩm Lệ
            ['id' => 5039, 'ten_phuong_xa' => 'Phường Khuê Trung', 'id_quan_huyen' => 495],
            ['id' => 5040, 'ten_phuong_xa' => 'Phường Hòa Phát', 'id_quan_huyen' => 495],
            ['id' => 5041, 'ten_phuong_xa' => 'Phường Hòa An', 'id_quan_huyen' => 495],
            ['id' => 5042, 'ten_phuong_xa' => 'Phường Hòa Thọ Tây', 'id_quan_huyen' => 495],
            ['id' => 5043, 'ten_phuong_xa' => 'Phường Hòa Thọ Đông', 'id_quan_huyen' => 495],
            ['id' => 5044, 'ten_phuong_xa' => 'Phường Hòa Xuân', 'id_quan_huyen' => 495],

            // Huyện Hòa Vang
            ['id' => 5045, 'ten_phuong_xa' => 'Xã Hòa Bắc', 'id_quan_huyen' => 496],
            ['id' => 5046, 'ten_phuong_xa' => 'Xã Hòa Liên', 'id_quan_huyen' => 496],
            ['id' => 5047, 'ten_phuong_xa' => 'Xã Hòa Ninh', 'id_quan_huyen' => 496],
            ['id' => 5048, 'ten_phuong_xa' => 'Xã Hòa Sơn', 'id_quan_huyen' => 496],
            ['id' => 5049, 'ten_phuong_xa' => 'Xã Hòa Nhơn', 'id_quan_huyen' => 496],
            ['id' => 5050, 'ten_phuong_xa' => 'Xã Hòa Phú', 'id_quan_huyen' => 496],
            ['id' => 5051, 'ten_phuong_xa' => 'Xã Hòa Phong', 'id_quan_huyen' => 496],
            ['id' => 5052, 'ten_phuong_xa' => 'Xã Hòa Châu', 'id_quan_huyen' => 496],
            ['id' => 5053, 'ten_phuong_xa' => 'Xã Hòa Tiến', 'id_quan_huyen' => 496],
            ['id' => 5054, 'ten_phuong_xa' => 'Xã Hòa Phước', 'id_quan_huyen' => 496],
            ['id' => 5055, 'ten_phuong_xa' => 'Xã Hòa Khương', 'id_quan_huyen' => 496],

            // Tiếp tục thêm các phường xã khác...
        ];

        DB::table('phuong_xas')->insert($data);
    }
}
