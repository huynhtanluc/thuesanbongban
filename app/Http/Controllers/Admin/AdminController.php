<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function viewLogin()
    {
        return view('Admin.Page.Login.index');
    }

    public function actionLogin(Request $request)
    {
        $check_1 = Auth::guard('quan_tri_vien')->attempt(['email' => $request->username, 'password' => $request->password]);
        $check_2 = Auth::guard('quan_tri_vien')->attempt(['ma_quan_tri_vien' => $request->username, 'password' => $request->password]);
        if ($check_1 || $check_2) {
            return redirect('/admin')->with('success', 'Đăng nhập thành công!');
        } else {
            return redirect('/admin/login')->with('error', 'Tài khoản hoặc mật khẩu không đúng!');
        }

    }

    public function logout()
    {
        Auth::guard('quan_tri_vien')->logout();
        return redirect('/admin/login')->with('success', 'Đăng xuất thành công!');
    }
}
