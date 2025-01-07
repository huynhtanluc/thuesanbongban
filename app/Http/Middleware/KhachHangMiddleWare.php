<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class KhachHangMiddleWare
{
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::guard('khach_hang')->check()){
            return redirect('/login')->with('error', 'Vui lòng đăng nhập hệ thống!');
        } else {
            if(Auth::guard('khach_hang')->user()->tinh_trang == 0){
                return redirect('/login')->with('error', 'Tài khoản của bạn đã bị khóa!');
            }
            return $next($request);
        }
    }
}
