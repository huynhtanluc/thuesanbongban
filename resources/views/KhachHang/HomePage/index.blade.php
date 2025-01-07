@extends('KhachHang.Share.master')
@section('content')
    <div id="app">
        <div class="card border-primary border-top border-3">
            <div class="card-body">
                <div id="carouselExampleCaptions" class="carousel slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <!-- <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                            aria-label="Slide 3"></button> -->
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/assets/images/banner/banner_1.jpg"
                                class="d-block w-100" alt="...">
                        </div>
                        <!-- <div class="carousel-item">
                            <img src="/assets/images/banner/banner_2.jpg"
                                class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="/assets/images/banner/banner_3.jpg"
                                class="d-block w-100" alt="...">
                        </div> -->
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card border-primary border-top border-3">
                <div class="card-body">
                    <div class="container mt-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Loại Sân</label>
                                            <select class="form-control">
                                                <template v-for="(value, index) in list_khu_vuc">
                                                    <option v-bind:value="value.id">@{{ value.ten_khu_vuc }}</option>
                                                </template>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Ngày</label>
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Thời Gian</label>
                                            <select class="form-control">
                                                <option value="0">Tất cả</option>
                                                <option value="1">Sáng</option>
                                                <option value="2">Chiều</option>
                                                <option value="3">Tối</option>
                                                <option value="4">Khuya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary w-100" style="margin-top: 32px">
                                            <i class="fas fa-search me-2"></i>Tìm Kiếm
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container mt-5">
                        <h2 class="text-center mb-4">Sân Bóng Nổi Bật</h2>
                        <hr>
                        <div class="row">
                            <template v-for="(value, index) in list_san">
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100 shadow border-success border-bottom border-3">
                                        <img src="https://media.istockphoto.com/id/906517064/vi/anh/thi%E1%BA%BFt-b%E1%BB%8B-b%C3%A0n-b%C3%B3ng-b%C3%A0n.jpg?s=612x612&w=0&k=20&c=U2L7twpkZHZ57Yzumtvk-cIumi41ZmmStXPa-baM0vY=" class="card-img-top" style="height: 200px; object-fit: cover;">
                                        <div class="card-body">
                                            <h5 class="card-title">@{{ value.ten_san }}</h5>
                                            <p class="card-text">
                                                <i class="fas fa-map-marker-alt text-danger me-2"></i>@{{ value.ten_khu_vuc }}
                                            </p>
                                            {{-- <p class="card-text">
                                                <i class="fas fa-football-ball text-success me-2"></i>@{{ value.loai_san }}
                                            </p> --}}
                                            <p class="card-text">
                                                <i class="fas fa-user text-primary me-2"></i>@{{ value.ten_chu_san }}
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <button class="btn btn-inverse-success"  data-bs-toggle="modal"
                                                data-bs-target="#chiTietModal" v-on:click="chi_tiet = Object.assign({}, value); chiTietSan(value.id)">
                                                    <i class="bx bx-info-circle"></i>
                                                    <span class="d-none d-sm-inline">Xem Chi Tiết</span>
                                                </button>
                                                @if (Auth::guard('khach_hang')->check())
                                                    <button class="btn btn-primary" v-on:click="showDatSanModal(value);chiTietKhungGio(value)">Đặt Sân</button>
                                                @else
                                                    <a href="/login" class="btn btn-primary">Đặt Sân</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="container mt-5">
                        <h2 class="text-center mb-4">Tại Sao Chọn Chúng Tôi?</h2>
                        <div class="row">
                            <div class="col-md-4 text-center mb-4">
                                <div class="card shadow border-primary border-bottom border-3">
                                    <div class="card-body">
                                        <div class="p-3">
                                            <i class="fas fa-medal fa-3x text-primary mb-3"></i>
                                            <h4>Chất Lượng Hàng Đầu</h4>
                                            <p>Hệ thống sân đạt chuẩn Quốc Tế</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center mb-4">
                                <div class="card shadow border-primary border-bottom border-3">
                                    <div class="card-body">
                                        <div class="p-3">
                                            <i class="fas fa-clock fa-3x text-primary mb-3"></i>
                                            <h4>Đặt Sân Dễ Dàng</h4>
                                            <p>Đặt sân nhanh chóng chỉ với vài thao tác</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center mb-4">
                                <div class="card shadow border-primary border-bottom border-3">
                                    <div class="card-body">
                                        <div class="p-3">
                                            <i class="fas fa-hand-holding-usd fa-3x text-primary mb-3"></i>
                                            <h4>Giá Cả Hợp Lý</h4>
                                            <p>Cam kết giá tốt nhất Loại Sân</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container mt-5 mb-5">
                        <h2 class="text-center mb-4">Tin Tức & Sự Kiện</h2>
                        <div class="row">
                            <template v-for="(value, index) in list_bai_viet">
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100 shadow border-warning border-bottom border-3">
                                        <img :src="value.hinh_anh" class="card-img-top" style="height: 200px; object-fit: cover;">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">@{{ value.ten_bai_viet }}</h5>
                                            <p class="text-muted">
                                                <i class="far fa-calendar-alt me-2"></i>@{{ value.ngay_dang }}
                                            </p>
                                            <p class="card-text flex-grow-1" v-html="formatContent(value.noi_dung)"></p>
                                            <div class="text-center mt-auto">
                                                <a v-bind:href="'/chi-tiet-bai-viet/' + value.id" class="btn btn-outline-primary w-100">Xem thêm</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="chiTietModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white">Thông Tin Sân Bóng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-primary">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-2">
                                                <label class="fw-bold">Tên sân:</label>
                                                <div class="border rounded p-2">@{{ chi_tiet.ten_san }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-2">
                                                <label class="fw-bold">Loại Sân:</label>
                                                <div class="border rounded p-2">@{{ chi_tiet.ten_khu_vuc }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-2">
                                                <label class="fw-bold">Diện tích:</label>
                                                <div class="border rounded p-2">@{{ chi_tiet.dien_tich }}m²</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-2">
                                                <label class="fw-bold">Chủ Sân:</label>
                                                <div class="border rounded p-2">@{{ chi_tiet.ten_chu_san }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card border-primary mb-3">
                                    <div class="card-header bg-primary">
                                        <h5 class="mb-0 text-white">Bảng Giá Theo Khung Giờ</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            <template v-for="(value, index) in list_bang_gia">
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    @{{ value.thoi_gian_bat_dau }} - @{{ value.thoi_gian_ket_thuc }}
                                                    <span class="badge bg-primary rounded-pill p-2">@{{ formatPrice(value.gia_tien_gio) }}đ/giờ</span>
                                                </li>
                                            </template>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card border-success">
                                    <div class="card-header bg-success ">
                                        <h5 class="mb-0 text-white">Lịch Đặt Sân Hôm Nay</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th class="text-center">Thời Gian Bắt Đầu</th>
                                                        <th class="text-center">Thời Gian Kết Thúc</th>
                                                        <th class="text-center">Tên Khách Hàng</th>
                                                        <th class="text-center">Số Điện Thoại</th>
                                                        <th class="text-center">Trạng Thái</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <template v-for="(value, index) in list_lich_dat">
                                                        <tr>
                                                            <th class="text-center align-middle">@{{ index + 1 }}</th>
                                                            <td class="text-center align-middle">@{{ formatTime(value.thoi_gian_bat_dau) }}</td>
                                                            <td class="text-center align-middle">@{{ formatTime(value.thoi_gian_ket_thuc) }}</td>
                                                            <td class="text-center align-middle">@{{ value.ten_khach_hang }}</td>
                                                            <td class="text-center align-middle">@{{ value.so_dien_thoai }}</td>
                                                            <td class="text-center align-middle">
                                                                <button v-if="value.trang_thai == 1" class="btn btn-success">Đã xác nhận</button>
                                                                <button v-else class="btn btn-warning">Chờ Xác Nhận</button>
                                                            </td>
                                                        </tr>
                                                    </template>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="datSanModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Đặt Sân</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-info" role="alert">
                                    <h6>Thông Tin Sân Bóng</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Tên sân:</strong> @{{ selected_san.ten_san }}</p>
                                            <p class="mb-1"><strong>Loại Sân:</strong> @{{ selected_san.ten_khu_vuc }}</p>
                                            <p class="mb-1"><strong>Diện tích:</strong> @{{ selected_san.dien_tich }}m²</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Chủ sân:</strong> @{{ selected_san.ten_chu_san }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="alert alert-info mt-3">
                                    <h6 class="mb-2"><strong>Bảng Giá Theo Khung Giờ:</strong></h6>
                                    <div v-if="list_khung_gio.length">
                                        <template v-for="(item, index) in list_khung_gio">
                                            <p class="mb-1">
                                                • @{{ item.thoi_gian_bat_dau }} - @{{ item.thoi_gian_ket_thuc }}:
                                                <strong>@{{ formatPrice(item.gia_tien_gio) }}đ/giờ</strong>
                                            </p>
                                        </template>
                                    </div>
                                    <div v-else>
                                        <p class="mb-0 text-danger">Chưa có cấu hình giá theo khung giờ!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>Ngày Thuê</label>
                                    <input type="date" class="form-control" v-model="datSan.ngay_thue" :min="getCurrentDate()">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Giờ Bắt Đầu</label>
                                            <input type="time" class="form-control" v-model="datSan.gio_bat_dau"
                                                @change="tinhSoPhut()">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Giờ Kết Thúc</label>
                                            <input type="time" class="form-control" v-model="datSan.gio_ket_thuc"
                                                @change="tinhSoPhut()">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Số Phút Thuê</label>
                                    <input type="number" class="form-control" v-model="datSan.so_phut" readonly>
                                </div>
                                <div class="alert alert-warning" role="alert">
                                    <div class="mb-2">
                                        <strong>Tổng tiền: </strong>
                                        <span v-if="tinhTongTien() > 0">@{{ formatPrice(tinhTongTien()) }}đ</span>
                                        <span v-else class="text-danger">Vui lòng chọn khung giờ phù hợp!</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button v-on:click="xuLyDatSan()" type="button" class="btn btn-primary">Đặt Sân</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('js')
    <script>
        new Vue({
            el: '#app',
            data: {
                list_khu_vuc    : [],
                list_san        : [],
                chi_tiet        : {},
                list_bang_gia   : [],
                list_lich_dat   : [],
                list_bai_viet   : [],
                datSan: {
                    ngay_thue: '',
                    gio_bat_dau: '',
                    gio_ket_thuc: '',
                    so_phut: 0
                },
                list_khung_gio  : [],
                selected_san    : {},
            },
            mounted() {
                this.get_khuvuc();
                this.getDataHomeKhachHang();
            },
            methods: {
                getCurrentDate() {
                    return new Date().toISOString().split('T')[0];
                },

                tinhSoPhut() {
                    if(this.datSan.gio_bat_dau && this.datSan.gio_ket_thuc) {
                        let ngayThue = this.datSan.ngay_thue;
                        let start = new Date(`${ngayThue} ${this.datSan.gio_bat_dau}`);
                        let end = new Date(`${ngayThue} ${this.datSan.gio_ket_thuc}`);
                        let diff = end - start;
                        this.datSan.so_phut = Math.floor(diff / 1000 / 60);
                        if(this.datSan.so_phut < 0) {
                            this.datSan.so_phut = 0;
                            toastr.error('Giờ kết thúc phải sau giờ bắt đầu!');
                        }
                    }
                },

                tinhTongTien() {
                    if(!this.datSan.ngay_thue || !this.datSan.gio_bat_dau || !this.datSan.gio_ket_thuc || this.datSan.so_phut <= 0) {
                        return 0;
                    }

                    let ngayThue = this.datSan.ngay_thue;
                    let start = new Date(`${ngayThue} ${this.datSan.gio_bat_dau}`);
                    let end = new Date(`${ngayThue} ${this.datSan.gio_ket_thuc}`);

                    let khungGioHopLe = this.list_khung_gio.filter(item => {
                        let khungStart = new Date(`${ngayThue} ${item.thoi_gian_bat_dau}`);
                        let khungEnd = new Date(`${ngayThue} ${item.thoi_gian_ket_thuc}`);

                        return (start >= khungStart && end <= khungEnd) ||
                               (start >= khungStart && start <= khungEnd) ||
                               (end >= khungStart && end <= khungEnd);
                    });

                    if(khungGioHopLe.length == 0) {
                        toastr.error('Không tìm thấy khung giờ phù hợp!');
                        return 0;
                    }

                    let khungGioApDung = khungGioHopLe.reduce((max, current) => {
                        return current.gia_tien_gio > max.gia_tien_gio ? current : max;
                    }, khungGioHopLe[0]);

                    let gia_mot_phut = khungGioApDung.gia_tien_gio / 60;
                    return Math.round(gia_mot_phut * this.datSan.so_phut);
                },

                showDatSanModal(item) {
                    this.selected_san = item;
                    this.datSan = {
                        ngay_thue: this.getCurrentDate(),
                        gio_bat_dau: '',
                        gio_ket_thuc: '',
                        so_phut: 0
                    };
                    $('#datSanModal').modal('show');
                },

                chiTietKhungGio(item) {
                    axios.post('/khach-hang/chu-san/get-list-khung-gio', {
                        id_san: item.id
                    })
                    .then((res) => {
                        this.list_khung_gio = res.data.data;
                    });
                },

                formatPrice(value) {
                    return new Intl.NumberFormat('vi-VN').format(value);
                },
                formatTime(date) {
                    return moment(date).format('HH:mm');
                },
                get_khuvuc() {
                    axios.get('/khach-hang/khu-vuc/data')
                        .then((res) => {
                            this.list_khu_vuc = res.data.data;
                        });
                },

                getDataHomeKhachHang() {
                    axios.get('/data-home-khach-hang')
                        .then((res) => {
                            this.list_san       = res.data.list_san_noi_bat;
                            this.list_bai_viet  = res.data.list_bai_viet;
                        });
                },

                chiTietSan(id) {
                    axios.get('/chi-tiet-san-bong/' + id)
                        .then((res) => {
                            this.list_bang_gia = res.data.list_bang_gia;
                            this.list_lich_dat = res.data.list_lich_dat;
                        });
                },

                formatContent(content) {
                    if(content.length > 100) {
                        return content.substring(0, 100) + '...';
                    }
                    return content;
                },
            }
        });
    </script>
@endsection
