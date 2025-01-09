<?php

namespace App\Http\Controllers\BaiViet;

use App\Http\Controllers\Controller;
use App\Http\Requests\KhachHang\BaiViet\CreateBaiVietRequest;
use App\Models\BaiViet;
use App\Models\ChuSan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BaiVietController extends Controller
{


    public function indexBaiViet()
    {
        return view('KhachHang.BaiViet.index');
    }

    public function storeBaiViet(CreateBaiVietRequest $request)
    {
        $user = Auth::guard('khach_hang')->user();

        $maBaiViet = 'BV' . strlen($user->ma_khach_hang) . rand(1000, 9999);

        BaiViet::create([
            'ma_bai_viet'   => $maBaiViet,
            'ten_bai_viet'  => $request->ten_bai_viet,
            'noi_dung'      => $request->noi_dung,
            'noi_dung_ngan' => $request->noi_dung_ngan,
            'hinh_anh'      => $request->hinh_anh,
            'trang_thai'    => 1,
            'ma_chu_san'    => $user->ma_khach_hang,
            'id_chu_san'    => $user->id,
        ]);

        return response()->json([
            'status' => 1,
            'messages' => 'Đã thêm mới bài viết thành công!'
        ]);
    }

    public function dataBaiViet()
    {
        $data = BaiViet::where('id_chu_san', Auth::guard('khach_hang')->user()->id)->get();
        return response()->json([
            'data' => $data
        ]);
    }

    public function updateBaiViet(Request $request)
    {
        try {
            $rules = [
                'ten_bai_viet'  =>  'required|min:3|max:255',
                'noi_dung'      =>  'required|min:3',
                'noi_dung_ngan' =>  'required|min:3',
                'hinh_anh'      =>  'required',
            ];
            $messages = [
                'ten_bai_viet.required' => 'Tiêu đề bài viết không được để trống!',
                'ten_bai_viet.max'      => 'Tiêu đề bài viết không được quá 255 ký tự!',
                'noi_dung.required'     => 'Nội dung bài viết không được để trống!',
                'noi_dung_ngan.required'=> 'Nội dung ngắn không được để trống!',
                'hinh_anh.required'     => 'Hình ảnh không được để trống!',
            ];
            $request->validate($rules, $messages);

            $baiViet = BaiViet::find($request->id);
            if($baiViet) {
                $baiViet->update($request->all());
                return response()->json([
                    'status'    => true,
                    'messages'  => 'Đã cập nhật bài viết thành công!'
                ]);
            }
            return response()->json([
                'status'    => false,
                'messages'  => 'Không tìm thấy bài viết!'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status'    => false,
                'messages'  => 'Có lỗi xảy ra: ' . $e->getMessage()
            ]);
        }
    }

    public function deleteBaiViet(Request $request)
    {
        try {
            $baiViet = BaiViet::where('id', $request->id)
                              ->where('id_chu_san', Auth::guard('khach_hang')->user()->id)
                              ->first();
            if($baiViet) {
                // Xóa file ảnh cũ nếu có
                if($baiViet->hinh_anh) {
                    $oldPath = public_path($baiViet->hinh_anh);
                    if(file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
                $baiViet->delete();
                return response()->json([
                    'status'    => true,
                    'messages'  => 'Đã xóa bài viết thành công!'
                ]);
            }
            return response()->json([
                'status'    => false,
                'messages'  => 'Không tìm thấy bài viết!'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status'    => false,
                'messages'  => 'Có lỗi xảy ra: ' . $e->getMessage()
            ]);
        }
    }

    
    public function uploadAnh(Request $request)
    {
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/bai_viet'), $fileName);
            return response()->json([
                'status'    => true,
                'file'      => '/uploads/bai_viet/' . $fileName,
                'messages'  => 'Đã tải lên hình ảnh thành công!'
            ]);
        }
        return response()->json([
            'status'    => false,
        ]);
    }

    public function indexChiTietBaiViet($id)
    {
        $data = BaiViet::where("bai_viets.id", $id)
                       ->join('khach_hangs', 'khach_hangs.id', 'bai_viets.id_chu_san')
                       ->select('bai_viets.*',
                               'khach_hangs.ho_va_ten as ten_khach_hang',
                               DB::raw('DATE_FORMAT(bai_viets.created_at, "%d/%m/%Y") as ngay_dang'))
                       ->first();

        $bai_viet_noi_bat = BaiViet::where("bai_viets.trang_thai", 1)
                                   ->where("bai_viets.id", "!=", $id)
                                   ->select('bai_viets.*',
                                           DB::raw('DATE_FORMAT(bai_viets.created_at, "%d/%m/%Y") as ngay_dang'))
                                   ->inRandomOrder()
                                   ->limit(4)
                                   ->get();

        $chu_san_tieu_bieu = BaiViet::where('bai_viets.trang_thai', 1)
                                    ->join('khach_hangs', 'khach_hangs.id', 'bai_viets.id_chu_san')
                                    ->select('khach_hangs.id',
                                            'khach_hangs.ho_va_ten as ten_chu_san',
                                            'khach_hangs.anh',
                                            DB::raw('COUNT(bai_viets.id) as so_bai_viet'))
                                    ->groupBy('khach_hangs.id',
                                            'khach_hangs.ho_va_ten',
                                            'khach_hangs.anh')
                                    ->having('so_bai_viet', '>', 0)
                                    ->orderBy('so_bai_viet', 'desc')
                                    ->limit(4)
                                    ->get();

        return view('KhachHang.TinTuc.index', compact('data', 'bai_viet_noi_bat', 'chu_san_tieu_bieu'));
    }

}
