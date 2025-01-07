<?php

namespace App\Http\Controllers;

use App\Models\CauHinhNganHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CauHinhNganHangController extends Controller
{
    public function index()
    {
        $data = CauHinhNganHang::where('id_khach_hang', Auth::guard('khach_hang')->user()->id)->first();
        return view('KhachHang.ThanhToan.index', compact('data'));
    }

    public function cauHinhNganHang(Request $request)
    {
        $user = Auth::guard('khach_hang')->user();
        $data = $request->all();
        $bank = explode('|', $data['ngan_hang']);
        $data['ma_cau_hinh_ngan_hang'] = $user->ma_khach_hang . "_" . $bank[1];
        $data['ma_khach_hang']  = $user->ma_khach_hang;
        $data['id_khach_hang']  = $user->id;
        $data['trang_thai']     = 1;
        $data['anh_qr']         = 'https://img.vietqr.io/image/'. $bank[0] .'-'. $data['so_tai_khoan'] .'-compact2.jpg?accountName=' . $data['ten_chu_tai_khoan'];
        $ngan_hang              = $bank[1] . ' - ' . $bank[2];
        $cauHinhNganHang = CauHinhNganHang::where('id_khach_hang', $user->id)->first();
        if($cauHinhNganHang) {
            $cauHinhNganHang->update([
                'ma_cau_hinh_ngan_hang'     => $data['ma_cau_hinh_ngan_hang'],
                'ten_chu_tai_khoan'         => $data['ten_chu_tai_khoan'],
                'so_tai_khoan'              => $data['so_tai_khoan'],
                'ngan_hang'                 => $ngan_hang,
                'anh_qr'                    => $data['anh_qr'],
                'ma_khach_hang'             => $data['ma_khach_hang'],
                'id_khach_hang'             => $data['id_khach_hang'],
            ]);
        } else {
            CauHinhNganHang::create([
                'ma_cau_hinh_ngan_hang'     => $data['ma_cau_hinh_ngan_hang'],
                'ten_chu_tai_khoan'         => $data['ten_chu_tai_khoan'],
                'so_tai_khoan'              => $data['so_tai_khoan'],
                'ngan_hang'                 => $ngan_hang,
                'anh_qr'                    => $data['anh_qr'],
                'ma_khach_hang'             => $data['ma_khach_hang'],
                'id_khach_hang'             => $data['id_khach_hang'],
            ]);
        }
        return back()->with('success', 'Cập nhật cấu hình ngân hàng thành công');
    }
}
