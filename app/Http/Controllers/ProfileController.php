<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('KhachHang.Profile.index');
    }

    public function updateProfile(Request $request)
    {
        try {
            $khachHang = Auth::guard('khach_hang')->user();

            $data = $request->validate([
                'ho_va_ten'      => 'required|string|max:255',
                'email'          => 'required|email|unique:khach_hangs,email,' . $khachHang->id,
                'so_dien_thoai'  => 'required|string|max:20',
                'ngay_sinh'      => 'required|date',
                'chung_minh_thu' => 'required|string|max:20',
                'gioi_tinh'      => 'required|boolean',
                'password'       => 'nullable|min:6|same:re_password',
            ]);

            if($request->password) {
                $data['password'] = Hash::make($request->password);
            } else {
                unset($data['password']);
            }
            $khachHang = KhachHang::find(Auth::guard('khach_hang')->user()->id);
            $khachHang->update($data);

            return back()->with('success', 'Cập nhật thông tin thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function updateAvatar(Request $request)
    {
        try {
            $request->validate([
                'anh' => 'required|image|mimes:jpeg,png,jpg,gif'
            ]);

            $khachHang = Auth::guard('khach_hang')->user();

            if($request->hasFile('anh')) {
                if($khachHang->anh && $khachHang->anh != '/default-avatar.jpg') {
                    $oldPath = str_replace('/avatars/', '', $khachHang->anh);
                    Storage::delete('public/avatars/' . $oldPath);
                }

                $file = $request->file('anh');
                $fileName = time() . '_' . $file->getClientOriginalName();

                $file->move('public/avatars', $fileName);

                $khachHang = KhachHang::find(Auth::guard('khach_hang')->user()->id);
                $khachHang->update(['anh' => '/public/avatars/' . $fileName]);

                return back()->with('success', 'Cập nhật ảnh đại diện thành công!');
            }

            return back()->with('error', 'Không tìm thấy file ảnh!');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function logout()
    {
        Auth::guard('khach_hang')->logout();
        return redirect('/')->with('success', 'Đăng xuất thành công!');
    }
}
