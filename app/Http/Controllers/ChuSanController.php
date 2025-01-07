<?php

namespace App\Http\Controllers;

use App\Models\CauHinhKhungGio;
use App\Models\ChuSan;
use App\Models\KhachHang;
use App\Models\SanBong;
use App\Models\ThueSan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChuSanController extends Controller
{
    public function index()
    {
        return view('Admin.Page.ChuSan.index');
    }

    public function data()
    {
        $data = ChuSan::join('khach_hangs', 'khach_hangs.id', '=', 'chu_sans.id_khach_hang')
                      ->join('san_bongs', 'san_bongs.id', 'chu_sans.id_san')
                      ->orderBy('chu_sans.id', 'desc')
                      ->select(
                            'chu_sans.*', 'khach_hangs.ho_va_ten as ten_khach_hang', 'san_bongs.ten_san as ten_san_bong',
                            DB::raw('DATE_FORMAT(chu_sans.created_at, "%d/%m/%Y") as ngay_dang_ky'),
                            DB::raw('DATE_FORMAT(DATE_ADD(chu_sans.created_at, INTERVAL chu_sans.thoi_han MONTH), "%d/%m/%Y") as ngay_het_han'),
                            DB::raw('chu_sans.gia_thue_san as gia_thue_san'),
                            DB::raw('chu_sans.thoi_han as thoi_han'),
                            DB::raw('(gia_dau_thau * phan_tram_coc / 100) as tien_coc')
                      )
                      ->get();
        return response()->json(['data' => $data]);
    }

    public function duyetDonDangKy(Request $request)
    {
        $data = ChuSan::find($request->id);
        if($data->trang_thai_duyet == 1) {
            $data->trang_thai_duyet = 0;
            SanBong::where('id', $data->id_san)->update(['id_chu_san' => null]);
        } else {
            $data->trang_thai_duyet = 1;
            SanBong::where('id', $data->id_san)->update(['id_chu_san' => $data->id]);
        }
        $data->save();
        return response()->json([
            'status'    => true,
            "messages"   => "Đã duyệt/ hủy đơn đăng ký sân thành công"
        ]);
    }

    public function viewSanDaLamChuKhachHang()
    {
        return view('KhachHang.ChuSan.index');
    }

    public function dataSanDaLamChuKhachHang()
    {
        $user = Auth::guard('khach_hang')->user();
        $data = ChuSan::where('id_khach_hang', $user->id)
                      ->join('san_bongs', 'san_bongs.id', 'chu_sans.id_san')
                      ->join('khu_vucs', 'khu_vucs.id', 'san_bongs.id_khu_vuc')
                      ->select('chu_sans.*', 'san_bongs.ten_san', 'khu_vucs.ten_khu_vuc', 'san_bongs.phan_tram_coc', 'san_bongs.dien_tich')
                      ->get();
        return response()->json(['data' => $data]);
    }

    public function traSan(Request $request)
    {
        $data = ChuSan::find($request->id);
        if($data->trang_thai_duyet == 1) {
            $data->trang_thai_duyet = 2;
            $data->save();
            SanBong::where('id', $data->id_san)->update(['id_chu_san' => null]);
            return response()->json([
                'status'    => true,
                "messages"   => "Đã trả sân thành công"
            ]);
        } else {
            $data->trang_thai_duyet = 2;
            $data->save();
            return response()->json([
                'status'    => true,
                "messages"   => "Huỷ đơn đăng ký thành công"
            ]);
        }
    }

    public function capNhatCauHinh(Request $request)
    {
        $user = Auth::guard('khach_hang')->user();
        $data = ChuSan::where('id_khach_hang', $user->id)->where('id_san', $request->id_san)->first();
        if($data) {
            CauHinhKhungGio::where('id_san', $request->id_san)
                           ->delete();
            $ma_san = SanBong::where('id', $request->id_san)->value('ma_san');
            foreach($request->list_khung_gio as $item) {
                CauHinhKhungGio::create([
                    'ma_khung_gio'          => 'KHUNG_GIO_'.date('YmdHis'). "_". $request->id_san,
                    'thoi_gian_bat_dau'     => $item['thoi_gian_bat_dau'],
                    'thoi_gian_ket_thuc'    => $item['thoi_gian_ket_thuc'],
                    'gia_tien_gio'          => $item['gia_tien_gio'],
                    'id_san'                => $request->id_san,
                    'ma_san'                => $ma_san,
                ]);
            }
        } else {
            return response()->json([
                'status'    => false,
                "messages"   => "Bạn không có quyền truy cập"
            ]);
        }

        return response()->json([
            'status'    => true,
            "messages"   => "Đã cập nhật cấu hình thành công"
        ]);
    }

    public function getListKhungGio(Request $request)
    {
        $data = CauHinhKhungGio::where('id_san', $request->id_san)->get();
        return response()->json(['data' => $data]);
    }

    public function lichThueKhachHang()
    {
        return view('KhachHang.LichDatSanKhachHang.index');
    }

    public function indexCalendar()
    {
        return view('KhachHang.LichDatSanKhachHang.calendar');
    }

    public function dataCalendar()
    {
        $user               = Auth::guard('khach_hang')->user();
        $list_color         = ["#f56954", '#f39c12', "#00a65a", "#3498db"];
        $list_id_san        = ChuSan::where('id_khach_hang', $user->id)->pluck('id_san')->toArray();
        $data = ThueSan::whereIn('id_san', $list_id_san)
                       ->join('san_bongs', 'san_bongs.id', 'thue_sans.id_san')
                       ->join('khu_vucs', 'khu_vucs.id', 'san_bongs.id_khu_vuc')
                       ->select('thue_sans.*', 'san_bongs.ten_san', 'khu_vucs.ten_khu_vuc', 'san_bongs.phan_tram_coc', 'san_bongs.dien_tich')
                       ->get();

        foreach($data as $key => $item) {
            $startHour = Carbon::parse($item->thoi_gian_bat_dau)->hour;
            if ($startHour >= 7 && $startHour < 9) {
                $item->color = $list_color[0];  // 7AM-12PM: Red
            } else if ($startHour >= 9 && $startHour < 14) {
                $item->color = $list_color[1];  // 12PM-5PM: Orange
            } else if ($startHour >= 14 && $startHour <= 21) {
                $item->color = $list_color[2];  // 5PM-12AM: Green
            } else {
                $item->color = $list_color[3];  // Other times: Blue
            }
            $item->title = $item->ten_san . ' - ' . $item->ten_khu_vuc . ' - ' . $item->ten_khach_hang;
            $item->start = Carbon::parse($item->thoi_gian_bat_dau)->format('Y-m-d\TH:i:s');
            $item->end = Carbon::parse($item->thoi_gian_ket_thuc)->format('Y-m-d\TH:i:s');
        }

        return response()->json(['data' => $data]);
    }

    public function huyDangKy(Request $request)
    {
        $data = ChuSan::find($request->id);
        $data->delete();
        return response()->json(['status' => true, 'messages' => 'Đã hủy đơn đăng ký thành công']);
    }
}
