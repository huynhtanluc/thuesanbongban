<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaiVietSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bai_viets')->delete();
        DB::table('bai_viets')->truncate();

        $list_bai_viet = [
            [
                'ma_bai_viet'   => 'BV0001',
                'ten_bai_viet'  => 'Khai trương sân bóng bàn hiện đại tại Đà Nẵng',
                'noi_dung'      => '<p class="lead">Chào mừng khai trương sân bóng bàn mới với không gian hiện đại và nhiều chương trình ưu đãi hấp dẫn.</p>

                    <h4 class="mt-4">Cơ sở vật chất hiện đại</h4>
                    <p>Sân bóng bàn được trang bị:</p>
                    <ul>
                        <li>Bàn bóng đạt chuẩn quốc tế</li>
                        <li>Hệ thống đèn chiếu sáng tiêu chuẩn</li>
                        <li>Không gian thoáng mát, điều hòa nhiệt độ</li>
                        <li>Dịch vụ hỗ trợ chuyên nghiệp</li>
                    </ul>

                    <h4 class="mt-4">Chương trình khuyến mãi</h4>
                    <p>Nhân dịp khai trương, chúng tôi mang đến các ưu đãi:</p>
                    <ul>
                        <li>Giảm 50% giá thuê bàn trong tuần đầu tiên</li>
                        <li>Miễn phí nước uống cho khách hàng</li>
                        <li>Tặng voucher giảm giá cho lần đặt sân tiếp theo</li>
                    </ul>

                    <blockquote class="blockquote mt-4">
                        <p class="mb-0">"Không gian thể thao chuyên nghiệp, nơi kết nối đam mê bóng bàn"</p>
                        <footer class="blockquote-footer mt-2">Quản lý <cite title="Source Title">Nguyễn Văn B</cite></footer>
                    </blockquote>

                    <h4 class="mt-4">Thông tin liên hệ</h4>
                    <p>Để đặt bàn hoặc biết thêm chi tiết, quý khách vui lòng liên hệ:</p>
                    <ul>
                        <li>Địa chỉ: 456 Đường XYZ, Đà Nẵng</li>
                        <li>Hotline: 0987.654.321</li>
                        <li>Email: info@bongban.com</li>
                    </ul>',
                'noi_dung_ngan' => 'Chào mừng khai trương sân bóng bàn mới với không gian hiện đại và nhiều chương trình ưu đãi hấp dẫn.',
                'hinh_anh'      => '/assets/images/san_bong_ban_1.png',
                'trang_thai'    => 1,
                'ma_chu_san'    => 'KH001',
                'id_chu_san'    => 1,
            ],
            [
                'ma_bai_viet'   => 'BV0002',
                'ten_bai_viet'  => 'Tuần lễ vàng tại sân bóng bàn Đà Nẵng',
                'noi_dung'      => '<p class="lead">Chào đón tuần lễ vàng tại sân bóng bàn Đà Nẵng với nhiều ưu đãi đặc biệt!</p>

                    <h4 class="mt-4">Ưu đãi đặc biệt</h4>
                    <p>Trong tuần lễ vàng, chúng tôi triển khai các chương trình hấp dẫn:</p>
                    <ul>
                        <li>Giảm giá 40% khi đặt sân từ 2 giờ trở lên</li>
                        <li>Miễn phí nước uống</li>
                        <li>Tham gia bốc thăm trúng thưởng với nhiều phần quà giá trị</li>
                    </ul>

                    <blockquote class="blockquote mt-4">
                        <p class="mb-0">"Tuần lễ vàng – Cơ hội chơi bóng bàn thỏa thích với ưu đãi lớn"</p>
                        <footer class="blockquote-footer mt-2">Quản lý <cite title="Source Title">Nguyễn Văn C</cite></footer>
                    </blockquote>

                    <h4 class="mt-4">Thông tin liên hệ</h4>
                    <p>Đặt bàn hoặc biết thêm thông tin, vui lòng liên hệ:</p>
                    <ul>
                        <li>Địa chỉ: 123 Đường ABC, Đà Nẵng</li>
                        <li>Hotline: 0123.456.789</li>
                        <li>Email: info@sanbongban.com</li>
                    </ul>',
                'noi_dung_ngan' => 'Chào đón tuần lễ vàng tại sân bóng bàn Đà Nẵng với nhiều ưu đãi đặc biệt!',
                'hinh_anh'      => '/assets/images/san_bong_ban_2.png',
                'trang_thai'    => 1,
                'ma_chu_san'    => 'KH001',
                'id_chu_san'    => 1,
            ],
            [
                'ma_bai_viet'   => 'BV0003',
                'ten_bai_viet'  => 'Chương trình tri ân khách hàng thân thiết',
                'noi_dung'      => '<p class="lead">Tri ân khách hàng thân thiết với nhiều đặc quyền hấp dẫn tại sân bóng bàn Đà Nẵng.</p>

                    <h4 class="mt-4">Đặc quyền dành riêng cho bạn</h4>
                    <p>Các ưu đãi đặc biệt bao gồm:</p>
                    <ul>
                        <li>Giảm ngay 20% phí thuê bàn</li>
                        <li>Ưu tiên đặt bàn trong khung giờ cao điểm</li>
                        <li>Tham gia giao lưu miễn phí</li>
                    </ul>

                    <blockquote class="blockquote mt-4">
                        <p class="mb-0">"Cảm ơn bạn đã đồng hành cùng sân bóng bàn Đà Nẵng"</p>
                        <footer class="blockquote-footer mt-2">Quản lý <cite title="Source Title">Nguyễn Văn D</cite></footer>
                    </blockquote>',
                'noi_dung_ngan' => 'Tri ân khách hàng thân thiết với nhiều đặc quyền hấp dẫn tại sân bóng bàn Đà Nẵng.',
                'hinh_anh'      => '/assets/images/san_bong_ban_3.png',
                'trang_thai'    => 1,
                'ma_chu_san'    => 'KH001',
                'id_chu_san'    => 1,
            ],
            [
                'ma_bai_viet'   => 'BV0004',
                'ten_bai_viet'  => 'Giao lưu bóng bàn cuối tuần tại Đà Nẵng',
                'noi_dung'      => '<p class="lead">Tham gia giao lưu bóng bàn cuối tuần tại sân bóng Đà Nẵng – nơi kết nối đam mê và giao lưu giữa những người yêu thích môn thể thao này.</p>

                    <h4 class="mt-4">Hoạt động thú vị</h4>
                    <p>Chương trình giao lưu bóng bàn bao gồm:</p>
                    <ul>
                        <li>Thi đấu giao hữu giữa các đội chơi</li>
                        <li>Chia sẻ kinh nghiệm và kỹ năng từ các cao thủ</li>
                        <li>Nhận quà tặng hấp dẫn từ ban tổ chức</li>
                    </ul>

                    <blockquote class="blockquote mt-4">
                        <p class="mb-0">"Thể thao không chỉ là thi đấu, mà còn là kết nối"</p>
                        <footer class="blockquote-footer mt-2">Quản lý <cite title="Source Title">Nguyễn Văn E</cite></footer>
                    </blockquote>

                    <h4 class="mt-4">Thông tin liên hệ</h4>
                    <p>Để đăng ký tham gia, vui lòng liên hệ:</p>
                    <ul>
                        <li>Địa chỉ: 456 Đường XYZ, Đà Nẵng</li>
                        <li>Hotline: 0987.654.321</li>
                        <li>Email: info@giaoluu.com</li>
                    </ul>',
                'noi_dung_ngan' => 'Tham gia giao lưu bóng bàn cuối tuần tại sân bóng Đà Nẵng – nơi kết nối đam mê và giao lưu giữa những người yêu thích môn thể thao này.',
                'hinh_anh'      => '/assets/images/san_bong_ban_4.png',
                'trang_thai'    => 1,
                'ma_chu_san'    => 'KH002',
                'id_chu_san'    => 2,
            ],
            [
                'ma_bai_viet'   => 'BV0005',
                'ten_bai_viet'  => 'Ưu đãi chào đón người chơi mới tại sân bóng bàn Đà Nẵng',
                'noi_dung'      => '<p class="lead">Nhân dịp chào đón người chơi mới, sân bóng bàn Đà Nẵng mang đến chương trình ưu đãi đặc biệt để bạn bắt đầu hành trình chinh phục môn thể thao thú vị này.</p>

                    <h4 class="mt-4">Ưu đãi đặc biệt</h4>
                    <p>Chương trình bao gồm:</p>
                    <ul>
                        <li>Giảm ngay 30% phí thuê bàn trong lần đầu tiên</li>
                        <li>Hỗ trợ tư vấn và hướng dẫn miễn phí cho người mới bắt đầu</li>
                        <li>Tặng kèm nước uống miễn phí khi đặt bàn</li>
                    </ul>

                    <blockquote class="blockquote mt-4">
                        <p class="mb-0">"Đồng hành cùng bạn trong từng cú đánh đầu tiên"</p>
                        <footer class="blockquote-footer mt-2">Quản lý <cite title="Source Title">Nguyễn Văn F</cite></footer>
                    </blockquote>

                    <h4 class="mt-4">Thông tin liên hệ</h4>
                    <p>Để đặt bàn hoặc biết thêm thông tin, vui lòng liên hệ:</p>
                    <ul>
                        <li>Địa chỉ: 123 Đường ABC, Đà Nẵng</li>
                        <li>Hotline: 0123.456.789</li>
                        <li>Email: info@sanbongban.com</li>
                    </ul>',
                'noi_dung_ngan' => 'Nhân dịp chào đón người chơi mới, sân bóng bàn Đà Nẵng mang đến chương trình ưu đãi đặc biệt để bạn bắt đầu hành trình chinh phục môn thể thao thú vị này.',
                'hinh_anh'      => '/assets/images/san_bong_ban_5.png',
                'trang_thai'    => 1,
                'ma_chu_san'    => 'KH002',
                'id_chu_san'    => 2,
            ],
            [
                'ma_bai_viet'   => 'BV0006',
                'ten_bai_viet'  => 'Dịch vụ cho thuê dụng cụ thi đấu',
                'noi_dung'      => '<p class="lead">Cung cấp đầy đủ các dụng cụ thi đấu chất lượng cao với giá cả hợp lý. Phục vụ 24/7 cho mọi nhu cầu của người chơi.</p>

                    <h4 class="mt-4">Danh mục cho thuê</h4>
                    <ul>
                        <li>Áo đấu: Nhiều size, màu sắc đa dạng</li>
                        <li>Giày bóng bàn: Size từ 39-44</li>
                        <li>Bóng thi đấu: Động Lực, Nike, Adidas</li>
                        <li>Tất bóng bàn các loại</li>
                        <li>Băng keo thể thao, bảo vệ cổ chân</li>
                    </ul>

                    <h4 class="mt-4">Bảng giá tham khảo</h4>
                    <ul>
                        <li>Áo đấu: 20.000đ/bộ</li>
                        <li>Giày: 30.000đ/đôi</li>
                        <li>Bóng: 50.000đ/quả</li>
                        <li>Tất: 10.000đ/đôi</li>
                    </ul>

                    <h4 class="mt-4">Chính sách thuê</h4>
                    <ul>
                        <li>Đặt cọc CMND/CCCD</li>
                        <li>Giặt sấy sau mỗi lần sử dụng</li>
                        <li>Bảo hành nếu có lỗi</li>
                    </ul>

                    <div class="alert alert-warning mt-4">
                        <strong>Ưu đãi:</strong> Giảm 20% khi thuê trọn bộ (áo, giày, tất)!
                    </div>',
                'noi_dung_ngan' => 'Cung cấp dịch vụ cho thuê áo đấu, giày, bóng và các dụng cụ thi đấu. Giá cả hợp lý, đảm bảo chất lượng. Phục vụ 24/7 cho mọi nhu cầu...',
                'hinh_anh'      => '/assets/images/san_bong_ban_6.png',
                'trang_thai'    => 1,
                'ma_chu_san'    => 'KH002',
                'id_chu_san'    => 2,
            ],
            [
                'ma_bai_viet'   => 'BV0007',
                'ten_bai_viet'  => 'Thành lập câu lạc bộ bóng bàn cộng đồng',
                'noi_dung'      => '<p class="lead">Thông báo thành lập CLB bóng bàn cộng đồng. Nơi giao lưu, kết nối những người đam mê bóng bàn trong Loại Sân.</p>

                    <h4 class="mt-4">Mục tiêu CLB</h4>
                    <ul>
                        <li>Tạo sân chơi lành mạnh cho cộng đồng</li>
                        <li>Nâng cao sức khỏe qua luyện tập</li>
                        <li>Giao lưu, học hỏi kinh nghiệm</li>
                        <li>Tổ chức các giải đấu nội bộ</li>
                    </ul>

                    <h4 class="mt-4">Hoạt động thường xuyên</h4>
                    <ul>
                        <li>Tập luyện: Thứ 3, 5, 7 hàng tuần</li>
                        <li>Giao hữu: Chủ nhật cách tuần</li>
                        <li>Giải nội bộ: 3 tháng/lần</li>
                    </ul>

                    <h4 class="mt-4">Quyền lợi thành viên</h4>
                    <ul>
                        <li>Giảm 20% phí thuê sân</li>
                        <li>Được cấp đồng phục CLB</li>
                        <li>Tham gia các giải đấu miễn phí</li>
                        <li>Được huấn luyện kỹ thuật cơ bản</li>
                    </ul>

                    <div class="alert alert-success mt-4">
                        <strong>Đăng ký ngay:</strong> Miễn phí tham gia trong tháng đầu tiên!
                    </div>',
                'noi_dung_ngan' => 'Thông báo thành lập CLB bóng bàn cộng đồng. Tổ chức thi đấu định kỳ, giao lưu học hỏi. Mời gọi các thành viên đam mê bóng bàn tham gia...',
                'hinh_anh'      => '/assets/images/san_bong_ban_7.png',
                'trang_thai'    => 1,
                'ma_chu_san'    => 'KH002',
                'id_chu_san'    => 2,
            ],
            [
                'ma_bai_viet'   => 'BV0008',
                'ten_bai_viet'  => 'Mở rộng bãi đỗ xe miễn phí',
                'noi_dung'      => '<p class="lead">Hoàn thành mở rộng bãi đỗ xe với sức chứa gấp đôi. Giải quyết triệt để nỗi lo thiếu chỗ gửi xe cho khách hàng.</p>

                    <h4 class="mt-4">Thông tin bãi xe mới</h4>
                    <ul>
                        <li>Diện tích: 1000m2</li>
                        <li>Sức chứa: 100 ô tô, 200 xe máy</li>
                        <li>Mái che toàn bộ</li>
                        <li>Hệ thống camera 24/7</li>
                    </ul>

                    <h4 class="mt-4">Tính năng an ninh</h4>
                    <ul>
                        <li>Bảo vệ trực 24/7</li>
                        <li>Camera giám sát độ phân giải cao</li>
                        <li>Hệ thống đèn chiếu sáng tự động</li>
                        <li>Thẻ gửi xe điện tử</li>
                    </ul>

                    <h4 class="mt-4">Chính sách gửi xe</h4>
                    <ul>
                        <li>Miễn phí cho khách đặt sân</li>
                        <li>Bảo hiểm xe toàn diện</li>
                        <li>Hỗ trợ đỗ xe 24/7</li>
                    </ul>

                    <div class="alert alert-primary mt-4">
                        <strong>Tiện ích:</strong> Có nhân viên hỗ trợ đỗ xe cho khách không thành thạo!
                    </div>',
                'noi_dung_ngan' => 'Hoàn thành mở rộng bãi đỗ xe với sức chứa gấp đôi. Miễn phí gửi xe cho khách hàng đặt sân. An ninh 24/7, có camera giám sát...',
                'hinh_anh'      => '/assets/images/san_bong_ban_8.png',
                'trang_thai'    => 1,
                'ma_chu_san'    => 'KH001',
                'id_chu_san'    => 1,
            ],
            [
                'ma_bai_viet'   => 'BV0009',
                'ten_bai_viet'  => 'Tổ chức giải đấu mini cho doanh nghiệp',
                'noi_dung'      => '<p class="lead">Dịch vụ tổ chức giải đấu trọn gói dành cho doanh nghiệp. Tạo sân chơi lành mạnh, gắn kết đội ngũ.</p>

                    <h4 class="mt-4">Dịch vụ bao gồm</h4>
                    <ul>
                        <li>Sân bóng đạt chuẩn</li>
                        <li>Trọng tài chuyên nghiệp</li>
                        <li>Y tế thường trực</li>
                        <li>MC dẫn chương trình</li>
                        <li>Nước uống, khăn lạnh</li>
                    </ul>

                    <h4 class="mt-4">Các gói dịch vụ</h4>
                    <ul>
                        <li>Gói cơ bản: 4-8 đội (1 ngày)</li>
                        <li>Gói tiêu chuẩn: 8-12 đội (2 ngày)</li>
                        <li>Gói cao cấp: 12-16 đội (3 ngày)</li>
                    </ul>

                    <h4 class="mt-4">Dịch vụ cộng thêm</h4>
                    <ul>
                        <li>Quay phim, chụp ảnh</li>
                        <li>Áo đấu đồng phục</li>
                        <li>Cúp, huy chương</li>
                        <li>Tiệc tổng kết</li>
                    </ul>

                    <div class="alert alert-success mt-4">
                        <strong>Ưu đãi:</strong> Giảm 10% cho hợp đồng ký trước 1 tháng!
                    </div>',
                'noi_dung_ngan' => 'Nhận tổ chức giải đấu mini cho các doanh nghiệp. Hỗ trợ toàn bộ công tác tổ chức, trọng tài, y tế. Liên hệ ngay để được tư vấn chi tiết...',
                'hinh_anh'      => '/assets/images/san_bong_ban_9.png',
                'trang_thai'    => 1,
                'ma_chu_san'    => 'KH002',
                'id_chu_san'    => 2,
            ],
        ];

        foreach($list_bai_viet as $key => $value) {
            $value['created_at'] = Carbon::now()->addDays(rand(-10, 0))->format('Y-m-d H:i:s');
            $value['updated_at'] = Carbon::now()->addDays(rand(-10, 0))->format('Y-m-d H:i:s');
            DB::table('bai_viets')->insert($value);
        }
    }
}
