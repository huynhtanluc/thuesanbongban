<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use App\Models\ChuSan;
use Illuminate\Http\Request;
use App\Models\SanBong;
use App\Models\KhachHang;
use App\Models\ThueSan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomePageController extends Controller
{
    public function index()
    {
        return view('KhachHang.HomePage.index');
    }


    public function indexAdmin()
    {
        return view('Admin.Page.HomePage.index');
    }

    public function getThongKeData()
    {
        $begin = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();

        // Thống kê tổng quan
        $tong_quan = [
            'tong_chu_san' => ChuSan::distinct('id_khach_hang')->count('id_khach_hang'),
            'tong_doanh_thu' => ThueSan::join('san_bongs', 'thue_sans.id_san', 'san_bongs.id')
                                      ->join('chu_sans', 'san_bongs.id_chu_san', 'chu_sans.id')
                                      ->where('thue_sans.trang_thai', 1)
                                      ->sum('thue_sans.thanh_tien'),
            'tong_khach_hang' => DB::table('chi_tiet_khach_hang_chu_sans')
                                  ->distinct('id_khach_hang')
                                  ->count('id_khach_hang'),
            'tong_mat_bang' => DB::table('mat_bang_sans')->count(),
        ];

        // Thống kê theo thời gian
        $data = [
            'labels' => [],
            'chu_sans' => [],
            'revenues' => [],
            'khach_hangs' => []
        ];

        // Lấy dữ liệu theo từng ngày trong tháng
        $current = $begin->copy();
        while ($current <= $end) {
            $data['labels'][] = $current->format('d/m/Y');

            // Đếm số chủ sân mới
            $chu_sans = ChuSan::whereDate('created_at', $current)
                             ->distinct('id_khach_hang')
                             ->count('id_khach_hang');
            $data['chu_sans'][] = $chu_sans;

            // Tính doanh thu
            $revenue = ThueSan::join('san_bongs', 'thue_sans.id_san', 'san_bongs.id')
                             ->join('chu_sans', 'san_bongs.id_chu_san', 'chu_sans.id')
                             ->whereDate('thue_sans.created_at', $current)
                             ->where('thue_sans.trang_thai', 1)
                             ->sum('thue_sans.thanh_tien');
            $data['revenues'][] = $revenue;

            // Đếm số khách hàng mới theo dõi chủ sân
            $khach_hangs = DB::table('chi_tiet_khach_hang_chu_sans')
                            ->whereDate('created_at', $current)
                            ->distinct('id_khach_hang')
                            ->count('id_khach_hang');
            $data['khach_hangs'][] = $khach_hangs;

            $current->addDay();
        }

        return response()->json([
            'status' => true,
            'data' => $data,
            'tong_quan' => $tong_quan
        ]);
    }

    public function dataHomeKhachHang()
    {
        $sanNoiBat = SanBong::where('san_bongs.trang_thai', 1)
                            ->join('khu_vucs', 'san_bongs.id_khu_vuc', 'khu_vucs.id')
                            ->join('chu_sans', 'san_bongs.id_chu_san', 'chu_sans.id')
                            ->join('khach_hangs', 'chu_sans.id_khach_hang', 'khach_hangs.id')
                            ->select('san_bongs.*', 'khu_vucs.ten_khu_vuc', 'khach_hangs.ho_va_ten as ten_chu_san')
                            ->inRandomOrder()
                            ->limit(6)
                            ->get();

        $baiViet = BaiViet::where('trang_thai', 1)
                            ->select('bai_viets.*', DB::raw('DATE_FORMAT(created_at, "%d/%m/%Y") as ngay_dang'))
                            ->inRandomOrder()
                            ->limit(6)
                            ->get();
        return response()->json([
            'list_san_noi_bat' => $sanNoiBat,
            'list_bai_viet'    => $baiViet
        ]);
    }

    public function indexLienHe()
    {
        $dsChuSan = ChuSan::where('trang_thai_duyet', 1)
                          ->join('khach_hangs', 'chu_sans.id_khach_hang', 'khach_hangs.id')
                          ->select('khach_hangs.id', 'khach_hangs.ho_va_ten')
                          ->groupBy('khach_hangs.id', 'khach_hangs.ho_va_ten')
                          ->get();
        return view('KhachHang.LienHe.index', compact('dsChuSan'));
    }
}

