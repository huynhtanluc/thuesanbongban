@extends('KhachHang.Share.master')
@section('title')
    <h1 class="text-center mb-4">Quản Lý Bài Viết</h1>
@endsection
@section('content')
<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<div class="row" id="app">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#themMoiModal">
                    <i class="fa-solid fa-plus"></i> Thêm mới
                </button>
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
                                        <span v-html="value.noi_dung_ngan.substring(0, 50) + '...'"></span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <button class="btn btn-info me-2" v-on:click="editBaiViet(value)" data-bs-toggle="modal" data-bs-target="#capNhatModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger" v-on:click="del = Object.assign({}, value)" data-bs-toggle="modal" data-bs-target="#deleteModal">
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

    <div class="modal fade" id="themMoiModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm Mới Bài Viết</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                        <label class="form-label">Nội Dung Ngắn</label>
                        <textarea class="form-control" rows="3" v-model="add.noi_dung_ngan"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nội Dung Chi Tiết</label>
                        <textarea id="noi_dung" name="noi_dung" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" v-on:click="themMoi()">Thêm mới</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="capNhatModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cập Nhật Bài Viết</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Tiêu Đề Bài Viết</label>
                        <input type="text" class="form-control" v-model="edit.ten_bai_viet">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hình Ảnh</label>
                        <div class="input-group">
                            <input type="file" class="form-control" accept="image/*" v-on:change="uploadAnhEdit($event)">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ảnh Hiện Tại</label>
                        <div>
                            <img :src="edit.hinh_anh" class="img-fluid rounded" style="max-height: 200px">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nội Dung Ngắn</label>
                        <textarea class="form-control" rows="3" v-model="edit.noi_dung_ngan"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nội Dung Chi Tiết</label>
                        <textarea id="noi_dung_edit" name="noi_dung_edit" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" v-on:click="capNhat()">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xóa Bài Viết</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        Bạn có chắc chắn muốn xóa bài viết có tiêu đề: <strong>@{{ del.ten_bai_viet }}</strong>?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" v-on:click="xoaBaiViet()">Xác Nhận</button>
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
            add: {
                ten_bai_viet: '',
                noi_dung: '',
                noi_dung_ngan: '',
                hinh_anh: '',
            },
            edit: {},
            list_bai_viet: [],
            preview: '',
            del: {},
            editor: undefined,
            editorEdit: undefined,
        },
        created() {
            this.loadData();
        },
        mounted() {
            this.initEditor('noi_dung', (editor) => {
                this.editor = editor;
            });

            $('#capNhatModal').on('show.bs.modal', () => {
                this.$nextTick(() => {
                    if (this.editorEdit) {
                        CKEDITOR.instances.noi_dung_edit.destroy();
                    }
                    this.initEditor('noi_dung_edit', (editor) => {
                        this.editorEdit = editor;
                        editor.on('instanceReady', () => {
                            if (this.edit.noi_dung) {
                                editor.setData(this.edit.noi_dung);
                            }
                        });
                    });
                });
            });

            $('#capNhatModal').on('hidden.bs.modal', () => {
                if (this.editorEdit) {
                    CKEDITOR.instances.noi_dung_edit.destroy();
                    this.editorEdit = null;
                }
            });

            $('#themMoiModal').on('hidden.bs.modal', () => {
                this.resetForm();
            });
        },
        methods: {
            uploadAnh(e) {
                var formData = new FormData();
                formData.append('file', e.target.files[0]);
                axios
                    .post('/khach-hang/bai-viet/upload', formData)
                    .then((res) => {
                        NotifiSuccess(res, () => {
                            this.preview = res.data.file;
                            this.add.hinh_anh = res.data.file;
                        });
                    })
                    .catch((res) => {
                        NotifiError(res);
                    });
            },
            loadData() {
                axios
                    .get('/khach-hang/bai-viet/data')
                    .then((res) => {
                        this.list_bai_viet = res.data.data;
                        console.log(this.list_bai_viet);

                    });
            },
            themMoi() {
                this.add.noi_dung = this.editor.getData();
                axios
                    .post('/khach-hang/bai-viet/create', this.add)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success(res.data.messages);
                            this.loadData();
                            $('#themMoiModal').modal('hide');
                            this.add = {};
                            this.preview = '';
                            this.editor.setData('');
                        }
                    })
                    .catch((err) => {
                        $.each(err.response.data.errors, function(key, value) {
                            toastr.error(value[0]);
                        });
                    });
            },
            uploadAnhEdit(e) {
                var formData = new FormData();
                formData.append('file', e.target.files[0]);
                axios
                    .post('/khach-hang/bai-viet/upload', formData)
                    .then((res) => {
                        NotifiSuccess(res, () => {
                            this.edit.hinh_anh = res.data.file;
                        });
                    })
                    .catch((res) => {
                        NotifiError(res);
                    });
            },
            editBaiViet(value) {
                this.edit = Object.assign({}, value);
            },
            capNhat() {
                this.edit.noi_dung = this.editorEdit.getData();
                axios
                    .post('/khach-hang/bai-viet/update', this.edit)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success(res.data.messages);
                            this.loadData();
                            $('#capNhatModal').modal('hide');
                        }
                    })
                    .catch((err) => {
                        $.each(err.response.data.errors, function(key, value) {
                            toastr.error(value[0]);
                        });
                    });
            },
            xoaBaiViet() {
                axios
                    .post('/khach-hang/bai-viet/delete', this.del)
                    .then((res) => {
                        NotifiSuccess(res, () => {
                            $('#deleteModal').modal('hide');
                            this.loadData();
                            this.del = {};
                        });
                    })
                    .catch((res) => {
                        NotifiError(res);
                    });
            },
            resetForm() {
                if (this.editor) {
                    this.editor.setData('');
                }
                this.add = {
                    ten_bai_viet: '',
                    noi_dung: '',
                    noi_dung_ngan: '',
                    hinh_anh: '',
                };
                this.preview = '';
            },
            initEditor(selector, callback) {
                const editor = CKEDITOR.replace(selector, {
                    height: 400,
                    filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token()])}}",
                    filebrowserUploadMethod: 'form'
                });

                if (callback) callback(editor);
                return editor;
            }
        }
    });
</script>
@endsection
