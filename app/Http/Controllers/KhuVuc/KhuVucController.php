<?php

namespace App\Http\Controllers\KhuVuc;

use App\Http\Controllers\Controller;
use App\Models\KhuVuc;
use Illuminate\Http\Request;

class KhuVucController extends Controller
{
    public function index()
    {
        return view('Admin.Page.KhuVuc.index');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if(KhuVuc::latest()->first()){
            $data['ma_khu_vuc'] = 'MKV' . (1000 + KhuVuc::latest()->first()->id);
        }else{
            $data['ma_khu_vuc'] = 'MKV' . 1000;
        }

        $create = KhuVuc::create($data);

        return response()->json([
            'status' => 1,
            'messages' => 'Đã thêm mới thành công!'
        ]);
    }

    public function data()
    {
        $data = KhuVuc::get();

        if($data){
            return response()->json([
                'data' => $data
            ]);
        }
    }

    public function changeStatus($id)
    {
        $data = KhuVuc::find($id);

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
        $khachHang = KhuVuc::find($data['id']);
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

    public function update(Request $request)
    {
        $data = $request->all();
        $khachHang = KhuVuc::find($data['id']);
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

    public function dataKhuVucKhachHang()
    {
        $data = KhuVuc::where('trang_thai', 1)->get();
        return response()->json([
            'data' => $data
        ]);
    }
}
