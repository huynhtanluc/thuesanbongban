<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Models\MatBang;
use App\Models\MatBangSan;
use App\Models\ThanhPho;
use App\Models\QuanHuyen;
use App\Models\PhuongXa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MatBangController extends Controller
{
    public function index()
    {
        return view('KhachHang.MatBang.index');
    }

    public function getData()
    {
        $id_chu_san = Auth::guard('khach_hang')->user()->id;

        $data = MatBangSan::join('thanh_phos', 'mat_bang_sans.id_thanh_pho', 'thanh_phos.id')
                       ->join('quan_huyens', 'mat_bang_sans.id_quan_huyen', 'quan_huyens.id')
                       ->join('phuong_xas', 'mat_bang_sans.id_phuong_xa', 'phuong_xas.id')
                       ->where('mat_bang_sans.id_chu_san', $id_chu_san)
                       ->select('mat_bang_sans.*',
                               'thanh_phos.ten_thanh_pho',
                               'quan_huyens.ten_quan_huyen',
                               'phuong_xas.ten_phuong_xa')
                       ->get();

        return response()->json([
            'status'    => true,
            'data'      => $data
        ]);
    }

    public function getThanhPho()
    {
        $data = ThanhPho::where('id', 32)->get();

        return response()->json([
            'status'    => true,
            'data'      => $data
        ]);
    }

    public function getQuanHuyen($id_thanh_pho)
    {
        $data = QuanHuyen::where('id_thanh_pho', $id_thanh_pho)->get();

        return response()->json([
            'status'    => true,
            'data'      => $data
        ]);
    }

    public function getPhuongXa($id_quan_huyen)
    {
        $data = PhuongXa::where('id_quan_huyen', $id_quan_huyen)->get();

        return response()->json([
            'status'    => true,
            'data'      => $data
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['id_chu_san'] = Auth::guard('khach_hang')->user()->id;

        // Tạo mã mặt bằng tự động
        $count = MatBangSan::count();
        $ma_mat_bang = 'MB' . str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        $data['ma_mat_bang'] = $ma_mat_bang;

        try {
            MatBangSan::create($data);
            return $this->NotifiSuccess("Đã thêm mới mặt bằng thành công!");
        } catch (\Exception $e) {
            throw new CustomException("Có lỗi xảy ra!");
        }
    }

    public function update(Request $request)
    {
        $matBang = MatBangSan::find($request->id);

        if(!$matBang) {
            throw new CustomException("Mặt bằng không tồn tại!");
        }

        try {
            $matBang->update($request->all());
            return $this->NotifiSuccess("Đã cập nhật mặt bằng thành công!");
        } catch (\Exception $e) {
            throw new CustomException("Có lỗi xảy ra!");
        }
    }

    public function destroy(Request $request)
    {
        $matBang = MatBangSan::find($request->id);

        if(!$matBang) {
            throw new CustomException("Mặt bằng không tồn tại!");
        }

        try {
            $matBang->delete();
            return $this->NotifiSuccess("Đã xóa mặt bằng thành công!");
        } catch (\Exception $e) {
            throw new CustomException("Có lỗi xảy ra!");
        }
    }

    public function changeStatus($id)
    {
        $matBang = MatBangSan::find($id);
        if(!$matBang) {
            throw new CustomException("Mặt bằng không tồn tại!");
        }

        try {
            $matBang->trang_thai = !$matBang->trang_thai;
            $matBang->save();
            return $this->NotifiSuccess("Đã thay đổi trạng thái mặt bằng thành công!");
        } catch (\Exception $e) {
            throw new CustomException("Có lỗi xảy ra!");
        }
    }
}
