@extends('KhachHang.Share.master')
@section('content')
<div class="row" id="app">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mt-2">Lịch Sử Thuê Sân</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="text-center text-nowrap bg-primary text-white">
                            <tr>
                                <th class="text-center align-middle">#</th>
                                <th class="align-middle">Tên Sân</th>
                                <th class="align-middle">Loại Sân</th>
                                <th class="align-middle">Ngày Thuê</th>
                                <th class="align-middle">Thời Gian</th>
                                <th class="align-middle">Số Giờ</th>
                                <th class="align-middle">Số Tiền</th>
                                <th class="align-middle">Thanh Toán</th>
                                <th class="align-middle">Trạng Thái</th>
                                <th class="align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(value, key) in list">
                                <tr>
                                    <th class="text-center align-middle">@{{ key + 1 }}</th>
                                    <td class="align-middle">@{{ value.ten_san }}</td>
                                    <td class="align-middle">@{{ value.ten_khu_vuc }}</td>
                                    <td class="text-center align-middle">@{{ formatDate(value.thoi_gian_bat_dau) }}</td>
                                    <td class="text-center align-middle">
                                        @{{ formatTime(value.thoi_gian_bat_dau) }} - @{{ formatTime(value.thoi_gian_ket_thuc) }}
                                    </td>
                                    <td class="text-center align-middle">@{{ value.so_gio_thue }}</td>
                                    <td class="text-end align-middle">@{{ formatPrice(value.thanh_tien) }}đ</td>
                                    <td class="text-center align-middle">
                                        <button v-if="value.thanh_toan == 2"
                                            class="btn btn-success w-75">Đã Thanh Toán</button>
                                        <button v-else-if="value.thanh_toan == 1"
                                            class="btn btn-primary w-75" data-bs-toggle="modal" data-bs-target="#thanhToanModal" @click="selected = Object.assign({}, value);getThongTinThanhToan(value);thanh_toan_tat_ca = true; updateLink()">Đã Cọc</button>
                                        <button v-else
                                            class="btn btn-danger w-75" data-bs-toggle="modal"
                                            data-bs-target="#thanhToanModal" @click="selected = Object.assign({}, value);getThongTinThanhToan(value)">Chưa Thanh Toán</button>
                                    </td>
                                    <td class="text-center align-middle ">
                                        <button v-if="getTrangThai(value) == 0"
                                            class="btn btn-warning text-white w-75">Chưa Bắt Đầu</button>
                                        <button v-else-if="getTrangThai(value) == 1"
                                            class="btn btn-primary text-white w-75">Đang Diễn Ra</button>
                                        <button v-else
                                            class="btn btn-secondary text-white w-75">Đã Kết Thúc</button>
                                    </td>
                                    <td class="text-center align-middle">
                                        <button v-if="getTrangThai(value) == 0"
                                            class="btn btn-danger w-100"
                                            v-on:click="huyLich(value)"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal">
                                            <i class="fas fa-times me-2"></i>Huỷ Lịch
                                        </button>
                                        <button v-else
                                            class="btn btn-secondary w-100" disabled>
                                            <i class="fas fa-ban me-2"></i>Huỷ Lịch
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Huỷ Lịch -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xác Nhận Huỷ Lịch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn huỷ lịch đặt sân này?</p>
                    <div class="alert alert-info">
                        <p class="mb-0"><strong>Tên sân:</strong> @{{ selected.ten_san }}</p>
                        <p class="mb-0"><strong>Thời gian:</strong>
                            @{{ formatDate(selected.thoi_gian_bat_dau) }}
                            (@{{ formatTime(selected.thoi_gian_bat_dau) }} - @{{ formatTime(selected.thoi_gian_ket_thuc) }})
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" v-on:click="xacNhanHuy()">Xác Nhận Huỷ</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Thanh Toán -->
    <div class="modal fade" id="thanhToanModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thanh Toán Tiền Thuê</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-header bg-info text-white">
                                    <h6 class="mb-0">Thông Tin Đặt Sân</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Mã Đặt Sân:</th>
                                            <td><span class="text-primary">@{{selected.ma_thue_san}}</span></td>
                                        </tr>
                                        <tr>
                                            <th>Tên Sân:</th>
                                            <td>@{{selected.ten_san}} - @{{selected.ten_khu_vuc}}</td>
                                        </tr>
                                        <tr>
                                            <th>Thời Gian:</th>
                                            <td> @{{ formatTime(selected.thoi_gian_bat_dau) }} - @{{ formatTime(selected.thoi_gian_ket_thuc) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Số Giờ:</th>
                                            <td>@{{ selected.so_gio_thue }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tổng Tiền:</th>
                                            <td class="text-danger fw-bold">@{{ formatPrice(selected.thanh_tien) }}đ</td>
                                        </tr>
                                        <tr>
                                            <th>Tiền Cọc (30%):</th>
                                            <td class="text-success fw-bold">@{{ formatPrice(selected.thanh_tien * 0.3) }}đ</td>
                                        </tr>
                                        <tr v-if="selected.thanh_toan == 1">
                                            <th>Còn Lại</i> (70%):</th>
                                            <td class="text-warning fw-bold">@{{ formatPrice(selected.thanh_tien - selected.so_tien_coc) }}đ</td>
                                        </tr>
                                    </table>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" checked="" v-model="thanh_toan_tat_ca" id="flexSwitchCheckChecked" @change="updateLink()">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Thanh Toán Tất Cả</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h6 class="mb-0">Thông Tin Thanh Toán</h6>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <b><i>Lưu Ý: Vui lòng thanh toán đủ số tiền cần cọc để đặt sân thành công! Nếu số tiền dưới số tiền cần cọc thì sẽ bị mất cọc!</i></b>
                                    </div>
                                    <template v-if="ngan_hang">
                                        <div class="bank-info mb-3">
                                            <h6 class="text-primary">@{{ngan_hang.ngan_hang}}</h6>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span>Chủ TK:</span>
                                                <div>
                                                    <strong>@{{ngan_hang.ten_chu_tai_khoan}}</strong>
                                                    <button class="btn btn-sm btn-outline-primary ms-2" @click="copyToClipboard(ngan_hang.ten_chu_tai_khoan)">
                                                        <i class="fas fa-copy"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span>Số TK:</span>
                                                <div>
                                                    <strong>@{{ ngan_hang.so_tai_khoan }}</strong>
                                                    <button class="btn btn-sm btn-outline-primary ms-2" @click="copyToClipboard(ngan_hang.so_tai_khoan)">
                                                        <i class="fas fa-copy"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <p class="text-muted">Quét mã QR để thanh toán</p>
                                            <img v-bind:src="ngan_hang.link_qr" alt="QR Code" class="img-fluid" style="max-width: 400px;">
                                        </div>
                                        <div class="alert alert-warning mt-3">
                                            <i class="fas fa-info-circle me-2"></i>
                                            Nội dung chuyển khoản: <strong>@{{ ma_thanh_toan }}</strong>
                                        </div>
                                    </template>
                                    <template v-else>
                                        <div class="alert alert-danger">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            Chưa có thông tin ngân hàng. Vui lòng liên hệ quản lý để được hỗ trợ.
                                        </div>
                                    </template>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
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
        list                : [],
        selected            : {},
        ngan_hang           : {},
        thanh_toan_tat_ca   : false,
        ma_thanh_toan       : '',
    },
    created() {
        this.loadData();
    },
    methods: {
        copyToClipboard(text) {
            navigator.clipboard.writeText(text);
            toastr.success('Đã sao chép vào clipboard');
        },

        loadData() {
            axios.get('/khach-hang/lich-dat-san/data')
                .then((res) => {
                    this.list = res.data.data;
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
        getTrangThai(item) {
            let now = moment();
            let start = moment(item.thoi_gian_bat_dau);
            let end = moment(item.thoi_gian_ket_thuc);

            if(now < start) return 0; // Chưa bắt đầu
            if(now >= start && now <= end) return 1; // Đang diễn ra
            return 2; // Đã kết thúc
        },
        huyLich(item) {
            this.selected = item;
        },
        xacNhanHuy() {
            axios.post('/khach-hang/lich-dat-san/huy', this.selected)
                .then((res) => {
                    if(res.data.status) {
                        toastr.success(res.data.message);
                        this.loadData();
                        $('#deleteModal').modal('hide');
                    } else {
                        toastr.error(res.data.message);
                    }
                })
                .catch((err) => {
                    toastr.error('Có lỗi xảy ra!');
                });
        },
        getThongTinThanhToan(value) {
            axios.post('/khach-hang/lich-dat-san/thong-tin-chuyen-khoan', value)
                .then((res) => {
                    this.ngan_hang              = res.data.data;
                    // if (this.thanh_toan_tat_ca == true) {
                    //     this.ma_thanh_toan          = value.ma_thue_san;
                    //     this.ngan_hang.link_qr      = this.ngan_hang.anh_qr + "&amount=" + value.thanh_tien + "&addInfo=" + value.ma_thue_san;
                    // } else {
                    //     this.ma_thanh_toan          = value.ma_thue_san + '_COC30';
                    //     this.ngan_hang.link_qr      = this.ngan_hang.anh_qr + "&amount=" + value.thanh_tien * 0.3 + "&addInfo=" + value.ma_thue_san + '_COC30';
                    // }
                    this.updateLink();
                });
        },
        updateLink() {
            if (this.thanh_toan_tat_ca == true && this.selected.thanh_toan == 0) {
                this.ma_thanh_toan = this.selected.ma_thue_san;
                this.ngan_hang.link_qr      = this.ngan_hang.anh_qr + "&amount=" + this.selected.thanh_tien + "&addInfo=" + this.selected.ma_thue_san;
            } else if(this.thanh_toan_tat_ca == true && this.selected.thanh_toan == 1) {
                var tien_con_lai = this.selected.thanh_tien - this.selected.so_tien_coc;
                this.ma_thanh_toan = this.selected.ma_thue_san + '_CONLAI70';
                this.ngan_hang.link_qr      = this.ngan_hang.anh_qr + "&amount=" + tien_con_lai + "&addInfo=" + this.selected.ma_thue_san + '_CONLAI70';
            } else {
                if(this.selected.thanh_toan == 1) {
                    this.ma_thanh_toan          = this.selected.ma_thue_san + '_CONLAI70';
                    this.ngan_hang.link_qr      = this.ngan_hang.anh_qr + "&amount=" + this.selected.thanh_tien * 0.7 + "&addInfo=" + this.selected.ma_thue_san + '_CONLAI70';
                } else {
                    this.ma_thanh_toan          = this.selected.ma_thue_san + '_COC30';
                    this.ngan_hang.link_qr      = this.ngan_hang.anh_qr + "&amount=" + this.selected.thanh_tien * 0.3 + "&addInfo=" + this.selected.ma_thue_san + '_COC30';
                }
            }
        }
    }
});
</script>
@endsection
