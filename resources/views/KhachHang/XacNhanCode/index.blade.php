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
    <title>Xác Nhận Mã - Luc Ping Pong</title>
    <style>
        .code-inputs {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin: 20px 0;
        }
        .code-inputs input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 24px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 0 5px;
        }
        .code-inputs input:focus {
            border-color: #1e88e5;
            box-shadow: 0 0 0 0.2rem rgba(30,136,229,.25);
        }
    </style>
</head>

<body class="bg-login">
    <div class="wrapper">
        <div class="authentication-forgot d-flex align-items-center justify-content-center">
            <div class="card forgot-box">
                <div class="card-body">
                    <form action="/khach-hang/xac-nhan-code" method="POST">
                        @csrf
                        <div class="p-4 rounded border">
                            <div class="text-center">
                                <img src="/assets/images/icons/forgot-2.png" width="120" alt="" />
                            </div>
                            <div class="row text-center">
                                <h4 class="mt-5 font-weight-bold">Xác Nhận Mã</h4>
                                <p class="text-muted">Vui lòng nhập mã xác nhận đã được gửi đến email của bạn</p>
                            </div>

                            <div class="my-4">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" readonly>
                            </div>

                            <div class="my-4">
                                <label class="form-label">Mã Xác Nhận</label>
                                <div class="code-inputs">
                                    <input type="text" maxlength="1" class="code-input" data-index="1">
                                    <input type="text" maxlength="1" class="code-input" data-index="2">
                                    <input type="text" maxlength="1" class="code-input" data-index="3">
                                    <input type="text" maxlength="1" class="code-input" data-index="4">
                                    <input type="text" maxlength="1" class="code-input" data-index="5">
                                    <input type="text" maxlength="1" class="code-input" data-index="6">
                                </div>
                                <input type="hidden" name="code" id="complete_code">
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Xác Nhận</button>
                                <a href="/quen-mat-khau" class="btn btn-light btn-lg">
                                    <i class='bx bx-arrow-back me-1'></i>Quay Lại
                                </a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            // Xử lý lưu email vào localStorage
            @if(Session::has('store_email'))
                localStorage.setItem('reset_email', '{{ Session::get("store_email") }}');
            @endif

            // Lấy email từ localStorage nếu có
            let storedEmail = localStorage.getItem('reset_email');
            if (storedEmail) {
                $('#email').val(storedEmail);
            }

            // Xử lý input code
            $('.code-input').on('input', function() {
                let index = $(this).data('index');
                let value = $(this).val();

                // Chỉ cho phép nhập số
                if (!/^\d*$/.test(value)) {
                    $(this).val('');
                    return;
                }

                // Tự động focus vào ô tiếp theo
                if (value && index < 6) {
                    $(`.code-input[data-index="${index + 1}"]`).focus();
                }

                // Cập nhật giá trị complete code
                let code = '';
                $('.code-input').each(function() {
                    code += $(this).val();
                });
                $('#complete_code').val(code);
            });

            // Xử lý xóa và focus ô trước đó
            $('.code-input').on('keydown', function(e) {
                if (e.key === 'Backspace' && !$(this).val()) {
                    let index = $(this).data('index');
                    if (index > 1) {
                        e.preventDefault();
                        $(`.code-input[data-index="${index - 1}"]`).focus().val('');
                    }
                }
            });

            // Xử lý submit form
            $('form').on('submit', function() {
                // Kiểm tra mã đã nhập đủ chưa
                let code = $('#complete_code').val();
                if (code.length !== 6) {
                    toastr.error('Vui lòng nhập đủ 6 số!');
                    return false;
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
