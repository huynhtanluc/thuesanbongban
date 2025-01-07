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
    <title>Đặt Lại Mật Khẩu - Luc Ping Pong</title>
</head>

<body class="bg-login">
    <div class="wrapper">
        <div class="authentication-reset-password d-flex align-items-center justify-content-center">
            <div class="card">
                <div class="card-body">
                    <div class="p-4">
                        <div class="text-center">
                            <img src="/assets/images/icons/forgot-2.png" width="120" alt="" />
                        </div>
                        <div class="text-center my-4">
                            <h4>Đặt Lại Mật Khẩu</h4>
                            <p class="text-muted">Vui lòng nhập mật khẩu mới của bạn</p>
                        </div>
                        <form class="form-body" action="/reset-mat-khau" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <input type="email" id="email" name="email" class="form-control" hidden readonly>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Mật Khẩu Mới</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input type="password" class="form-control border-end-0"
                                               name="password" placeholder="Nhập mật khẩu mới">
                                        <a href="javascript:;" class="input-group-text bg-transparent">
                                            <i class="bx bx-hide"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Xác Nhận Mật Khẩu</label>
                                    <div class="input-group" id="show_hide_repassword">
                                        <input type="password" class="form-control border-end-0"
                                               name="re_password" placeholder="Xác nhận mật khẩu">
                                        <a href="javascript:;" class="input-group-text bg-transparent">
                                            <i class="bx bx-hide"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid gap-3">
                                        <button type="submit" class="btn btn-primary">Đặt Lại Mật Khẩu</button>
                                        <a href="/login" class="btn btn-light">
                                            <i class='bx bx-arrow-back mr-1'></i>Quay Lại Đăng Nhập
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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
            // Lấy email từ localStorage
            let storedEmail = localStorage.getItem('reset_email');
            if (storedEmail) {
                $('#email').val(storedEmail);
            }

            // Xử lý ẩn hiện mật khẩu
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password input').attr("type") == "text"){
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass( "bx-hide" );
                    $('#show_hide_password i').removeClass( "bx-show" );
                }else if($('#show_hide_password input').attr("type") == "password"){
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass( "bx-hide" );
                    $('#show_hide_password i').addClass( "bx-show" );
                }
            });

            $("#show_hide_repassword a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_repassword input').attr("type") == "text"){
                    $('#show_hide_repassword input').attr('type', 'password');
                    $('#show_hide_repassword i').addClass( "bx-hide" );
                    $('#show_hide_repassword i').removeClass( "bx-show" );
                }else if($('#show_hide_repassword input').attr("type") == "password"){
                    $('#show_hide_repassword input').attr('type', 'text');
                    $('#show_hide_repassword i').removeClass( "bx-hide" );
                    $('#show_hide_repassword i').addClass( "bx-show" );
                }
            });

            // Validate form
            $("form").validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 6
                    },
                    re_password: {
                        required: true,
                        equalTo: "[name='password']"
                    }
                },
                messages: {
                    password: {
                        required: "Vui lòng nhập mật khẩu mới",
                        minlength: "Mật khẩu phải có ít nhất 6 ký tự"
                    },
                    re_password: {
                        required: "Vui lòng xác nhận mật khẩu",
                        equalTo: "Mật khẩu xác nhận không khớp"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);
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
