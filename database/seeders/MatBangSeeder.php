<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatBangSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'ma_mat_bang' => 'MB001',
                'id_chu_san' => 1,
                'dia_chi' => '123 Nguyễn Văn Linh, Phường Hòa Hiệp Bắc, Quận Liên Chiểu, Đà Nẵng',
                'trang_thai' => 1,
                'id_thanh_pho' => 32,
                'id_quan_huyen' => 490,
                'id_phuong_xa' => 5000,
            ],
            [
                'id' => 2,
                'ma_mat_bang' => 'MB002',
                'id_chu_san' => 1,
                'dia_chi' => '456 Tôn Đức Thắng, Phường Hòa Minh, Quận Liên Chiểu, Đà Nẵng',
                'trang_thai' => 1,
                'id_thanh_pho' => 32,
                'id_quan_huyen' => 490,
                'id_phuong_xa' => 5004,
            ],
            [
                'id' => 3,
                'ma_mat_bang' => 'MB003',
                'id_chu_san' => 1,
                'dia_chi' => '789 Ngô Quyền, Phường An Hải Bắc, Quận Sơn Trà, Đà Nẵng',
                'trang_thai' => 1,
                'id_thanh_pho' => 32,
                'id_quan_huyen' => 493,
                'id_phuong_xa' => 5031,
            ],
            [
                'id' => 4,
                'ma_mat_bang' => 'MB004',
                'id_chu_san' => 1,
                'dia_chi' => '147 Võ Nguyên Giáp, Phường Mỹ An, Quận Ngũ Hành Sơn, Đà Nẵng',
                'trang_thai' => 1,
                'id_thanh_pho' => 32,
                'id_quan_huyen' => 494,
                'id_phuong_xa' => 5035,
            ],
            [
                'id' => 5,
                'ma_mat_bang' => 'MB005',
                'id_chu_san' => 1,
                'dia_chi' => '258 Trường Chinh, Phường An Khê, Quận Thanh Khê, Đà Nẵng',
                'trang_thai' => 1,
                'id_thanh_pho' => 32,
                'id_quan_huyen' => 491,
                'id_phuong_xa' => 5013,
            ],
            [
                'id' => 6,
                'ma_mat_bang' => 'MB006',
                'id_chu_san' => 2,
                'dia_chi' => '369 Hà Huy Tập, Phường Hòa Khê, Quận Thanh Khê, Đà Nẵng',
                'trang_thai' => 0,
                'id_thanh_pho' => 32,
                'id_quan_huyen' => 491,
                'id_phuong_xa' => 5014,
            ],
            [
                'id' => 7,
                'ma_mat_bang' => 'MB007',
                'id_chu_san' => 2,
                'dia_chi' => '159 Ông Ích Khiêm, Phường Thanh Bình, Quận Hải Châu, Đà Nẵng',
                'trang_thai' => 1,
                'id_thanh_pho' => 32,
                'id_quan_huyen' => 492,
                'id_phuong_xa' => 5015,
            ],
            [
                'id' => 8,
                'ma_mat_bang' => 'MB008',
                'id_chu_san' => 2,
                'dia_chi' => '753 Hoàng Diệu, Phường Hòa Thuận Đông, Quận Hải Châu, Đà Nẵng',
                'trang_thai' => 1,
                'id_thanh_pho' => 32,
                'id_quan_huyen' => 492,
                'id_phuong_xa' => 5022,
            ],
            [
                'id' => 9,
                'ma_mat_bang' => 'MB009',
                'id_chu_san' => 2,
                'dia_chi' => '951 Trần Cao Vân, Phường Xuân Hà, Quận Thanh Khê, Đà Nẵng',
                'trang_thai' => 1,
                'id_thanh_pho' => 32,
                'id_quan_huyen' => 491,
                'id_phuong_xa' => 5008,
            ],
            [
                'id' => 10,
                'ma_mat_bang' => 'MB010',
                'id_chu_san' => 2,
                'dia_chi' => '357 Điện Biên Phủ, Phường Chính Gián, Quận Thanh Khê, Đà Nẵng',
                'trang_thai' => 0,
                'id_thanh_pho' => 32,
                'id_quan_huyen' => 491,
                'id_phuong_xa' => 5010,
            ],
        ];

        DB::table('mat_bang_sans')->insert($data);
    }
}
