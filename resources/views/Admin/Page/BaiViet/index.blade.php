@extends('Admin.Share.master')
@section('title')
    <h1 class="text-center mb-4">Quản Lý Bài Viết</h1>
@endsection
@section('content')
<div class="row" id="app">
    <div class="col-5">
        <div class="card border-primary border-bottom border-3 border-0">
            <div class="card-header">
                <h5 class="text-primary">Thêm Mới Bài Viết</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Tiêu Đề Bài Viết</label>
                    <input type="text" class="form-control" v-model="add.ten_bai_viet">
                </div>
                <div class="mb-3">
                    <label class="form-label">Hình Ảnh</label>
                    <div class="input-group">
                        <input type="file" class="form-control" id="chon_anh" accept="image/*" v-on:change="uploadAnh($event)">
                    </div>
                </div>
                <div class="mb-3" v-if="preview">
                    <label class="form-label">Ảnh Preview</label>
                    <div>
                        <img :src="preview" class="img-fluid rounded" style="max-height: 200px">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nội Dung</label>
                    <textarea class="form-control" rows="10" v-model="add.noi_dung"></textarea>
                </div>
                <div class="text-end">
                    <button class="btn btn-primary" v-on:click="themMoi()">
                        <i class="fas fa-save me-2"></i>
                        Thêm Mới
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-7">
        <div class="card border-primary border-bottom border-3 border-0">
            <div class="card-header">
                <h5 class="text-primary">Danh Sách Bài Viết</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center align-middle" style="width: 50px">#</th>
                                <th class="text-center align-middle">Tiêu Đề</th>
                                <th class="text-center align-middle">Hình Ảnh</th>
                                <th class="text-center align-middle">Nội Dung</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(value, key) in list_bai_viet">
                                <tr>
                                    <th class="text-center align-middle">@{{ key + 1 }}</th>
                                    <td class="align-middle">@{{ value.ten_bai_viet }}</td>
                                    <td class="text-center align-middle">
                                        <img :src="value.hinh_anh" class="img-fluid" style="max-height: 100px">
                                    </td>
                                    <td class="align-middle">
                                        <span v-html="value.noi_dung.substring(0, 50) + '...'"></span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <button class="btn btn-info me-2" v-on:click="edit = value">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger" v-on:click="xoa(value)">
                                            <i class="fas fa-trash"></i>
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
@endsection
@section('js')
<script>
    new Vue({
        el      :   '#app',
        data    :   {
            add             :   {},
            list_bai_viet  :   [],
            edit           :   {},
            preview        :   '',
        },
        created()   {
            this.loadData();
        },
        methods :   {
            uploadAnh(e) {
                var file = e.target.files[0];
                if(file) {
                    var reader = new FileReader();
                    reader.onload = (e) => {
                        this.preview = e.target.result;
                        this.add.hinh_anh = e.target.result;
                        toastr.success("Đã tải ảnh lên thành công!");
                    };
                    reader.readAsDataURL(file);
                }
            },

            loadData() {
                axios
                    .get('/admin/bai-viet/data')
                    .then((res) => {
                        this.list_bai_viet = res.data.data;
                    });
            },

            themMoi() {
                axios
                    .post('/admin/bai-viet/create', this.add)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success("Đã thêm mới bài viết thành công!");
                            this.loadData();
                            this.add = {};
                            this.preview = '';
                            $("#chon_anh").val("");
                        }
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0]);
                        });
                    });
            },

            xoa(value) {
                if(confirm('Bạn có chắc chắn muốn xóa bài viết này không?')) {
                    axios
                        .delete('/admin/bai-viet/delete/' + value.id)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success("Đã xóa bài viết thành công!");
                                this.loadData();
                            }
                        });
                }
            }
        }
    });
</script>
@endsection
