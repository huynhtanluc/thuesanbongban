<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Nhận Đăng Ký Tài Khoản</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px; background-color: #f4f4f4;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <!-- Header -->
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="/assets/images/logo-img.png" alt="Logo" style="max-width: 150px;">
        </div>

        <!-- Content -->
        <div style="margin-bottom: 30px;">
            <h2 style="color: #333333; text-align: center; margin-bottom: 20px;">Xác Nhận Đăng Ký Tài Khoản</h2>

            <p style="color: #666666;">Xin chào {{ $data['ho_va_ten'] }},</p>

            <p style="color: #666666;">Cảm ơn bạn đã đăng ký tài khoản tại Luc Ping Pong. Để hoàn tất quá trình đăng ký, vui lòng nhấn vào nút bên dưới để kích hoạt tài khoản của bạn:</p>

            <!-- Button -->
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ $data['link'] }}"
                   style="display: inline-block; padding: 12px 30px; background-color: #007bff; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                    Kích Hoạt Tài Khoản
                </a>
            </div>

            <p style="color: #666666;">Hoặc bạn có thể copy và paste đường link sau vào trình duyệt:</p>
            <p style="background-color: #f8f9fa; padding: 10px; border-radius: 5px; word-break: break-all; color: #666666;">
                {{ $data['link'] }}
            </p>

            <p style="color: #666666;">Thông tin tài khoản của bạn:</p>
            <ul style="color: #666666;">
                <li>Email: {{ $data['email'] }}</li>
                <li>Họ và tên: {{ $data['ho_va_ten'] }}</li>
                <li>Số điện thoại: {{ $data['so_dien_thoai'] }}</li>
            </ul>

            <p style="color: #666666;">Link kích hoạt này sẽ hết hạn sau 24 giờ. Nếu bạn không thực hiện đăng ký tài khoản này, vui lòng bỏ qua email.</p>
        </div>

        <!-- Footer -->
        <div style="text-align: center; padding-top: 20px; border-top: 1px solid #eeeeee;">
            <p style="color: #999999; font-size: 12px; margin: 0;">
                © {{ date('Y') }} Luc Ping Pong. All rights reserved.
            </p>
            <p style="color: #999999; font-size: 12px; margin: 5px 0 0;">
                Địa chỉ: 123 ABC, Phường XYZ, Quận ABC, TP.HCM
            </p>
            <p style="color: #999999; font-size: 12px; margin: 5px 0 0;">
                Email này được gửi tự động, vui lòng không trả lời.
            </p>
        </div>
    </div>
</body>
</html>
