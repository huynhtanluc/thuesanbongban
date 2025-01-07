@extends('KhachHang.Share.master')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="{{ Auth::guard('khach_hang')->user()->anh ?? 'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp' }}"
                         alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                    <h5 class="my-3">{{ Auth::guard('khach_hang')->user()->ho_va_ten }}</h5>
                    <p class="text-muted mb-1">Thành viên</p>
                    <div class="d-flex justify-content-center mb-2">
                        <button type="button" class="btn btn-primary" id="changeAvatarBtn" data-bs-toggle="modal" data-bs-target="#avatarModal">
                            Đổi ảnh đại diện
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <form id="updateProfileForm" action="/khach-hang/profile/update-profile" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label class="col-form-label">Họ và tên</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ho_va_ten" name="ho_va_ten"
                                       value="{{ Auth::guard('khach_hang')->user()->ho_va_ten }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label class="col-form-label">Email</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{ Auth::guard('khach_hang')->user()->email }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label class="col-form-label">Số điện thoại</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai"
                                       value="{{ Auth::guard('khach_hang')->user()->so_dien_thoai }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label class="col-form-label">Ngày sinh</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh"
                                       value="{{ Auth::guard('khach_hang')->user()->ngay_sinh }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label class="col-form-label">CMND/CCCD</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="chung_minh_thu" name="chung_minh_thu"
                                       value="{{ Auth::guard('khach_hang')->user()->chung_minh_thu }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label class="col-form-label">Giới tính</label>
                            </div>
                            <div class="col-sm-9">
                                <select class="form-select" id="gioi_tinh" name="gioi_tinh">
                                    <option value="1" {{ Auth::guard('khach_hang')->user()->gioi_tinh == 1 ? 'selected' : '' }}>Nam</option>
                                    <option value="0" {{ Auth::guard('khach_hang')->user()->gioi_tinh == 0 ? 'selected' : '' }}>Nữ</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label class="col-form-label">Mật khẩu mới</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label class="col-form-label">Xác nhận mật khẩu</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="re_password" name="re_password">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal đổi ảnh đại diện -->
<div class="modal fade" id="avatarModal" tabindex="-1" aria-labelledby="avatarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="avatarModalLabel">Đổi ảnh đại diện</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="avatarForm" action="/khach-hang/profile/update-avatar" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Chọn ảnh</label>
                        <input type="file" class="form-control" id="anh" name="anh" accept="image/*">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#changeAvatarBtn').click(function() {
            $('#avatarModal').modal('show');
        });

        $('#avatarForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: '/update-avatar',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if(response.status) {
                        toastr.success("Cập nhật ảnh đại diện thành công!");
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else {
                        toastr.error("Có lỗi xảy ra!");
                    }
                }
            });
        });

        $('#updateProfileForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: '/khach-hang/profile/update-profile',
                type: 'POST',
                data: formData,
                success: function(response) {
                    if(response.status) {
                        toastr.success("Cập nhật thông tin thành công!");
                        // setTimeout(function() {
                        //     window.location.reload();
                        // }, 1000);
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        });
    });
</script>
@endpush
@endsection
