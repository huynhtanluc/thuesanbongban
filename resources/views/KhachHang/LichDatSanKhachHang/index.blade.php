@extends("KhachHang.Share.master")
@section('content')
    <div class="row" id="app">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mt-2">Danh Sách Đơn Đặt Sân Của Khách Hàng</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table_lich_dat">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Mã Thuê Sân</th>
                                    <th class="text-center">Tên Sân</th>
                                    <th class="text-center">Tên Khách Hàng</th>
                                    <th class="text-center">Ngày Đặt</th>
                                    <th class="text-center">Giờ Bắt Đầu</th>
                                    <th class="text-center">Giờ Kết Thúc</th>
                                    <th class="text-center">Tổng Tiền</th>
                                    <th class="text-center">Cần Cọc</th>
                                    <th class="text-center">Tiền Đã Cọc</th>
                                    <th class="text-center">Trạng Thái</th>
                                    <th class="text-center">Thanh Toán</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in listLichDatSan">
                                    <td class="text-center align-middle">@{{ index + 1 }}</td>
                                    <td class="align-middle text-center">@{{ item.ma_thue_san }}</td>
                                    <td class="align-middle">@{{ item.ten_san }}</td>
                                    <td class="align-middle">@{{ item.ten_khach_hang }}</td>
                                    <td class="text-center align-middle">@{{ (item.ngay_dat) }}</td>
                                    <td class="text-center align-middle">@{{ (item.gio_bat_dau) }}</td>
                                    <td class="text-center align-middle">@{{ (item.gio_ket_thuc) }}</td>
                                    <td class="text-end align-middle">@{{ formatPrice(item.thanh_tien) }}đ</td>
                                    <td class="text-end align-middle">@{{ formatPrice(item.thanh_tien * 0.3) }}đ</td>
                                    <td class="text-end align-middle">@{{ formatPrice(item.so_tien_coc) }}đ</td>
                                    <td class="text-center align-middle">
                                        <button v-if="item.trang_thai == 0"  class="btn btn-warning text-white" @click="chi_tiet = Object.assign({}, item)" data-bs-toggle="modal" data-bs-target="#xacNhanModal">Chờ xác nhận</button>
                                        <button v-else-if="item.trang_thai == 1"  class="btn btn-success text-white">Đã Xác Nhận</button>
                                        <button v-else class="btn btn-warning text-white">Đã Huỷ</button>
                                    </td>
                                    <td class="text-center align-middle">
                                        <button v-if="item.thanh_toan == 0" class="btn btn-primary text-white w-100">Chưa Cọc</button>
                                        <button v-else-if="item.thanh_toan == 1"  class="btn btn-info text-white w-100" @click="thanhToanHoanTat(item)">Đã Cọc</button>
                                        <button v-else class="btn btn-success text-white w-100">Đã Thanh Toán</button>
                                    </td>
                                    <td class="text-center align-middle">
                                        <button class="btn btn-info text-white text-center" @click="chi_tiet = Object.assign({}, item)" data-bs-toggle="modal" data-bs-target="#chiTietModal">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>

                                        <button v-if="item.trang_thai == 0" class="btn btn-danger text-white text-center" @click="chi_tiet = Object.assign({}, item);huyDonDatSan()">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="modal fade" id="chiTietModal" tabindex="-1" aria-labelledby="chiTietModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="chiTietModalLabel">Chi Tiết Đơn Đặt Sân</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label fw-bold">Tên Khách Hàng</label>
                                                <div class="border rounded p-2">@{{ chi_tiet.ten_khach_hang }}</div>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label fw-bold">Số Điện Thoại</label>
                                                <div class="border rounded p-2">@{{ chi_tiet.so_dien_thoai }}</div>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label fw-bold">Tên Sân</label>
                                                <div class="border rounded p-2">@{{ chi_tiet.ten_san }}</div>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label fw-bold">Tiền Cọc</label>
                                                <div class="border rounded p-2">@{{ formatPrice(chi_tiet.so_tien_coc) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label fw-bold">Ngày Đặt</label>
                                                <div class="border rounded p-2">@{{ chi_tiet.ngay_dat }}</div>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label fw-bold">Thời Gian</label>
                                                <div class="border rounded p-2">@{{ chi_tiet.gio_bat_dau }} - @{{ chi_tiet.gio_ket_thuc }} (@{{ chi_tiet.so_gio_thue }} giờ)</div>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label fw-bold">Tổng Tiền</label>
                                                <div class="border rounded p-2 text-danger fw-bold">@{{ formatPrice(chi_tiet.thanh_tien) }}</div>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label fw-bold">Còn Lại</label>
                                                <div class="border rounded p-2 text-danger fw-bold">@{{ formatPrice(chi_tiet.thanh_tien - chi_tiet.so_tien_coc) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="fa-solid fa-xmark me-2"></i>Đóng
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="xacNhanModal" tabindex="-1" aria-labelledby="xacNhanModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="xacNhanModalLabel">Xác Nhận Đặt Sân</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label fw-bold">Tên Khách Hàng</label>
                                                <div class="border rounded p-2">@{{ chi_tiet.ten_khach_hang }}</div>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label fw-bold">Số Điện Thoại</label>
                                                <div class="border rounded p-2">@{{ chi_tiet.so_dien_thoai }}</div>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label fw-bold">Tên Sân</label>
                                                <div class="border rounded p-2">@{{ chi_tiet.ten_san }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label fw-bold">Ngày Đặt</label>
                                                <div class="border rounded p-2">@{{ chi_tiet.ngay_dat }}</div>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label fw-bold">Thời Gian</label>
                                                <div class="border rounded p-2">@{{ chi_tiet.gio_bat_dau }} - @{{ chi_tiet.gio_ket_thuc }} (@{{ chi_tiet.so_gio_thue }} giờ)</div>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label fw-bold">Tổng Tiền</label>
                                                <div class="border rounded p-2 text-danger fw-bold">@{{ formatPrice(chi_tiet.thanh_tien) }}đ</div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-2">
                                                <label class="form-label fw-bold">Số Tiền Cọc (Ít nhất 30%)</label>
                                                <input type="number" class="form-control" v-model="chi_tiet.so_tien_coc" min="0" :max="chi_tiet.thanh_tien">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Đóng
                                    </button>
                                    <button type="button" class="btn btn-primary" @click="xacNhanDonDatSan()">
                                        Xác Nhận
                                    </button>
                                </div>
                            </div>
                        </div>
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
            listLichDatSan  : [],
            chi_tiet        : {}
        },
        mounted() {
            this.getListLichDatSan();
        },
        methods: {
            getListLichDatSan() {
                axios.get('/khach-hang/lich-thue-san-khach-hang/data')
                    .then((res) => {
                        this.listLichDatSan = res.data.data;
                    });
            },

            formatDate(date) {
                return moment(date).format('DD/MM/YYYY');
            },
            formatTime(date) {
                return moment(date).format('HH:mm');
            },
            formatPrice(value) {
                return new Intl.NumberFormat('vi-VN').format(value);
            },

            xacNhanDonDatSan() {
                axios.post('/khach-hang/lich-thue-san-khach-hang/xac-nhan-dat-san', this.chi_tiet)
                    .then((res) => {
                        NotifiSuccess(res, () =>{
                            this.getListLichDatSan();
                            $('#xacNhanModal').modal('hide');
                        });
                    })
                    .catch((err) => {
                        NotifiError(err);
                    });
            },

            huyDonDatSan() {
                axios.post('/khach-hang/lich-thue-san-khach-hang/huy-dat-san', this.chi_tiet)
                    .then((res) => {
                        NotifiSuccess(res, () =>{
                            this.getListLichDatSan();
                        });
                    })
                    .catch((err) => {
                        NotifiError(err);
                    });
            },

            thanhToanHoanTat(value) {
                axios.post('/khach-hang/lich-thue-san-khach-hang/thanh-toan-hoan-tat', value)
                    .then((res) => {
                        NotifiSuccess(res, () => {
                            this.getListLichDatSan();
                        });
                    });
            }
        }
    });
</script>
@endsection
