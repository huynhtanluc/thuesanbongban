@extends('KhachHang.Share.master')
@section('content')
    <div class="row"id="app">
        <div class="col-4">
            <div class="card border-primary border-top border-3 border-0">
                <div class="card-header">
                    <h5>Thêm Mới Khách Hàng</h5>
                </div>
                <div class="card-body">
                    <form id="formThemMoiKhachHang">
                        <div class="row">
                            <div class="col-md-12 mt-2 ">
                                <label><b>Họ và tên</b></label>
                                <input name="ho_va_ten" type="text" class="form-control mt-2">
                            </div>
                            <div class="col-md-12 mt-2 ">
                                <label><b>Email</b></label>
                                <input name="email" type="text" class="form-control mt-2">
                            </div>
                            <div class="col-md-12 mt-2 ">
                                <label><b>Số điện thoại</b></label>
                                <input name="so_dien_thoai" type="tel" class="form-control mt-2">
                            </div>
                            <div class="col-md-12 mt-2 ">
                                <label><b>Ngày sinh</b></label>
                                <input name="ngay_sinh" type="date" class="form-control mt-2">
                            </div>
                            <div class="col-md-12 mt-2 ">
                                <label><b>Giới tính</b></label>
                                <select name="gioi_tinh" class="form-control">
                                    <option value="1">Nam</option>
                                    <option value="0">Nữ</option>
                                    <option value="2">Khác</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-2 ">
                                <label><b>Chứng minh thư</b></label>
                                <input name="chung_minh_thu" type="number" class="form-control mt-2">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-end">
                    <button v-on:click="createKhachHang()" class="btn btn-primary">Thêm mới</button>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card border-primary border-top border-3 border-0">
                <div class="card-header">
                    <h5> Danh Sách Khách Hàng</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="text-center text-nowrap">#</th>
                                    <th class="text-center text-nowrap">Họ Và Tên</th>
                                    <th class="text-center text-nowrap">Email</th>
                                    <th class="text-center text-nowrap">Số Điện Thoại</th>
                                    <th class="text-center text-nowrap">Ngày Sinh</th>
                                    <th class="text-center text-nowrap">Giới Tính</th>
                                    <th class="text-center text-nowrap">Chứng Minh Thư</th>
                                    <th class="text-center text-nowrap">Tình Trạng</th>
                                    <th class="text-center text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(value, key) in list">
                                    <th class="text-nowrap text-center align-middle">@{{ key + 1 }}</th>
                                    <td class="text-nowrap align-middle">@{{ value.ho_va_ten }}</td>
                                    <td class="text-nowrap align-middle">@{{ value.email }}</td>
                                    <td class="text-nowrap text-center align-middle">@{{ value.so_dien_thoai }}</td>
                                    <td class="text-nowrap text-center align-middle">@{{ date_format(value.ngay_sinh) }}</td>
                                    <td class="text-nowrap text-center align-middle">@{{ value.gioi_tinh == 1 ? 'Nam' : 'Nữ' }}</td>
                                    <td class="text-nowrap text-center align-middle">@{{ value.chung_minh_thu }}</td>
                                    <td class="text-nowrap text-center align-middle">
                                        <template v-if="value.is_chu_san_tao == 1">
                                        <button v-on:click="changeStatus(value.id)" class="btn btn-success"
                                            v-if="value.tinh_trang == 1">Open</button>
                                        <button v-on:click="changeStatus(value.id)" class="btn btn-danger"
                                                v-else>Close</button>
                                        </template>
                                        <template v-else>
                                            <button class="btn btn-success" disabled>Open</button>
                                            <button class="btn btn-danger" disabled>Close</button>
                                        </template>
                                    </td>
                                    <td class="text-nowrap text-center align-middle">
                                        <template v-if="value.is_chu_san_tao == 1">
                                            <button v-on:click="password_new = value"
                                                class="btn btn-warning text-center text-white" data-bs-toggle="modal"
                                                data-bs-target="#doiMatKhau"><i class="fa-solid fa-key"
                                                    style="margin-left: 3px"></i></button>
                                            <button v-on:click="editKhachHang(value)" class="btn btn-primary"
                                                data-bs-toggle="modal" data-bs-target="#capNhatModal"><i
                                                    class="fa-solid fa-pen-to-square" style="margin-left: 3px"></i></button>
                                            <button v-on:click="xoa = value" class="btn btn-danger"
                                                data-bs-toggle="modal" data-bs-target="#xoaModal"><i class="fa-solid fa-trash"
                                                    style="margin-left: 3px"></i></button>
                                        </template>
                                        <template v-else>
                                            <button v-on:click="password_new = value"
                                                class="btn btn-warning text-center text-white" disabled data-bs-toggle="modal"
                                                data-bs-target="#doiMatKhau"><i class="fa-solid fa-key"
                                                    style="margin-left: 3px"></i></button>
                                            <button v-on:click="editKhachHang(value)" disabled class="btn btn-primary"
                                                data-bs-toggle="modal" data-bs-target="#capNhatModal"><i
                                                    class="fa-solid fa-pen-to-square" style="margin-left: 3px"></i></button>
                                            <button v-on:click="xoa = value" disabled class="btn btn-danger"
                                                data-bs-toggle="modal" data-bs-target="#xoaModal"><i class="fa-solid fa-trash"
                                                    style="margin-left: 3px"></i></button>
                                        </template>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="capNhatModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cập Nhật Khách Hàng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mt-2">
                            <label><b>Họ Và Tên</b></label>
                            <input v-model="edit.ho_va_ten" type="text" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label><b>Email</b></label>
                            <input v-model="edit.email" type="text" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label><b>Số Điện Thoại</b></label>
                            <input v-model="edit.so_dien_thoai" type="text" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label><b>Ngày Sinh</b></label>
                            <input v-model="edit.ngay_sinh" type="date" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label><b>Giới Tính</b></label>
                            <select v-model="edit.gioi_tinh" class="form-control">
                                <option value="1">Nam</option>
                                <option value="0">Nữ</option>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label><b>Chứng Minh Thư</b></label>
                            <input v-model="edit.chung_minh_thu" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button v-on:click="updateKhachHang()" type="button"
                            class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="xoaModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Xóa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Ban chắc chắn là sẽ xoá khách hàng <b class="text-danger">@{{ xoa.ho_va_ten }}</b>
                        này!<br>
                        <b>Lưu ý: Hành động này không thể khôi phục!</b>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button v-on:click="xoaKhachHang()" type="button"
                            class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="doiMatKhau" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Đổi Mật Khẩu Khách Hàng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mt-2">
                            <label><b>Mật Khẩu Mới</b></label>
                            <input type="password" v-model="password_new.password_new" name="password"
                                class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button v-on:click="changePassWord()" type="button"
                            class="btn btn-primary">Lưu</button>
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
                edit            : {},
                add             : {},
                xoa             : {},
                password_new    : {},
            },
            created() {
                this.loadData();

            },
            methods: {
                date_format(now) {
                    return moment(now).format('DD/MM/yyyy');
                },
                number_format(number, decimals = 2, dec_point = ",", thousands_sep = ".") {
                    var n = number,
                        c = isNaN((decimals = Math.abs(decimals))) ? 2 : decimals;
                    var d = dec_point == undefined ? "," : dec_point;
                    var t = thousands_sep == undefined ? "." : thousands_sep,
                        s = n < 0 ? "-" : "";
                    var i = parseInt((n = Math.abs(+n || 0).toFixed(c))) + "",
                        j = (j = i.length) > 3 ? j % 3 : 0;

                    return (s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (
                        c ? d +
                        Math.abs(n - i)
                        .toFixed(c)
                        .slice(2) :
                        ""));
                },
                loadData() {
                    axios
                        .get('/khach-hang/khach-hang/data')
                        .then((res) => {
                            this.list = res.data.data;
                            console.log(this.list);
                        });
                },
                createKhachHang() {
                    let formData = getFormData($('#formThemMoiKhachHang'));
                    console.log(formData);
                    axios
                        .post('/khach-hang/khach-hang/create', formData)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.messages);
                                this.loadData();
                                resetForm($('#formThemMoiKhachHang'));
                            } else {
                                toastr.error('Có lỗi không mong muốn! Vui lòng liên hệ quản trị viên');
                            }
                        })
                        .catch((res) => {
                            NotifiError(res);
                        });
                },

                editKhachHang(value) {
                    this.edit = JSON.parse(JSON.stringify(value));
                },

                updateKhachHang() {
                    axios
                        .post('/khach-hang/khach-hang/update', this.edit)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success('Đã cập nhật thành công!');
                                this.loadData();
                                $('#capNhatModal').modal('hide');
                            } else {
                                toastr.error('Có lỗi không mong muốn!');
                            }
                        })
                        .catch((res) => {
                            NotifiError(res);
                        });
                },
                xoaKhachHang() {
                    axios
                        .post('/khach-hang/khach-hang/delete', this.xoa)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success('Đã xóa khách hàng thành công!');
                                this.loadData();
                                $('#xoaModal').modal('hide');
                            } else {
                                toastr.error('Có lỗi không mong muốn!');
                            }
                        })
                        .catch((res) => {
                            NotifiError(res);
                        });
                },
                changeStatus(id) {
                    axios
                        .get('/khach-hang/khach-hang/change-status/' + id)
                        .then((res) => {
                            this.loadData();
                            toastr.success('Đã đổi trạng thái thành công!');
                        });
                },

                changePassWord() {
                    axios
                        .post('/khach-hang/khach-hang/change-password', this.password_new)
                        .then((res) => {
                            NotifiSuccess(res, () => {
                                this.loadData();
                                $('#doiMatKhau').modal('hide');
                            });
                        })
                        .catch((res) => {
                            NotifiError(res);
                        });
                },
                // changePassWord() {
                //     axios
                //         .post('/khach-hang/khach-hang/change-password', this.password_new)
                //         .then((res) => {
                //             if (res.data.status) {
                //                 toastr.success('Thay đổi mật khẩu thành công!');
                //                 this.loadData();
                //                 $('#doiMatKhau').modal('hide');
                //             } else {
                //                 toastr.error('Có lỗi không mong muốn!');
                //             }
                //         })
                //         .catch((res) => {
                //             $.each(res.response.data.errors, function(k, v) {
                //                 toastr.error(v[0]);
                //             });
                //         });
                // },


            }
        });
    </script>
@endsection
