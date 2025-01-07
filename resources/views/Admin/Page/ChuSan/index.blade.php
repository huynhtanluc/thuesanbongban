@extends('Admin.Share.master')

@section('content')
    <div class="row" id="app">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5>Quản Lý Đơn Đăng Ký Chủ Sân</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-primary text-white ">
                                <tr>
                                    <th class="text-center text-nowrap">#</th>
                                    <th class="text-center text-nowrap">Tên Chủ Sân</th>
                                    <th class="text-center text-nowrap">Sân</th>
                                    <th class="text-center text-nowrap">Ngày Đăng Ký</th>
                                    <th class="text-center text-nowrap">Ngày Hết Hạn</th>
                                    <th class="text-center text-nowrap">Tiền Đấu Giá</th>
                                    <th class="text-center text-nowrap">Tiền Đặt Cọc</th>
                                    <th class="text-center text-nowrap">Trạng Thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(value, key) in list">
                                    <th class="text-center align-middle">@{{ key + 1 }}</th>
                                    <td class="align-middle">@{{ value.ten_khach_hang }}</td>
                                    <td class="align-middle">@{{ value.ten_san_bong }}</td>
                                    <td class="align-middle text-center">@{{ value.ngay_dang_ky }}</td>
                                    <td class="align-middle text-center">@{{ value.ngay_het_han }}</td>
                                    <td class="align-middle text-center">@{{ formatPrice(value.gia_thue_san) }}đ</td>
                                    <td class="align-middle text-center">@{{ formatPrice(value.tien_coc) }}đ</td>
                                    <td class="align-middle">
                                        <button v-if="value.trang_thai_duyet == 1" class="btn btn-success w-100" v-on:click="duyetDon(value)">Đã Duyệt</button>
                                        <button v-else class="btn btn-danger w-100" v-on:click="duyetDon(value)">Chưa Duyệt</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
                list: []
            },
            mounted() {
                this.getList();
            },
            methods: {
                getList() {
                    axios.get('/admin/chu-san/data').then((res) => {
                        this.list = res.data.data;
                    });
                },
                formatPrice(value) {
                    return new Intl.NumberFormat('vi-VN').format(value);
                },

                duyetDon(value) {
                    axios.post('/admin/chu-san/duyet', value)
                    .then((res) => {
                        NotifiSuccess(res, () => {
                            this.getList();
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
