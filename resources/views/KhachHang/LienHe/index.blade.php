@extends('KhachHang.Share.master')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 text-white">Liên Hệ</h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Họ và Tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="ho_va_ten" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" name="so_dien_thoai" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Chủ sân</label>
                            <select class="form-select" name="chu_san_id">
                                <option value="">-- Chọn chủ sân --</option>
                                @foreach($dsChuSan ?? [] as $chuSan)
                                    <option value="{{ $chuSan->id }}">{{ $chuSan->ho_va_ten }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nội dung <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="noi_dung" rows="5" required></textarea>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Gửi liên hệ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
