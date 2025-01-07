<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mã Xác Nhận</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px; background-color: #f4f4f4;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 5px;">
        <h2 style="color: #333; text-align: center; margin-bottom: 20px;">Mã Xác Nhận</h2>

        <p style="color: #666;">Xin chào {{ $data['ho_va_ten'] }},</p>

        <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; text-align: center; margin: 20px 0;">
            <h3 style="color: #333; margin: 0;">Mã xác nhận của bạn là:</h3>
            <div style="font-size: 24px; font-weight: bold; color: #007bff; margin: 10px 0;">
                {{ $data['hash_reset'] }}
            </div>
        </div>

        <p style="color: #666;">Mã này sẽ hết hạn sau 30 phút.</p>

        <p style="color: #666;">Nếu bạn không yêu cầu mã này, vui lòng bỏ qua email này.</p>

        <hr style="border: none; border-top: 1px solid #eee; margin: 20px 0;">

        <p style="color: #999; font-size: 12px; text-align: center;">
            Email này được gửi tự động, vui lòng không trả lời.
        </p>
    </div>
</body>
</html>
