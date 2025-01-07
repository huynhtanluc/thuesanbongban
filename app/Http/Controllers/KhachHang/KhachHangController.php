<?php

namespace App\Http\Controllers\KhachHang;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KhachHang\CreateKhachHangRequest;
use App\Http\Requests\Admin\KhachHang\UpdateKhachHangRequest;
use App\Mail\QuenMatKhauMail;
use App\Mail\TaoTaiKhoanMail;
use App\Models\ChiTietKhachHangChuSan;
use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class KhachHangController extends Controller
{
    public function index()
    {
        return view('Admin.Page.KhachHang.index');
    }

    public function store(CreateKhachHangRequest $request)
    {
        $user = Auth::guard('khach_hang')->user();
        $data = $request->all();
        if(KhachHang::latest()->first()){
            $data['ma_khach_hang'] = 'KH' . (1000 + KhachHang::latest()->first()->id);
        }else{
            $data['ma_khach_hang'] = 'KH' . 1000;
        }

        $data['password'] = 'canonquykhach';

        $create = KhachHang::create($data);
        ChiTietKhachHangChuSan::create([
            'id_khach_hang' => $create->id,
            'id_chu_san'    => $user->id,
            'is_chu_san_tao' => 1
        ]);
        return response()->json([
            'status' => 1,
            'messages' => 'Đã thêm mới thành công!'
        ]);
    }

    public function data()
    {
        $khach_hang     = Auth::guard('khach_hang')->user();
        $quan_tri_vien  = Auth::guard('quan_tri_vien')->user();
        if($khach_hang){
            $data = KhachHang::join('chi_tiet_khach_hang_chu_sans', 'khach_hangs.id', '=', 'chi_tiet_khach_hang_chu_sans.id_khach_hang')
                             ->where('chi_tiet_khach_hang_chu_sans.id_chu_san', $khach_hang->id)
                             ->select(
                                'khach_hangs.id',
                                'chi_tiet_khach_hang_chu_sans.is_chu_san_tao',
                                'chi_tiet_khach_hang_chu_sans.id_chu_san',
                                'khach_hangs.ho_va_ten',
                                'khach_hangs.email',
                                'khach_hangs.so_dien_thoai',
                                'khach_hangs.ngay_sinh',
                                'khach_hangs.gioi_tinh',
                                'khach_hangs.chung_minh_thu',
                                'khach_hangs.tinh_trang',
                                'khach_hangs.ma_khach_hang'
                             )
                             ->groupBy(
                                'khach_hangs.id',
                                'chi_tiet_khach_hang_chu_sans.is_chu_san_tao',
                                'chi_tiet_khach_hang_chu_sans.id_chu_san',
                                'khach_hangs.ho_va_ten',
                                'khach_hangs.email',
                                'khach_hangs.so_dien_thoai',
                                'khach_hangs.ngay_sinh',
                                'khach_hangs.gioi_tinh',
                                'khach_hangs.chung_minh_thu',
                                'khach_hangs.tinh_trang',
                                'khach_hangs.ma_khach_hang'
                             )
                             ->get();

        } else if($quan_tri_vien){
            $data = KhachHang::join('chu_sans', 'khach_hangs.id',  'chu_sans.id_khach_hang')
                            ->select(
                                'khach_hangs.id',
                                'khach_hangs.ho_va_ten',
                                'khach_hangs.email',
                                'khach_hangs.so_dien_thoai',
                                'khach_hangs.ngay_sinh',
                                'khach_hangs.gioi_tinh',
                                'khach_hangs.chung_minh_thu',
                                'khach_hangs.tinh_trang',
                                'khach_hangs.ma_khach_hang'
                            )
                            ->groupBy(
                                'khach_hangs.id',
                                'khach_hangs.ho_va_ten',
                                'khach_hangs.email',
                                'khach_hangs.so_dien_thoai',
                                'khach_hangs.ngay_sinh',
                                'khach_hangs.gioi_tinh',
                                'khach_hangs.chung_minh_thu',
                                'khach_hangs.tinh_trang',
                                'khach_hangs.ma_khach_hang'
                            )
                             ->get();
        }

        if($data){
            return response()->json([
                'data' => $data
            ]);
        }
    }

    public function changeStatus($id)
    {
        $data = KhachHang::find($id);

        if($data){
            $data->tinh_trang = !$data->tinh_trang;
            $data->save();
            return response()->json([
                'status' => 1,
                'messages' => 'Đã cập nhật thành công!'
            ]);
        }else{
            return response()->json([
                'status' => 0,
            ]);
        }
    }

    public function delete(Request $request)
    {
        $data = $request->all();
        $khachHang = KhachHang::find($data['id']);
        if($khachHang){
            $khachHang->delete();
            return response()->json([
                'status' => 1,
                'messages' => 'Đã xóa thành công!'
            ]);
        }else{
            return response()->json([
                'status' => 0,
            ]);
        }
    }

    public function update(UpdateKhachHangRequest $request)
    {
        $data = $request->all();
        $khachHang = KhachHang::find($data['id']);
        if($khachHang){
            $khachHang->update($data);
            return response()->json([
                'status' => 1,
                'messages' => 'Đã cập nhật thành công!'
            ]);
        }else{
            return response()->json([
                'status' => 0,
            ]);
        }
    }


    public function viewLogin()
    {
        return view('KhachHang.Login.index');
    }

    public function actionLogin(Request $request)
    {
        $data = $request->all();
        $check = Auth::guard('khach_hang')->attempt(['email' => $data['email'], 'password' => $data['password']]);
        if($check){
            return redirect('/')->with('success', 'Đăng nhập thành công!');
        }else{
            return redirect()->back()->with('error', 'Email hoặc mật khẩu không đúng!');
        }
    }

    public function viewRegister()
    {
        return view('KhachHang.Register.index');
    }

    public function actionRegister(Request $request)
    {
        try {
            $data = $request->all();

            // Kiểm tra email đã tồn tại
            if(KhachHang::where('email', $data['email'])->exists()) {
                return back()->with('error', 'Email đã được sử dụng!');
            }

            // Tạo mã kích hoạt
            $activation_token = Str::random(64);

            // Tạo mã khách hàng
            if(KhachHang::latest()->first()){
                $ma_khach_hang = 'KH' . (1000 + KhachHang::latest()->first()->id);
            } else {
                $ma_khach_hang = 'KH1000';
            }

            // Thêm dữ liệu vào bảng khách hàng
            $khachHang = KhachHang::create([
                'ma_khach_hang'    => $ma_khach_hang,
                'ho_va_ten'        => $data['ho_va_ten'],
                'email'            => $data['email'],
                'password'         => bcrypt($data['password']),
                'so_dien_thoai'    => $data['so_dien_thoai'],
                'ngay_sinh'        => $data['ngay_sinh'],
                'gioi_tinh'        => $data['gioi_tinh'],
                'chung_minh_thu'   => $data['chung_minh_thu'],
                'tinh_trang'       => 0, // Chưa kích hoạt
                'hash_active'      => $activation_token
            ]);

            if($khachHang) {
                // Gửi email xác nhận
                $mailData = [
                    'ho_va_ten'     => $khachHang->ho_va_ten,
                    'email'         => $khachHang->email,
                    'so_dien_thoai' => $khachHang->so_dien_thoai,
                    'link'          => env('APP_URL') . '/kich-hoat-tai-khoan/' . $activation_token
                ];

                Mail::to($khachHang->email)
                    ->send(new TaoTaiKhoanMail(
                        'Xác nhận đăng ký tài khoản',
                        'KhachHang.Mail.tao_tai_khoan',
                        $mailData
                    ));

                return redirect('/login')
                    ->with('success', 'Đăng ký thành công! Vui lòng kiểm tra email để kích hoạt tài khoản.');
            }

            return back()->with('error', 'Đăng ký thất bại, vui lòng thử lại!');

        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function kichHoatTaiKhoan($token)
    {
        $khachHang = KhachHang::where('hash_active', $token)->first();

        if (!$khachHang) {
            return redirect('/login')->with('error', 'Link kích hoạt không hợp lệ!');
        }

        $khachHang->tinh_trang = 1;
        $khachHang->hash_active = null;
        $khachHang->save();

        return redirect('/login')->with('success', 'Kích hoạt tài khoản thành công! Vui lòng đăng nhập.');
    }

    public function indexKhachHangQuanLy()
    {
        return view('KhachHang.KhachHang.index');
    }

    public function changePassword(Request $request)
    {
        $khach_hang = KhachHang::find($request->id);

        if(!$khach_hang) {
            throw new CustomException("Không tìm thấy khách hàng!");
        }

        $khach_hang->password = bcrypt($request->password_new);
        $khach_hang->save();

        return $this->NotifiSuccess("Đổi mật khẩu thành công!");
    }

    public function quetMatKhau()
    {
        return view('KhachHang.QuenMatKhau.index');
    }

    public function indexXacNhanCode()
    {
        return view('KhachHang.XacNhanCode.index');
    }

    public function actionQuenMatKhau(Request $request)
    {
        // try {
            $khach_hang = KhachHang::where('email', $request->email)->first();

            if(!$khach_hang) {
                return back()->with('error', 'Email không tồn tại!');
            }

            // Tạo mã xác nhận ngẫu nhiên 6 số
            $reset_code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $khach_hang->hash_reset = $reset_code;
            $khach_hang->save();

            $data = [
                'ho_va_ten'     => $khach_hang->ho_va_ten,
                'hash_reset'    => $khach_hang->hash_reset
            ];

            Mail::to($khach_hang->email)
                ->send(new QuenMatKhauMail(
                    'Mã xác nhận đặt lại mật khẩu',
                    'KhachHang.Mail.index',
                    $data
                ));

            return redirect('/xac-nhan-code')
                ->with('success', 'Vui lòng kiểm tra email để lấy mã xác nhận!')
                ->with('store_email', $request->email);

        // } catch (\Exception $e) {
        //     return back()->with('error', 'Có lỗi xảy ra khi gửi email. Vui lòng thử lại sau!');
        // }
    }

    public function actionXacNhanCode(Request $request)
    {
        $email = $request->email;
        $code   = $request->code;

        $khach_hang = KhachHang::where('email', $email)
                              ->where('hash_reset', $code)
                              ->first();

        if (!$khach_hang) {
            return back()->with('error', 'Mã xác nhận không đúng!');
        }

        // Xóa mã xác nhận sau khi verify thành công
        $khach_hang->hash_reset = null;
        $khach_hang->save();

        // Xóa email khỏi localStorage bằng JavaScript
        return redirect('/reset-mat-khau')
            ->with('success', 'Xác nhận thành công!');
    }

    public function indexResetMatKhau()
    {
        return view('KhachHang.ResetMatKhau.index');
    }

    public function actionResetMatKhau(Request $request)
    {
        $check = KhachHang::where('email', $request->email)->first();
        if($check){
            $check->password = bcrypt($request->password);
            $check->save();
            return redirect('/login')->with('success', 'Đổi mật khẩu thành công!');
        }else{
            return redirect('/')->with('error', 'Đổi mật khẩu thất bại!');
        }
    }
}
