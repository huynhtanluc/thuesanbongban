@extends('KhachHang.Share.master')
@section('content')
<div id="app">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <h4>Quản Lý Mặt Bằng</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#themMoiModal">
                                <i class="fa-solid fa-plus"></i> Thêm Mới
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table_mat_bang">
                            <thead class="text-center bg-primary text-white">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Mã Mặt Bằng</th>
                                    <th class="text-center">Địa Chỉ</th>
                                    <th class="text-center">Khu Vực</th>
                                    <th class="text-center">Trạng Thái</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(value, key) in list_mat_bang">
                                    <tr>
                                        <th class="text-center align-middle">@{{ key + 1 }}</th>
                                        <td class="align-middle">@{{ value.ma_mat_bang }}</td>
                                        <td class="align-middle">@{{ value.dia_chi }}</td>
                                        <td class="align-middle">
                                            @{{ value.ten_phuong_xa }}, @{{ value.ten_quan_huyen }}, @{{ value.ten_thanh_pho }}
                                        </td>
                                        <td class="text-center align-middle">
                                            <button v-if="value.trang_thai == 1"
                                                    v-on:click="doiTrangThai(value)"
                                                    class="btn btn-success">
                                                Hoạt Động
                                            </button>
                                            <button v-else
                                                    v-on:click="doiTrangThai(value)"
                                                    class="btn btn-danger">
                                                Tạm Dừng
                                            </button>
                                        </td>
                                        <td class="text-center align-middle">
                                            <button class="btn btn-info text-white" v-on:click="edit = value" data-bs-toggle="modal" data-bs-target="#editModal">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <button class="btn btn-danger" v-on:click="del = value" data-bs-toggle="modal" data-bs-target="#deleteModal">
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

    <!-- Modal thêm mới -->
    <div class="modal fade" id="themMoiModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm Mới Mặt Bằng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Trạng Thái</label>
                                <select class="form-select" v-model="add.trang_thai">
                                    <option value="1">Hoạt Động</option>
                                    <option value="0">Tạm Dừng</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Thành Phố</label>
                                <select class="form-select" v-model="add.id_thanh_pho" v-on:change="loadQuanHuyen()">
                                    <option value="">Chọn thành phố</option>
                                    <template v-for="(value, key) in list_thanh_pho">
                                        <option v-bind:value="value.id">@{{ value.ten_thanh_pho }}</option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Quận/Huyện</label>
                                <select class="form-select" v-model="add.id_quan_huyen" v-on:change="loadPhuongXa()">
                                    <option value="">Chọn quận/huyện</option>
                                    <template v-for="(value, key) in list_quan_huyen">
                                        <option v-bind:value="value.id">@{{ value.ten_quan_huyen }}</option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Phường/Xã</label>
                                <select class="form-select" v-model="add.id_phuong_xa">
                                    <option value="">Chọn phường/xã</option>
                                    <template v-for="(value, key) in list_phuong_xa">
                                        <option v-bind:value="value.id">@{{ value.ten_phuong_xa }}</option>
                                    </template>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Địa Chỉ Chi Tiết</label>
                        <input type="text" class="form-control" v-model="add.dia_chi">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" v-on:click="themMoi()">Thêm Mới</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cập Nhật Mặt Bằng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Mã Mặt Bằng</label>
                                <input type="text" disabled class="form-control" v-model="edit.ma_mat_bang">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Trạng Thái</label>
                                <select class="form-select" v-model="edit.trang_thai">
                                    <option value="1">Hoạt Động</option>
                                    <option value="0">Tạm Dừng</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Thành Phố</label>
                                <select class="form-select" v-model="edit.id_thanh_pho" v-on:change="loadQuanHuyenEdit()">
                                    <option value="">Chọn thành phố</option>
                                    <template v-for="(value, key) in list_thanh_pho">
                                        <option v-bind:value="value.id">@{{ value.ten_thanh_pho }}</option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Quận/Huyện</label>
                                <select class="form-select" v-model="edit.id_quan_huyen" v-on:change="loadPhuongXaEdit()">
                                    <option value="">Chọn quận/huyện</option>
                                    <template v-for="(value, key) in list_quan_huyen_edit">
                                        <option v-bind:value="value.id">@{{ value.ten_quan_huyen }}</option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Phường/Xã</label>
                                <select class="form-select" v-model="edit.id_phuong_xa">
                                    <option value="">Chọn phường/xã</option>
                                    <template v-for="(value, key) in list_phuong_xa_edit">
                                        <option v-bind:value="value.id">@{{ value.ten_phuong_xa }}</option>
                                    </template>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Địa Chỉ Chi Tiết</label>
                        <input type="text" class="form-control" v-model="edit.dia_chi">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" v-on:click="capNhat()">Cập Nhật</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xóa Mặt Bằng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert">
                        Bạn có chắc chắn muốn xóa mặt bằng này không?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" v-on:click="xoa()">Xóa</button>
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
            list_mat_bang       : [],
            list_thanh_pho     : [],
            list_quan_huyen    : [],
            list_phuong_xa     : [],
            list_quan_huyen_edit: [],
            list_phuong_xa_edit: [],
            add: {
                ma_mat_bang    : '',
                dia_chi        : '',
                trang_thai     : 1,
                id_thanh_pho   : '',
                id_quan_huyen  : '',
                id_phuong_xa   : '',
            },
            edit: {},
            del: {},
        },
        created() {
            this.loadData();
            this.loadThanhPho();
        },
        methods: {
            loadData() {
                axios
                    .get('/khach-hang/mat-bang/data')
                    .then((res) => {
                        this.list_mat_bang = res.data.data;
                    });
            },
            loadThanhPho() {
                axios
                    .get('/khach-hang/mat-bang/thanh-pho')
                    .then((res) => {
                        this.list_thanh_pho = res.data.data;
                    });
            },
            loadQuanHuyen() {
                axios
                    .get('/khach-hang/mat-bang/quan-huyen/' + this.add.id_thanh_pho)
                    .then((res) => {
                        this.list_quan_huyen = res.data.data;
                    });
            },
            loadPhuongXa() {
                axios
                    .get('/khach-hang/mat-bang/phuong-xa/' + this.add.id_quan_huyen)
                    .then((res) => {
                        this.list_phuong_xa = res.data.data;
                    });
            },
            loadQuanHuyenEdit() {
                axios
                    .get('/khach-hang/mat-bang/quan-huyen/' + this.edit.id_thanh_pho)
                    .then((res) => {
                        this.list_quan_huyen_edit = res.data.data;
                    });
            },
            loadPhuongXaEdit() {
                axios
                    .get('/khach-hang/mat-bang/phuong-xa/' + this.edit.id_quan_huyen)
                    .then((res) => {
                        this.list_phuong_xa_edit = res.data.data;
                    });
            },
            themMoi() {
                axios
                    .post('/khach-hang/mat-bang/create', this.add)
                    .then((res) => {
                        NotifiSuccess(res, ()=>{
                            this.loadData();
                            $('#themMoiModal').modal('hide');
                            this.add = {
                                ma_mat_bang    : '',
                                dia_chi        : '',
                                trang_thai     : 1,
                                id_thanh_pho   : '',
                                id_quan_huyen  : '',
                                id_phuong_xa   : '',
                            };
                        });
                    })
                    .catch((error) => {
                        toastr.error('Có lỗi không mong muốn!');
                    });
            },
            capNhat() {
                axios
                    .post('/khach-hang/mat-bang/update', this.edit)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success(res.data.message);
                            this.loadData();
                            $('#editModal').modal('hide');
                        } else {
                            toastr.error(res.data.message);
                        }
                    })
                    .catch((error) => {
                        toastr.error('Có lỗi không mong muốn!');
                    });
            },
            xoa() {
                axios
                    .post('/khach-hang/mat-bang/delete', this.del)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success(res.data.message);
                            this.loadData();
                            $('#deleteModal').modal('hide');
                        } else {
                            toastr.error(res.data.message);
                        }
                    })
                    .catch((error) => {
                        toastr.error('Có lỗi không mong muốn!');
                    });
            },
            doiTrangThai(value) {
                axios
                    .get('/khach-hang/mat-bang/change-status/' + value.id)
                    .then((res) => {
                        NotifiSuccess(res, () => {
                            this.loadData();
                        });
                    })
                    .catch((error) => {
                        NotifiError("Có lỗi xảy ra!");
                    });
            }
        }
    });
</script>
@endsection
