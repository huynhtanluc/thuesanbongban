<?php

namespace App\Http\Controllers;

use App\Models\CauHinhKhungGio;
use App\Models\CauHinhNganHang;
use App\Models\ChuSan;
use App\Models\SanBong;
use App\Models\ThueSan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LichDatSanController extends Controller
{
    public function index() {
        return view('KhachHang.LichDatSan.index');
    }


    public function dataLichDatSanKhachHang()
    {
        $user = Auth::guard('khach_hang')->user();
        $data = ThueSan::join('san_bongs', 'thue_sans.id_san', 'san_bongs.id')
                       ->join('khu_vucs', 'san_bongs.id_khu_vuc', 'khu_vucs.id')
                       ->where('thue_sans.id_khach_hang', $user->id)
                       ->select('thue_sans.*', 'san_bongs.ten_san', 'khu_vucs.ten_khu_vuc')
                       ->orderBy('thue_sans.thoi_gian_bat_dau', 'desc')
                       ->get();

        return response()->json([
            'status' => true,
            'data'   => $data
        ]);
    }

    public function huyLich(Request $request)
    {
        $data = ThueSan::find($request->id);
        if(!$data) {
            return response()->json([
                'status'  => false,
                'message' => 'Không tìm thấy lịch đặt sân!'
            ]);
        }

        // Kiểm tra xem đã quá giờ chưa
        if(Carbon::now() >= Carbon::parse($data->thoi_gian_bat_dau) || $data->thanh_toan > 0) {
            return response()->json([
                'status'  => false,
                'message' => 'Không thể huỷ lịch đã bắt đầu/Thanh toán!'
            ]);
        }

        if($data->trang_thai_thanh_toan == 1) {
            return response()->json([
                'status'  => false,
                'message' => 'Không thể huỷ lịch đã thanh toán!'
            ]);
        }

        $data->delete();
        return response()->json([
            'status'  => true,
            'message' => 'Đã huỷ lịch thành công!'
        ]);
    }

    public function thongTinChuyenKhoan(Request $request)
    {
        $chu_san = SanBong::where('san_bongs.id', $request->id_san)
                         ->join('chu_sans', 'chu_sans.id', 'san_bongs.id_chu_san')
                         ->select('chu_sans.*')
                         ->first();
        $config  = CauHinhNganHang::where('id_khach_hang', $chu_san->id_khach_hang)->first();
        return $this->ResData($config);
    }
}

