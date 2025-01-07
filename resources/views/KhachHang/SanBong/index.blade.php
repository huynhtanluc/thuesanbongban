@extends('KhachHang.Share.master')

@section('content')
    <div class="row" id="app">
        <div class="row mb-4">
            <div class="col-lg-5 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent"><i class="bx bx-search"></i></span>
                            <input type="text" class="form-control border-start-0" v-model="search"
                                placeholder="Tìm kiếm theo tên sân, Loại Sân...">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <select class="form-select" v-model="selectedKhuVuc">
                            <option value="">-- Chọn Loại Sân --</option>
                            <option v-for="(value, index) in dsKhuVuc" :value="value.id">
                                @{{ value.ten_khu_vuc }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <select class="form-select" v-model="selectedChuSan">
                            <option value="">-- Chọn Chủ Sân --</option>
                            <option value="1">Đã Có Chủ Sân</option>
                            <option value="0">Chưa Có Chủ Sân</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <template v-for="(value, index) in filteredList">
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div v-bind:class="value.ten_chu_san == null ? 'card border-danger border-bottom border-3 border-0 h-100' : 'card border-primary border-bottom border-3 border-0 h-100'">
                        <img src="https://media.istockphoto.com/id/906517064/vi/anh/thi%E1%BA%BFt-b%E1%BB%8B-b%C3%A0n-b%C3%B3ng-b%C3%A0n.jpg?s=612x612&w=0&k=20&c=U2L7twpkZHZ57Yzumtvk-cIumi41ZmmStXPa-baM0vY="
                            class="card-img-top" alt="..." style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h5 v-bind:class="value.ten_chu_san == null ? 'card-title text-danger mb-1' : 'card-title text-primary mb-1'">@{{ value.ten_san }}</h5>
                                        <p class="card-text mb-0 text-secondary">
                                            <i class="fa-brands fa-slack"></i> @{{ value.ten_khu_vuc }}
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <p class="card-text mb-1">
                                        <i class='bx bx-ruler'></i> Diện tích: @{{ value.dien_tich }}m²
                                    </p>
                                    <p class="card-text mb-1">
                                        <i class='bx bx-money'></i> Giá thuê: @{{ value.gia_thue_san ? value.gia_thue_san : 'Chưa có giá thuê' }}
                                    </p>
                                    <p class="card-text mb-1">
                                        <i class='bx bx-user'></i>
                                        Chủ sân:
                                        <span v-if="value.ten_chu_san == null" class="text-danger">Chưa có chủ sân</span>
                                        <span v-else class="text-success"> @{{ value.ten_chu_san}}</span>
                                    </p>
                                    <p class="card-text mb-1">
                                        <i class='bx bx-map'></i> Địa chỉ: @{{ value.dia_chi ? value.dia_chi : 'Chưa có địa chỉ' }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-auto">
                                <div class="row g-2">
                                    <div class="col-12 col-sm-6">
                                        <template v-if="value.ten_chu_san == null">
                                            <button class="btn btn-primary disabled w-100">
                                                <i class="bx bx-calendar"></i>
                                                <span class="d-none d-sm-inline">Đặt Sân</span>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button class="btn btn-primary w-100" v-on:click="showDatSanModal(value);chiTietKhungGio(value)">
                                                <i class="bx bx-calendar"></i>
                                                <span class="d-none d-sm-inline">Đặt Sân</span>
                                            </button>
                                        </template>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <template v-if="value.ten_chu_san == null">
                                            <button class="btn btn-success w-100"
                                                data-bs-toggle="modal"
                                                data-bs-target="#dangKiSanModel"
                                                v-on:click="showModal(value)">
                                                <i class="fa-regular fa-copyright"></i>
                                                <span class="d-none d-sm-inline">Đăng ký</span>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button class="btn btn-success disabled w-100">
                                                <i class="fa-regular fa-copyright"></i>
                                                <span class="d-none d-sm-inline">Đăng ký</span>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <div class="modal fade" id="dangKiSanModel" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Đăng Kí Sở Hữu Sân</h5>
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
                                            <p class="mb-1"><strong>Giá đấu thầu:</strong> @{{ formatPrice(selected_san.gia_dau_thau) }}đ</p>
                                            <p class="mb-1"><strong>Phần trăm cọc:</strong> @{{ selected_san.phan_tram_coc }}%</p>
                                            <p class="mb-1"><strong>Tiền cọc:</strong> @{{ formatPrice(selected_san.gia_dau_thau * selected_san.phan_tram_coc / 100) }}đ</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>Giá Thuê Đề Xuất</label>
                                    <input type="number" class="form-control" v-model="add.gia_thue_san"
                                        :min="selected_san.gia_dau_thau">
                                    <small class="text-danger" v-if="add.gia_thue_san < selected_san.gia_dau_thau">
                                        Giá thuê phải lớn hơn hoặc bằng giá đấu thầu!
                                    </small>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Thời Hạn Thuê (tháng)</label>
                                    <input type="number" class="form-control" v-model="add.thoi_han" min="1">
                                </div>
                                <div class="alert alert-warning" role="alert">
                                    <div class="mb-2">
                                        <strong>Tổng tiền cọc phải đóng: </strong>
                                        @{{ formatPrice(add.gia_thue_san * selected_san.phan_tram_coc / 100) }}đ
                                    </div>
                                    <small>
                                        * Lưu ý: Sau khi đăng ký, bạn cần đóng tiền cọc trong vòng 24h.
                                        Nếu không, đăng ký sẽ bị hủy tự động.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button v-on:click="dangKiSan()" type="button" class="btn btn-primary">Đăng Kí</button>
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
                list            : [],
                dsKhuVuc        : [],
                search          : '',
                selectedKhuVuc  : '',
                selectedChuSan  : '',
                selected_san    : {},
                add             : {
                    gia_thue_san: 0,
                    thoi_han: 1,
                },
                datSan: {
                    ngay_thue: '',
                    gio_bat_dau: '',
                    gio_ket_thuc: '',
                    so_phut: 0
                },
                list_khung_gio: []
            },
            computed: {
                filteredList() {
                    let filtered = this.list;
                    if (this.search) {
                        filtered = filtered.filter(item => {
                            return item.ten_san.toLowerCase().includes(this.search.toLowerCase()) ||
                                item.ten_khu_vuc.toLowerCase().includes(this.search.toLowerCase());
                        });
                    }

                    if (this.selectedKhuVuc) {
                        filtered = filtered.filter(item => item.id_khu_vuc == this.selectedKhuVuc);
                    }

                    if (this.selectedChuSan !== '') {
                        if (this.selectedChuSan == 1) {
                            filtered = filtered.filter(item => item.ten_chu_san != null);
                        } else {
                            filtered = filtered.filter(item => item.ten_chu_san == null);
                        }
                    }

                    return filtered;
                }
            },
            mounted() {
                this.getListSanBong();
                this.getListKhuVuc();
            },
            methods: {
                getListSanBong() {
                    axios.get('/khach-hang/san-bong/data')
                        .then((res) => {
                            this.list = res.data.data;
                        });
                },
                getListKhuVuc() {
                    axios.get('/khach-hang/khu-vuc/data')
                        .then((res) => {
                            this.dsKhuVuc = res.data.data;
                        });
                },

                formatPrice(value) {
                    return new Intl.NumberFormat('vi-VN').format(value);
                },

                showModal(item) {
                    this.selected_san       = item;
                    this.add.gia_thue_san   = item.gia_dau_thau;
                    this.add.thoi_han       = 1;
                },

                dangKiSan() {
                    this.selected_san.gia_thue_san = this.add.gia_thue_san;
                    this.selected_san.thoi_han      = this.add.thoi_han;

                    axios.post('/khach-hang/san-bong/dang-ki', this.selected_san)
                        .then((res) => {
                            NotifiSuccess(res, () => {
                                this.getListSanBong();
                                $('#dangKiSanModel').modal('hide');
                            });
                        })
                        .catch((err) => {
                            NotifiError(err);
                        });
                },

                xuLyDatSan() {
                    var payload = {
                        'thoi_gian_bat_dau': this.datSan.gio_bat_dau,
                        'thoi_gian_ket_thuc': this.datSan.gio_ket_thuc,
                        'ngay_thue': this.datSan.ngay_thue,
                        'so_gio_thue': this.datSan.so_phut / 60,
                        'thanh_tien': this.tinhTongTien(),
                        'id_khach_hang': this.selected_san.id_khach_hang,
                        'id_san': this.selected_san.id,
                    };

                    axios.post('/khach-hang/san-bong/dat-san', payload)
                        .then((res) => {
                            NotifiSuccess(res, () => {
                                $('#datSanModal').modal('hide');
                            });
                        })
                        .catch((err) => {
                            NotifiError(err);
                        });
                },

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
                }
            }
        });
    </script>
@endsection
