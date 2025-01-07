<?php

namespace App\Http\Controllers\SanBong;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SanBong\CreateSanBongRequest;
use App\Models\CauHinhKhungGio;
use App\Models\ChiTietKhachHangChuSan;
use App\Models\ChuSan;
use App\Models\MatBangSan;
use App\Models\SanBong;
use App\Models\ThueSan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SanBongController extends Controller
{
    public function index()
    {
        return view('Admin.Page.SanBong.index');
    }

    public function indexCauHinhDiaChi()
    {
        return view('KhachHang.CauHinhDiaChi.index');
    }

    public function store(CreateSanBongRequest $request)
    {
        $data = $request->all();
        if(SanBong::latest()->first()){
            $data['ma_san'] = 'MS' . (1000 + SanBong::latest()->first()->id);
        }else{
            $data['ma_san'] = 'MS' . 1000;
        }

        $create = SanBong::create($data);

        return response()->json([
            'status' => 1,
            'messages' => 'Đã thêm mới thành công!'
        ]);
    }

    public function data()
    {
        $data = SanBong::join('khu_vucs','san_bongs.id_khu_vuc', 'khu_vucs.id')
                        ->leftJoin('chu_sans','san_bongs.id_chu_san', 'chu_sans.id')
                        ->leftJoin('khach_hangs','chu_sans.id_khach_hang', 'khach_hangs.id')
                        ->select('san_bongs.*', 'khu_vucs.ten_khu_vuc', 'khach_hangs.ho_va_ten as ten_chu_san')
                        ->get();

        if($data){
            return response()->json([
                'data' => $data
            ]);
        }
    }

    public function changeStatus($id)
    {
        $data = SanBong::find($id);

        if($data){
            $data->trang_thai = !$data->trang_thai;
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
        $khachHang = SanBong::find($data['id']);
        if($khachHang){
            $check = ChuSan::where('id_san', $khachHang->id)->first();
            if($check){
                return response()->json([
                    'status' => 0,
                    'messages' => 'Sân bóng đã có chủ và còn thời hạn thuê!'
                ]);
            }
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

    public function update(Request $request)
    {
        $data = $request->all();
        $khachHang = SanBong::find($data['id']);
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

    public function indexKhachHang()
    {
        return view('KhachHang.SanBong.index');
    }

    public function dataSanKhachHang()
    {
        $data = SanBong::where('san_bongs.trang_thai', 1)
                       ->join('khu_vucs','san_bongs.id_khu_vuc', 'khu_vucs.id')
                       ->leftJoin('chu_sans','san_bongs.id_chu_san', 'chu_sans.id')
                       ->leftJoin('khach_hangs','chu_sans.id_khach_hang', 'khach_hangs.id')
                       ->select(
                            'san_bongs.*',
                            'khu_vucs.ten_khu_vuc',
                            'khach_hangs.ho_va_ten as ten_chu_san',
                            'chu_sans.id_mat_bang as id_mat_bang'
                        )
                       ->get();

        $list_mat_bang = MatBangSan::where('trang_thai', 1)->get();

        foreach($data as $value){
            foreach($list_mat_bang as $mat_bang){
                if($value->id_mat_bang == $mat_bang->id){
                    $value->dia_chi = $mat_bang->dia_chi;
                }
            }
        }
        return response()->json([
            'data' => $data,
            'list_mat_bang' => $list_mat_bang
        ]);
    }

    public function dangKiSan(Request $request)
    {
        if($request->thoi_han < 1) {
            throw new CustomException('Thời hạn thuê phải lớn hơn 0!');
        }
        $user = Auth::guard('khach_hang')->user();
        $data = $request->all();
        $data['ma_chu_san'] = $user->ma_khach_hang;
        $data['gia_thue_san'] = $data['gia_thue_san'];
        $data['thoi_han'] = $data['thoi_han'];
        $data['ma_khach_hang'] = $user->ma_khach_hang;
        $data['id_khach_hang'] = $user->id;
        $data['ma_san'] = $data['ma_san'];
        $data['id_san'] = $data['id'];
        if(ChuSan::checkSanAvailable($data['id_san'])) {
            return response()->json([
                'status'    => false,
                'message'   => 'Sân này đã có chủ và còn thời hạn thuê!'
            ]);
        }

        $create = ChuSan::create($data);
        if($create){
            return response()->json([
                'status'    => 1,
                'messages'  => 'Đã đăng kí thành công!'
            ]);
        }else{
            return response()->json([
                'status' => 0,
                'messages' => 'Sân bóng đã được đăng kí!'
            ]);
        }
    }

    public function datSan(Request $request)
    {
        $data   = $request->all();

        if($data['so_gio_thue'] < 1) {
            return response()->json([
                'status'    => false,
                'messages'   => 'Phải thuê ít nhất 1 giờ!'
            ]);
        }

        $data['thoi_gian_bat_dau'] = Carbon::parse($data['ngay_thue'] . ' ' . $data['thoi_gian_bat_dau'])->format('Y-m-d H:i:s');
        $data['thoi_gian_ket_thuc'] = Carbon::parse($data['ngay_thue'] . ' ' . $data['thoi_gian_ket_thuc'])->format('Y-m-d H:i:s');

        $list_thue_san  = ThueSan::where('id_san', $data['id_san'])
                                ->whereDate('thoi_gian_bat_dau', $data['ngay_thue'])
                                ->orWhereDate('thoi_gian_ket_thuc', $data['ngay_thue'])
                                ->get();

        $check = true;
        foreach($list_thue_san as $value) {
            $thoiGianBatDau = Carbon::parse($value->thoi_gian_bat_dau);
            $thoiGianKetThuc = Carbon::parse($value->thoi_gian_ket_thuc);
            $thoiGianBatDauDatSan = Carbon::parse($data['thoi_gian_bat_dau']);
            $thoiGianKetThucDatSan = Carbon::parse($data['thoi_gian_ket_thuc']);
            if($thoiGianBatDau < $thoiGianBatDauDatSan && $thoiGianKetThuc > $thoiGianBatDauDatSan) {
                $check = false;
            }
            if($thoiGianBatDau < $thoiGianKetThucDatSan && $thoiGianKetThuc > $thoiGianKetThucDatSan) {
                $check = false;
            }
            if($thoiGianBatDau > $thoiGianBatDauDatSan && $thoiGianKetThuc < $thoiGianKetThucDatSan) {
                $check = false;
            }

            if($check == false) {
                return response()->json([
                    'status'    => false,
                    'messages'   => 'Khung giờ này đã được đặt!'
                ]);
            }

        }

        $user = Auth::guard('khach_hang')->user();
        $data['ma_khach_hang'] = $user->ma_khach_hang;
        $data['id_khach_hang'] = $user->id;
        $san = SanBong::join('chu_sans', 'san_bongs.id_chu_san', 'chu_sans.id')
                      ->where('san_bongs.id', $data['id_san'])
                      ->select('san_bongs.*', 'chu_sans.id_khach_hang')
                      ->first();

        $data['ma_san'] = $san->ma_san;
        $data['id_san'] = $san->id;
        $data["ma_thue_san"] = 'MTS' . (1000 + (ThueSan::latest()->first() ? ThueSan::latest()->first()->id : 0));

        $create = ThueSan::create($data);
        $check = ChiTietKhachHangChuSan::where('id_khach_hang', $user->id)->where('id_chu_san', $san->id_khach_hang)->first();
        if(!$check){
            ChiTietKhachHangChuSan::create([
                'id_khach_hang'     => $user->id,
                'id_chu_san'        => $san->id_khach_hang,
            ]);
        }

        if($create){
            return response()->json([
                'status' => 1,
                'messages' => 'Đã đặt sân thành công!'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'messages' => 'Đã có lỗi xảy ra!'
            ]);
        }
    }

    public function chiTietSan($id)
    {
        $list_bang_gia = CauHinhKhungGio::where('id_san', $id)->get();
        $list_lich_dat = ThueSan::where('id_san', $id)
                                ->join('khach_hangs','thue_sans.id_khach_hang', 'khach_hangs.id')
                                ->whereDate('thoi_gian_bat_dau', Carbon::now()->format('Y-m-d'))
                                ->select('thue_sans.*', 'khach_hangs.ho_va_ten as ten_khach_hang', 'khach_hangs.so_dien_thoai as so_dien_thoai')
                                ->get();

        return response()->json([
            'list_bang_gia' => $list_bang_gia,
            'list_lich_dat' => $list_lich_dat
        ]);
    }

    public function dataSanBongMatBangCauHinh()
    {
        $user           = Auth::guard('khach_hang')->user();
        $data_san_bong  = ChuSan::where('id_khach_hang', $user->id)
                                ->join('san_bongs','chu_sans.id_san', 'san_bongs.id')
                                ->select('san_bongs.*')
                                ->get();

        $data_mat_bang = MatBangSan::where('trang_thai', 1)
                                    ->where('id_chu_san', $user->id)
                                    ->get();

        return response()->json([
            'data_san_bong' => $data_san_bong,
            'data_mat_bang' => $data_mat_bang
        ]);
    }

    public function cauHinhDiaChi(Request $request)
    {
        $data   = $request->all();
        $user   = Auth::guard('khach_hang')->user();
        $config = ChuSan::where('id_khach_hang', $user->id)
                        ->where('id_san', $data['id_san'])
                        ->update([
                            'id_mat_bang' => $data['id_mat_bang']
                        ]);

        return $this->NotifiSuccess('Đã cấu hình thành công!');
    }

    public function dataSanBongCauHinh()
    {
        $user = Auth::guard('khach_hang')->user();
        $data = ChuSan::where('id_khach_hang', $user->id)
                        ->join('san_bongs','chu_sans.id_san', 'san_bongs.id')
                        ->join('mat_bang_sans','chu_sans.id_mat_bang', 'mat_bang_sans.id')
                        ->select('san_bongs.*', 'mat_bang_sans.dia_chi')
                        ->get();

        // $data = ChuSan::where('id_khach_hang', $user->id)
        //                 ->join('san_bongs','chu_sans.id_san', 'san_bongs.id')
        //                 ->join('mat_bang_sans','chu_sans.id_mat_bang', 'mat_bang_sans.id')
        //                 ->join('thanh_phos', 'mat_bang_sans.id_thanh_pho', 'thanh_phos.id')
        //                 ->join('quan_huyens', 'mat_bang_sans.id_quan_huyen', 'quan_huyens.id')
        //                 ->join('phuong_xas', 'mat_bang_sans.id_phuong_xa', 'phuong_xas.id')
        //                 ->select('san_bongs.*', 'mat_bang_sans.dia_chi', 'phuong_xas.ten_phuong_xa', 'quan_huyens.ten_quan_huyen', 'tinh_thanh_phos.ten_tinh_thanh_pho')
        //                 ->get();

        // dd($data);

        return response()->json([
            'data' => $data
        ]);
    }

    public function huyCauHinh(Request $request)
    {
        $data = $request->all();
        $user = Auth::guard('khach_hang')->user();
        $config = ChuSan::where('id_khach_hang', $user->id)
                        ->where('id_san', $data['id'])
                        ->update([
                            'id_mat_bang' => null
                        ]);

        return $this->NotifiSuccess('Đã hủy cấu hình thành công!');
    }
}
