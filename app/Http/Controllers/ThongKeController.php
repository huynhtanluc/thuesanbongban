<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use App\Models\LichDatSan;
use App\Models\ThueSan;
use App\Models\ChuSan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ThongKeController extends Controller
{
    public function getData(Request $request)
    {
        $begin  = Carbon::parse($request->begin);
        $end    = Carbon::parse($request->end);
        $user   = Auth::guard('khach_hang')->user();

        $diffInDays = $end->diffInDays($begin);
        $interval = ceil($diffInDays / 5);
        $dates = [];
        $currentDate = $begin;

        for($i = 0; $i <= 5; $i++) {
            if($i == 5) {
                $dates[] = $end->format('Y-m-d');
            } else {
                $dates[] = $currentDate->format('Y-m-d');
                $currentDate = $currentDate->copy()->addDays($interval);
            }
        }

        $data = [
            'labels'    => [],
            'bookings'  => [],
            'revenues'  => [],
            'posts'     => [],
            'mat_bangs' => []
        ];

        for ($i = 0; $i < count($dates) - 1; $i++) {
            $start = $dates[$i];
            $end = $dates[$i + 1];

            $data['labels'][] = Carbon::parse($start)->format('d/m/Y');

            // Đếm số lượng đặt sân
            $bookings = ThueSan::join('san_bongs', 'thue_sans.id_san', 'san_bongs.id')
                              ->join('chu_sans', 'san_bongs.id_chu_san', 'chu_sans.id')
                              ->where('chu_sans.id_khach_hang', $user->id)
                              ->whereBetween('thue_sans.created_at', [$start, $end])
                              ->count();
            $data['bookings'][] = $bookings;

            // Tính doanh thu
            $revenue = ThueSan::join('san_bongs', 'thue_sans.id_san', 'san_bongs.id')
                             ->join('chu_sans', 'san_bongs.id_chu_san', 'chu_sans.id')
                             ->where('chu_sans.id_khach_hang', $user->id)
                             ->where('thue_sans.trang_thai', 1)
                             ->whereBetween('thue_sans.created_at', [$start, $end])
                             ->sum('thue_sans.thanh_tien');
            $data['revenues'][] = $revenue;

            // Đếm số bài viết
            $posts = BaiViet::where('id_chu_san', $user->id)
                           ->whereBetween('created_at', [$start, $end])
                           ->count();
            $data['posts'][] = $posts;

            // Đếm số mặt bằng đang hoạt động
            $mat_bangs = DB::table('mat_bang_sans')
                          ->where('id_chu_san', $user->id)
                          ->where('trang_thai', 1)
                          ->whereBetween('created_at', [$start, $end])
                          ->count();
            $data['mat_bangs'][] = $mat_bangs;
        }

        // Thống kê tổng quan
        $tong_quan = [
            'tong_san' => ChuSan::where('id_khach_hang', $user->id)->count(),
            'tong_mat_bang' => DB::table('mat_bang_sans')
                                ->where('id_chu_san', $user->id)
                                ->where('trang_thai', 1)
                                ->count(),
            'tong_dat_san' => ThueSan::join('san_bongs', 'thue_sans.id_san', 'san_bongs.id')
                                    ->join('chu_sans', 'san_bongs.id_chu_san', 'chu_sans.id')
                                    ->where('chu_sans.id_khach_hang', $user->id)
                                    ->count(),
            'tong_doanh_thu' => ThueSan::join('san_bongs', 'thue_sans.id_san', 'san_bongs.id')
                                      ->join('chu_sans', 'san_bongs.id_chu_san', 'chu_sans.id')
                                      ->where('chu_sans.id_khach_hang', $user->id)
                                      ->where('thue_sans.trang_thai', 1)
                                      ->sum('thue_sans.thanh_tien'),
        ];

        return response()->json([
            'status' => true,
            'data'   => $data,
            'tong_quan' => $tong_quan
        ]);
    }

    public function index()
    {
        return view('KhachHang.ThongKe.index');
    }
}
