@extends("KhachHang.Share.master")
@section("content")
    <div class="row" id="app">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Danh Sách Sân Bóng Đã Đăng Ký</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="text-center text-white bg-primary">
                                <tr>
                                    <th class="text-center align-middle text-white" style="width: 50px">#</th>
                                    <th class="align-middle text-white">Tên Sân</th>
                                    <th class="align-middle text-white">Loại Sân</th>
                                    <th class="align-middle text-white">Tiền Thuê</th>
                                    <th class="align-middle text-white">Thời Hạn</th>
                                    <th class="align-middle text-white">Tiền Cọc</th>
                                    <th class="align-middle text-white" style="width: 150px">Trạng Thái</th>
                                    <th class="align-middle text-white" style="width: 200px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="list.length">
                                    <tr v-for="(item, index) in list">
                                        <th class="text-center align-middle">@{{ index + 1 }}</th>
                                        <td class="align-middle">@{{ item.ten_san }}</td>
                                        <td class="align-middle">@{{ item.ten_khu_vuc }}</td>
                                        <td class="text-end align-middle">@{{ formatPrice(item.gia_thue_san) }}đ</td>
                                        <td class="text-center align-middle">@{{ item.thoi_han }} tháng</td>
                                        <td class="text-end align-middle">@{{ formatPrice(item.phan_tram_coc * item.gia_thue_san / 100) }}đ</td>
                                        <td class="text-center align-middle fs-6">
                                            <span v-if="item.trang_thai_duyet == 1"
                                                class="badge bg-success text-white w-100 px-3 py-2">
                                                <i class="fas fa-check-circle me-1"></i> Đã Duyệt
                                            </span>
                                            <span v-else-if="item.trang_thai_duyet == 2"
                                                class="badge bg-danger text-white w-100 px-3 py-2">
                                                <i class="fas fa-times-circle me-1"></i> Đã Trả Sân
                                            </span>
                                            <span v-else
                                                class="badge bg-warning text-dark w-100 px-3 py-2">
                                                <i class="fas fa-clock me-1"></i> Chờ Duyệt
                                            </span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="d-flex gap-2 justify-content-center">
                                                <template v-if="item.trang_thai_duyet == 1">
                                                    <button class="btn btn-info btn-sm text-white"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#traSanModal"
                                                        v-on:click="showModal(item)">
                                                        <i class="fas fa-undo-alt me-1"></i> Trả Sân
                                                    </button>
                                                    <button class="btn btn-primary btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#cauHinhGiaModal"
                                                        v-on:click="showModal(item);getListKhungGio(item)">
                                                        <i class="fas fa-cog me-1"></i> Cấu Hình
                                                    </button>
                                                </template>
                                                <button v-else-if="item.trang_thai_duyet == 0"
                                                    class="btn btn-danger btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#huyDangKyModal">
                                                    <i class="fas fa-times me-1"></i> Huỷ Đăng Ký
                                                </button>
                                                <button v-else
                                                    class="btn btn-secondary btn-sm" disabled>
                                                    <i class="fas fa-ban me-1"></i> Đã Kết Thúc
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                                <template v-else>
                                    <tr>
                                        <td colspan="8" class="text-center">Không có dữ liệu</td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="traSanModal" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Xác Nhận Trả Sân</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info" role="alert">
                            <h6>Thông Tin Sân Bóng</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Tên sân:</strong> @{{ selected_item.ten_san }}</p>
                                    <p class="mb-1"><strong>Loại Sân:</strong> @{{ selected_item.ten_khu_vuc }}</p>
                                    <p class="mb-1"><strong>Diện tích:</strong> @{{ selected_item.dien_tich }}m²</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Giá thuê:</strong> @{{ formatPrice(selected_item.gia_thue_san) }}đ</p>
                                    <p class="mb-1"><strong>Thời hạn:</strong> @{{ selected_item.thoi_han }} tháng</p>
                                    <p class="mb-1"><strong>Ngày đăng ký:</strong> @{{ formatDate(selected_item.created_at) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-warning" role="alert">
                            <div class="mb-2">
                                <strong>Lưu ý:</strong>
                                <ul class="mb-0 mt-2">
                                    <li>Sau khi trả sân, bạn sẽ không còn quyền quản lý sân này nữa</li>
                                    <li>Tiền cọc sẽ được hoàn trả sau 3-5 ngày làm việc</li>
                                    <li>Hành động này không thể hoàn tác</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                        <button type="button" class="btn btn-danger" @click="traSan">Xác Nhận Trả Sân</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="cauHinhGiaModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cấu Hình Giá Thuê</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info" role="alert">
                            <div class="row">
                                <div class="col-md-3">
                                    <p class="mb-1"><strong>Tên sân:</strong> @{{ selected_item.ten_san }}</p>
                                </div>
                                <div class="col-md-3">
                                    <p class="mb-1"><strong>Loại Sân:</strong> @{{ selected_item.ten_khu_vuc }}</p>
                                </div>
                                <div class="col-md-3">
                                    <p class="mb-1"><strong>Diện tích:</strong> @{{ selected_item.dien_tich }}m²</p>
                                </div>
                                <div class="col-md-3">
                                    <p class="mb-1"><strong>Giá thuê cơ bản:</strong> @{{ formatPrice(selected_item.gia_thue_san) }}đ</p>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h6 class="mb-0 text-white">Thêm Khung Giờ Mới</h6>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-end">
                                    <div class="col-md-3">
                                        <label>Giờ Bắt Đầu</label>
                                        <input type="time" class="form-control" v-model="add.thoi_gian_bat_dau">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Giờ Kết Thúc</label>
                                        <input type="time" class="form-control" v-model="add.thoi_gian_ket_thuc">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Giá Thuê</label>
                                        <input type="number" class="form-control" v-model="add.gia_tien_gio">
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-primary w-100" v-on:click="themKhungGio()">
                                            <i class="fas fa-plus me-2"></i> Thêm
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive mt-4">
                            <table class="table table-bordered">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="text-center align-middle">#</th>
                                        <th class="text-center align-middle">Giờ Bắt Đầu</th>
                                        <th class="text-center align-middle">Giờ Kết Thúc</th>
                                        <th class="text-center align-middle">Giá Thuê</th>
                                        <th class="text-center align-middle">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(value, key) in list_khung_gio">
                                        <th class="text-center align-middle">@{{ key + 1 }}</th>
                                        <td class="text-center align-middle">@{{ value.thoi_gian_bat_dau }}</td>
                                        <td class="text-center align-middle">@{{ value.thoi_gian_ket_thuc }}</td>
                                        <td class="text-end align-middle">@{{ formatPrice(value.gia_tien_gio) }}đ</td>
                                        <td class="text-center align-middle">
                                            <button class="btn btn-danger btn-sm" v-on:click="xoaKhungGio(key)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary" v-on:click="capNhatCauHinh()">
                            <i class="fas fa-save me-2"></i> Cập Nhật Cấu Hình
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="huyDangKyModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Xác Nhận Huỷ Đăng Ký</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info" role="alert">
                            <h6>Thông Tin Sân Bóng</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Tên sân:</strong> @{{ selected_item.ten_san }}</p>
                                    <p class="mb-1"><strong>Loại Sân:</strong> @{{ selected_item.ten_khu_vuc }}</p>
                                    <p class="mb-1"><strong>Diện tích:</strong> @{{ selected_item.dien_tich }}m²</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Giá thuê:</strong> @{{ formatPrice(selected_item.gia_thue_san) }}đ</p>
                                    <p class="mb-1"><strong>Thời hạn:</strong> @{{ selected_item.thoi_han }} tháng</p>
                                    <p class="mb-1"><strong>Ngày đăng ký:</strong> @{{ formatDate(selected_item.created_at) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-danger" role="alert">
                            <div class="mb-2">
                                <strong>Lưu ý:</strong>
                                <ul class="mb-0 mt-2">
                                    <li>Việc huỷ đăng ký sẽ không thể hoàn tác</li>
                                    <li>Tiền cọc sẽ không được hoàn trả</li>
                                    <li>Sân sẽ được mở lại cho người khác đăng ký</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-danger" v-on:click="huyDangKy()">
                            <i class="fas fa-times me-2"></i> Xác Nhận Huỷ
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("js")
    <script>
        new Vue({
            el: '#app',
            data: {
                list            : [],
                selected_item   : {},
                add: {
                    gio_bat_dau : '',
                    gio_ket_thuc: '',
                    gia_thue    : 0
                },
                list_khung_gio  : []
            },
            mounted() {
                this.getList();
            },
            methods: {
                getList() {
                    axios.get("/khach-hang/chu-san/data").then(res => {
                        this.list = res.data.data;
                    });
                },
                formatPrice(value) {
                    return new Intl.NumberFormat('vi-VN').format(value);
                },
                traSan() {
                    axios.post("/khach-hang/chu-san/tra-san", this.selected_item)
                    .then((res) => {
                        NotifiSuccess(res, () => {
                            this.getList();
                            $("#traSanModal").modal("hide");
                        });
                    })
                    .catch((err) => {
                        NotifiError(err);
                    });
                },
                formatDate(date) {
                    return moment(date).format('DD/MM/YYYY');
                },
                showModal(item) {
                    this.selected_item = item;
                },

                themKhungGio() {
                    this.list_khung_gio.push({...this.add});
                    this.add = {
                        gio_bat_dau: '',
                        gio_ket_thuc: '',
                        gia_thue: 0
                    };
                },
                xoaKhungGio(index) {
                    this.list_khung_gio.splice(index, 1);
                },
                capNhatCauHinh() {
                    let data = {
                        id_san: this.selected_item.id,
                        list_khung_gio: this.list_khung_gio
                    };
                    axios
                        .post('/khach-hang/chu-san/cap-nhat-cau-hinh', data)
                        .then((res) => {
                            NotifiSuccess(res, () => {
                                $('#cauHinhGiaModal').modal('hide');
                            });
                        })
                        .catch((err) => {
                            NotifiError(err);
                        });
                },
                getListKhungGio(item) {
                    axios.post("/khach-hang/chu-san/get-list-khung-gio", {
                        id_san: item.id_san
                    })
                    .then(res => {
                        this.list_khung_gio = res.data.data;
                    });
                },
                huyDangKy() {
                    axios
                        .post("/khach-hang/chu-san/huy-dang-ky", this.selected_item)
                        .then((res) => {
                            NotifiSuccess(res, () => {
                                this.getList();
                                $("#huyDangKyModal").modal("hide");
                            });
                        })
                        .catch((err) => {
                            NotifiError(err);
                        });
                }
            }
        });
    </script>
@endsection
