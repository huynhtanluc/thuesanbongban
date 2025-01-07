<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png" />
    <link href="/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="/assets/css/app.css" rel="stylesheet">
    <link href="/assets/css/icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>Đăng Ký - Luc Ping Pong</title>
</head>

<body class="bg-login">
    <div class="wrapper">
        <div class="authentication-forgot d-flex align-items-center justify-content-center">
            <div class="card forgot-box">
                <div class="card-body">
                    <form action="/action-quen-mat-khau" method="POST">
                        @csrf
                        <div class="p-4 rounded  border">
                            <div class="text-center">
                                <img src="assets/images/icons/forgot-2.png" width="120" alt="" />
                            </div>
                            <h4 class="mt-5 font-weight-bold">Quên Mật Khẩu</h4>
                            <p class="text-muted">Nhập Email tài khoản của bạn để lấy lại mật khẩu</p>
                            <div class="my-4">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control form-control-lg" name="email"
                                    placeholder="example@gmail.com" />
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Xác Nhận</button> <a
                                    href="authentication-signin.html" class="btn btn-light btn-lg"><i
                                        class='bx bx-arrow-back me-1'></i>Đăng Nhập</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="/assets/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            // Xử lý ẩn hiện mật khẩu
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });

            $("#show_hide_repassword a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_repassword input').attr("type") == "text") {
                    $('#show_hide_repassword input').attr('type', 'password');
                    $('#show_hide_repassword i').addClass("bx-hide");
                    $('#show_hide_repassword i').removeClass("bx-show");
                } else if ($('#show_hide_repassword input').attr("type") == "password") {
                    $('#show_hide_repassword input').attr('type', 'text');
                    $('#show_hide_repassword i').removeClass("bx-hide");
                    $('#show_hide_repassword i').addClass("bx-show");
                }
            });

            // Validate form
            $("form").validate({
                rules: {
                    ho_va_ten: {
                        required: true,
                        minlength: 5
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    re_password: {
                        required: true,
                        equalTo: "[name='password']"
                    },
                    ngay_sinh: "required",
                    so_dien_thoai: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    chung_minh_thu: {
                        required: true,
                        digits: true,
                        minlength: 9,
                        maxlength: 12
                    },
                    gioi_tinh: "required"
                },
                messages: {
                    ho_va_ten: {
                        required: "Vui lòng nhập họ và tên",
                        minlength: "Họ tên phải có ít nhất 5 ký tự"
                    },
                    email: {
                        required: "Vui lòng nhập email",
                        email: "Email không đúng định dạng"
                    },
                    password: {
                        required: "Vui lòng nhập mật khẩu",
                        minlength: "Mật khẩu phải có ít nhất 6 ký tự"
                    },
                    re_password: {
                        required: "Vui lòng xác nhận mật khẩu",
                        equalTo: "Mật khẩu xác nhận không khớp"
                    },
                    ngay_sinh: "Vui lòng chọn ngày sinh",
                    so_dien_thoai: {
                        required: "Vui lòng nhập số điện thoại",
                        digits: "Số điện thoại chỉ được nhập số",
                        minlength: "Số điện thoại phải có 10 số",
                        maxlength: "Số điện thoại phải có 10 số"
                    },
                    chung_minh_thu: {
                        required: "Vui lòng nhập CMND/CCCD",
                        digits: "CMND/CCCD chỉ được nhập số",
                        minlength: "CMND/CCCD phải có từ 9 đến 12 số",
                        maxlength: "CMND/CCCD phải có từ 9 đến 12 số"
                    },
                    gioi_tinh: "Vui lòng chọn giới tính"
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.col-sm-6').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>

    @if (Session::has('error'))
        <script>
            toastr.error("{{ Session::get('error') }}");
        </script>
    @endif
    @if (Session::has('success'))
        <script>
            toastr.success("{{ Session::get('success') }}");
        </script>
    @endif
</body>

</html>
