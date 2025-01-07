@extends('Admin.Share.master')
@section('content')
    <div class="row"id="app">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h5>Thêm Mới </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Tên Loại Sân</label>
                            <input type="text" class="form-control mt-2" v-model="add.ten_khu_vuc">
                        </div>
                        <div class="col-md-12">
                            <label>Trạng Thái</label>
                            <select v-model="add.trang_thai" class="form-control">
                                <option value="1">Open</option>
                                <option value="2">Close</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button v-on:click="createKhuVuc()" class="btn btn-outline-primary">Thêm mới</button>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h5> Danh Sách Loại Sân</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center text-nowrap">#</th>
                                    <th class="text-center text-nowrap">Tên Loại Sân</th>
                                    <th class="text-center text-nowrap">Tình Trạng</th>
                                    <th class="text-center text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(value, key) in list">
                                    <th class="text-nowrap text-center align-middle">@{{ key + 1 }}</th>
                                    <td class="text-nowrap align-middle">@{{ value.ma_khu_vuc }}</td>
                                    <td class="text-nowrap text-center align-middle">
                                        <button v-on:click="changeStatus(value.id)" class="btn btn-outline-success"
                                            v-if="value.trang_thai == 1">Open</button>
                                        <button v-on:click="changeStatus(value.id)" class="btn btn-outline-danger"
                                            v-else>Close</button>
                                    </td>
                                    <td class="text-nowrap text-center align-middle">
                                        <button v-on:click="editKhuVuc(value)" class="btn btn-outline-primary"
                                            data-bs-toggle="modal" data-bs-target="#capNhatModal"><i
                                                class="fa-solid fa-pen-to-square" style="margin-left: 3px"></i></button>
                                        <button v-on:click="xoa = value" class="btn btn-outline-danger"
                                            data-bs-toggle="modal" data-bs-target="#xoaModal"><i class="fa-solid fa-trash"
                                                style="margin-left: 3px"></i></button>
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
                        <h5 class="modal-title">Cập Nhật Loại Sân</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mt-2">
                            <label>Tên Loại Sân</label>
                            <input v-model="edit.ten_khu_vuc" type="text" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label>Trạng Thái</label>
                            <select v-model="edit.trang_thai" class="form-control">
                                <option value="1">Open</option>
                                <option value="0">Close</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button v-on:click="updateKhuVuc()" type="button"
                            class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="xoaModal" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Xóa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Ban chắc chắn là sẽ xoá Loại Sân <b class="text-danger">@{{ xoa.ten_khu_vuc }}</b>
                        này!<br>
                        <b>Lưu ý: Hành động này không thể khôi phục!</b>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button v-on:click="xoaKhuVuc()" type="button"
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
                list: [],
                edit: {},
                add: {},
                xoa: {},
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
                        .get('/admin/khu-vuc/data')
                        .then((res) => {
                            this.list = res.data.data;
                            console.log(this.list);
                        });
                },
                createKhuVuc() {
                    console.log(this.add);

                    axios
                        .post('/admin/khu-vuc/create', this.add)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.messages);
                                this.loadData();
                                this.add = {};
                            } else {
                                toastr.error('Có lỗi không mong muốn! Vui lòng liên hệ quản trị viên');
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                editKhuVuc(value) {
                console.log(value);

                    this.edit = JSON.parse(JSON.stringify(value));
                },
                updateKhuVuc() {
                    axios
                        .post('/admin/khu-vuc/update', this.edit)
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
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                xoaKhuVuc() {
                    axios
                        .post('/admin/khu-vuc/delete', this.xoa)
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
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                changeStatus(id) {
                    axios
                        .get('/admin/khu-vuc/change-status/' + id)
                        .then((res) => {
                            this.loadData();
                            toastr.success('Đã đổi trạng thái thành công!');
                        });
                },

            }
        });
    </script>
@endsection
