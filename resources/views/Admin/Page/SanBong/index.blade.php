@extends('Admin.Share.master')
@section('content')
    <div class="row"id="app">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h5>Thêm Mới Sân Bóng</h5>
                </div>
                <div class="card-body">
                    <form id="formThemMoiSanBong">
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <label>Tên Sân</label>
                                <input type="text" class="form-control mt-2" name="ten_san">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label>Diện Tích</label>
                                <input type="text" class="form-control mt-2" name="dien_tich">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label>Giá Đấu Thầu</label>
                                <input type="number" class="form-control mt-2" name="gia_dau_thau">
                            </div>

                            <div class="col-md-12 mt-2">
                                <label>Phần Trăm Cọc</label>
                                <input type="number" class="form-control mt-2" name="phan_tram_coc">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label>Loại Sân</label>
                                <select name="id_khu_vuc" class="form-control">
                                    <template v-for="(value, key) in list_kv">
                                        <option v-bind:value="value.id">@{{ value.ten_khu_vuc }}</option>
                                    </template>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-end">
                    <button v-on:click="createSanBong()" class="btn btn-outline-primary">Thêm mới</button>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h5> Danh Sách Sân Bóng</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center text-nowrap">#</th>
                                    <th class="text-center text-nowrap">Tên Sân</th>
                                    <th class="text-center text-nowrap">Diện Tích</th>
                                    <th class="text-center text-nowrap">Giá Thầu</th>
                                    <th class="text-center text-nowrap">Phần Trăm Cọc</th>
                                    <th class="text-center text-nowrap">Tên Chủ Sân</th>
                                    <th class="text-center text-nowrap">Loại Sân</th>
                                    <th class="text-center text-nowrap">Tình Trạng</th>
                                    <th class="text-center text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(value, key) in list">
                                    <th class="text-nowrap text-center align-middle">@{{ key + 1 }}</th>
                                    <td class="text-nowrap align-middle">@{{ value.ten_san }}</td>
                                    <td class="text-nowrap align-middle">@{{ value.dien_tich }}</td>
                                    <td class="text-nowrap align-middle">@{{ value.gia_dau_thau }}</td>
                                    <td class="text-nowrap text-center align-middle">@{{ value.phan_tram_coc }}</td>
                                    <td class="text-nowrap text-center align-middle">@{{ value.ten_chu_san }}</td>
                                    <td class="text-nowrap align-middle">@{{ value.ten_khu_vuc }}</td>
                                    <td class="text-nowrap text-center align-middle">
                                        <button v-on:click="changeStatus(value.id)" class="btn btn-outline-success"
                                            v-if="value.trang_thai == 1">Open</button>
                                        <button v-on:click="changeStatus(value.id)" class="btn btn-outline-danger"
                                            v-else>Close</button>
                                    </td>
                                    <td class="text-nowrap text-center align-middle">
                                        <button v-on:click="editSanBong(value)" class="btn btn-outline-primary"
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
                        <h5 class="modal-title">Cập Nhật Sân Bóng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <label>Tên Sân</label>
                            <input type="text" class="form-control mt-2" v-model="edit.ten_san">
                        </div>
                        <div class="col-md-12">
                            <label>Diện Tích</label>
                            <input type="text" class="form-control mt-2" v-model="edit.dien_tich">
                        </div>
                        <div class="col-md-12">
                            <label>Giá Đấu Thầu</label>
                            <input type="number" class="form-control mt-2" v-model="edit.gia_dau_thau">
                        </div>

                        <div class="col-md-12">
                            <label>Phần Trăm Cọc</label>
                            <input type="number" class="form-control mt-2" v-model="edit.phan_tram_coc">
                        </div>
                        <div class="col-md-12">
                            <label>Loại Sân</label>
                            <select v-model="edit.id_khu_vuc" class="form-control">
                                <template v-for="(value, key) in list_kv">
                                    <option v-bind:value="value.id">@{{ value.ten_khu_vuc }}</option>
                                </template>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button v-on:click="updateSanBong()" type="button" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="xoaModal" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Xóa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Ban chắc chắn là sẽ xoá sân bóng <b class="text-danger">@{{ xoa.ho_va_ten }}</b>
                        này!<br>
                        <b>Lưu ý: Hành động này không thể khôi phục!</b>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button v-on:click="xoaSanBong()" type="button" class="btn btn-primary">Lưu</button>
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
                list_kv: [],
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
                    //sân bóng
                    axios
                        .get('/admin/san-bong/data')
                        .then((res) => {
                            this.list = res.data.data;
                            console.log(this.list);
                        });

                    //Loại Sân
                    axios
                        .get('/admin/khu-vuc/data')
                        .then((res) => {
                            this.list_kv = res.data.data;
                        });
                },
                createSanBong() {
                    let formData = getFormData($('#formThemMoiSanBong'));
                    axios
                        .post('/admin/san-bong/create', formData)
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
                            NotifiError(res);
                        });
                },
                editSanBong(value) {
                    this.edit = JSON.parse(JSON.stringify(value));
                },
                updateSanBong() {
                    axios
                        .post('/admin/san-bong/update', this.edit)
                        .then((res) => {
                            NotifiSuccess(res, () => {
                                this.loadData();
                                $('#capNhatModal').modal('hide');
                            });
                        })
                        .catch((res) => {
                            NotifiError(res);
                        });
                },
                xoaSanBong() {
                    axios
                        .post('/admin/san-bong/delete', this.xoa)
                        .then((res) => {
                            NotifiSuccess(res, () => {
                                this.loadData();
                                $('#xoaModal').modal('hide');
                            });
                        })
                        .catch((res) => {
                            NotifiError(res);
                        });
                },
                changeStatus(id) {
                    axios
                        .get('/admin/san-bong/change-status/' + id)
                        .then((res) => {
                            this.loadData();
                            toastr.success('Đã đổi trạng thái thành công!');
                        });
                },

            }
        });
    </script>
@endsection
