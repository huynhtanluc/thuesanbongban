<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Models\ChuSan;
use App\Models\SanBong;
use App\Models\ThueSan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LichThueSanController extends Controller
{
    public function dataLichThueSanKhachHang()
    {
        $user       = Auth::guard('khach_hang')->user();
        $list_san   = ThueSan::join('san_bongs', 'san_bongs.id', 'thue_sans.id_san')
                             ->join('chu_sans', 'chu_sans.id', 'san_bongs.id_chu_san')
                             ->where('chu_sans.id_khach_hang', $user->id)
                             ->join('khach_hangs', 'khach_hangs.id', 'thue_sans.id_khach_hang')
                             ->select('thue_sans.*', 'san_bongs.ten_san',
                                DB::raw('DATE_FORMAT(thoi_gian_bat_dau, "%d/%m/%Y") as ngay_dat'),
                                DB::raw('DATE_FORMAT(thoi_gian_bat_dau, "%H:%i") as gio_bat_dau'),
                                DB::raw('DATE_FORMAT(thoi_gian_ket_thuc, "%H:%i") as gio_ket_thuc'),
                                'khach_hangs.ho_va_ten as ten_khach_hang',
                                'khach_hangs.so_dien_thoai',
                             )
                             ->orderBy('thue_sans.thoi_gian_bat_dau', 'desc')
                             ->get();


        // $list_lich_thue_san = ThueSan::whereIn('id_san', $list_san->pluck('id_san'))
        //                                 ->where('id_khach_hang', $user->id)
        //                                 ->select('thue_sans.*', 'san_bongs.ten_san',
        //                                     DB::raw('DATE_FORMAT(thoi_gian_bat_dau, "%d/%m/%Y") as ngay_dat'),
        //                                     DB::raw('DATE_FORMAT(thoi_gian_bat_dau, "%H:%i") as gio_bat_dau'),
        //                                     DB::raw('DATE_FORMAT(thoi_gian_ket_thuc, "%H:%i") as gio_ket_thuc'))
        //                                 ->get();

        return response()->json(['data' => $list_san]);
    }

    public function xacNhanDatSan(Request $request)
    {
        $thueSan = ThueSan::find($request->id);
        if(!$thueSan) {
            throw new CustomException("Đơn đặt hàng không đúng!");
        }
        $tien_coc = $thueSan->thanh_tien * 0.3;
        if($request->so_tien_coc < $tien_coc) {
            throw new CustomException("Số tiền cọc ít nhất 30% tổng số tiền (". number_format($tien_coc) ."đ)");
        }

        $thanh_toan = $request->so_tien_coc >= $thueSan->thanh_tien ? 2 : 1;

        $thueSan->update([
            'so_tien_coc' => $request->so_tien_coc,
            'thanh_toan'  => $thanh_toan,
            'trang_thai'  => 1
        ]);
        $thueSan->save();

        return $this->NotifiSuccess("Xác nhận đặt sân thành công!");
    }

    public function huyDatSan(Request $request)
    {
        $thueSan = ThueSan::find($request->id);
        if(!$thueSan) {
            throw new CustomException("Đơn đặt hàng không đúng!");
        }

        if($thueSan->trang_thai == 1) {
            throw new CustomException("Không thể hủy đơn hàng đã xác nhận!");
        }

        $thueSan->delete();
        return $this->NotifiSuccess("Hủy đặt sân thành công!");
    }

    public function thanhToanHoanTat(Request $request)
    {
        $thueSan = ThueSan::find($request->id);
        if(!$thueSan) {
            throw new CustomException("Đơn đặt hàng không đúng!");
        }
        if($thueSan->thanh_toan == 2) {
            throw new CustomException("Đơn đặt hàng đã thanh toán!");
        }

        $thueSan->update(['thanh_toan' => 2]);
        $thueSan->save();

        return $this->NotifiSuccess("Thanh toán hoàn tất!");
    }
}
