@extends('KhachHang.Share.master')
@section('content')
<div id="app">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Cấu Hình Địa Chỉ Sân Bóng</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Chọn Mặt Bằng</label>
                            <select class="form-select" v-model="add.id_mat_bang" v-on:change="loadDiaChi()">
                                <option value="">Chọn mặt bằng</option>
                                <template v-for="(value, key) in list_mat_bang">
                                    <option v-bind:value="value.id">@{{ value.ma_mat_bang }} - @{{ value.dia_chi }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Chọn Sân Bóng</label>
                            <select class="form-select" v-model="add.id_san">
                                <option value="">Chọn sân bóng</option>
                                <template v-for="(value, key) in list_san_bong">
                                    <option v-bind:value="value.id">@{{ value.ten_san }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button class="btn btn-primary" v-on:click="cauHinhDiaChi()">Cập Nhật</button>
                        </div>
                    </div>
                    <div class="row" v-if="add.id_mat_bang">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <strong>Địa chỉ hiện tại:</strong> @{{ dia_chi_hien_tai }}
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="text-center bg-primary text-white">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Mã Sân</th>
                                    <th class="text-center">Tên Sân</th>
                                    <th class="text-center">Địa Chỉ</th>
                                    <th class="text-center">Trạng Thái</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(value, key) in list_san_da_cau_hinh">
                                    <tr>
                                        <th class="text-center align-middle">@{{ key + 1 }}</th>
                                        <td class="align-middle">@{{ value.ma_san }}</td>
                                        <td class="align-middle">@{{ value.ten_san }}</td>
                                        <td class="align-middle">@{{ value.dia_chi }}</td>
                                        <td class="text-center align-middle">
                                            <button v-if="value.trang_thai == 1" class="btn btn-success">Hoạt Động</button>
                                            <button v-else class="btn btn-danger">Tạm Dừng</button>
                                        </td>
                                        <td class="text-center align-middle">
                                            <button class="btn btn-danger" v-on:click="huyCauHinh(value)">
                                                <i class="fa-solid fa-trash"></i>
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
    </div>
</div>
@endsection

@section('js')
<script>
    new Vue({
        el: '#app',
        data: {
            list_mat_bang: [],
            list_san_bong: [],
            list_san_da_cau_hinh: [],
            dia_chi_hien_tai: '',
            add: {
                id_mat_bang: '',
                id_san: '',
            },
        },
        created() {
            this.loadSanBong();
            this.loadSanDaCauHinh();
        },
        methods: {
            loadSanBong() {
                axios
                    .get('/khach-hang/san-bong/data-san-bong-mat-bang-cau-hinh')
                    .then((res) => {
                        this.list_san_bong = res.data.data_san_bong;
                        this.list_mat_bang = res.data.data_mat_bang;
                    })
                    .catch((error) => {
                        NotifiError("Có lỗi xảy ra!");
                    });
            },

            loadDiaChi() {
                if(this.add.id_mat_bang) {
                    let matBang = this.list_mat_bang.find(x => x.id == this.add.id_mat_bang);
                    if(matBang) {
                        this.dia_chi_hien_tai = matBang.dia_chi;
                        this.loadSanDaCauHinh();
                    }
                }
            },

            loadSanDaCauHinh() {
                axios
                    .get('/khach-hang/san-bong/data-san-bong-cau-hinh')
                    .then((res) => {
                        this.list_san_da_cau_hinh = res.data.data;
                    })
                    .catch((error) => {
                        NotifiError("Có lỗi xảy ra!");
                    });
            },

            cauHinhDiaChi() {
                if(!this.add.id_mat_bang || !this.add.id_san) {
                    toastr.error("Vui lòng chọn đầy đủ thông tin!");
                    return;
                }
                axios
                    .post('/khach-hang/san-bong/cau-hinh-dia-chi', this.add)
                    .then((res) => {
                        if(res.data.status) {
                            NotifiSuccess(res, () => {
                                this.loadSanDaCauHinh();
                                this.add.id_san = '';
                            });
                        } else {
                            NotifiError(res);
                        }
                    })
                    .catch((error) => {
                        NotifiError("Có lỗi xảy ra!");
                    });
            },

            huyCauHinh(value) {
                axios
                    .post('/khach-hang/san-bong/huy-cau-hinh', {
                        id: value.id
                    })
                    .then((res) => {
                        if(res.data.status) {
                            NotifiSuccess(res, () => {
                                this.loadSanDaCauHinh();
                            });
                        }
                    })
                    .catch((error) => {
                        NotifiError("Có lỗi xảy ra!");
                    });
            }
        }
    });
</script>
@endsection
