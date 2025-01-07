@extends('KhachHang.Share.master')
@section('content')
<div class="row" id="app">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header mt-2">
                <h4>Cấu Hình Tài Khoản Ngân Hàng</h4>
            </div>
            <div class="card-body">
                <form id="formData" action="/khach-hang/ngan-hang" method="POST">
                    @csrf
                    <div class="form-group mt-2">
                        <label>Tên Chủ Tài Khoản</label>
                        <input type="text" class="form-control" name="ten_chu_tai_khoan" placeholder="Nhập vào tên chủ tài khoản">
                    </div>
                    <div class="form-group mt-2">
                        <label>Số Tài Khoản</label>
                        <input type="text" class="form-control" name="so_tai_khoan" placeholder="Nhập vào số tài khoản">
                    </div>
                    <div class="form-group mt-2">
                        <label>Tên Ngân Hàng</label>
                        <select class="form-control" name="ngan_hang" >
                            <template v-for="(value, index) in list_ngan_hang">
                                <option v-bind:value="value.bin + '|' + value.code + '|' + value.name">@{{ value.code }} - @{{ value.name }}</option>
                            </template>
                        </select>
                    </div>
                    <div class="form-group mt-2 text-end">
                        <button type="submit" class="btn btn-primary">Cấu Hình</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header mt-2">
                <h4>Thông Tin Thanh Toán</h4>
            </div>
            <div class="card-body">
                <div class="row" id="danhSachNganHang">
                    <!-- Template for each bank account -->
                    <div class="col-md-2 mb-4"></div>
                    @if ($data)
                        <div class="col-md-8 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="mb-3 text-center">
                                        <h5 class="mb-0 bank-name">{{$data->ngan_hang}}</h5>
                                    </div>
                                    <div class="info-group mb-2">
                                        <label class="text-muted">Chủ tài khoản:</label>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <strong class="account-name">{{$data->ten_chu_tai_khoan}}</strong>
                                            <button class="btn btn-sm btn-outline-primary copy-btn" data-copy="{{$data->ten_chu_tai_khoan}}">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="info-group mb-3">
                                        <label class="text-muted">Số tài khoản:</label>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <strong class="account-number">{{$data->so_tai_khoan}}</strong>
                                            <button class="btn btn-sm btn-outline-primary copy-btn" data-copy="{{$data->so_tai_khoan}}">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="text-center mt-3">
                                        <img src="{{$data->anh_qr}}" alt="QR Code" class="img-fluid" style="max-width: 500px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .info-group {
        background: #f8f9fa;
        padding: 10px;
        border-radius: 5px;
    }
    .copy-btn {
        padding: 2px 8px;
    }
    .card {
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
</style>
@endsection
@section('js')
<script>
    new Vue({
        el  :  '#app',
        data : {
            list_ngan_hang : [],
        },
        mounted(){
            this.getDanhSachNganHang();
        },
        methods: {
            getDanhSachNganHang() {
                axios
                    .get('https://api.vietqr.io/v2/banks')
                    .then((res) => {
                        this.list_ngan_hang = res.data.data;
                    })
            }
        }
    });
</script>
@endsection
