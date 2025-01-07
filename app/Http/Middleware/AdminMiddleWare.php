<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('quan_tri_vien')->user();
        if ($user) {
            if ($user->trang_thai == 1) {
                return $next($request);
            } else {
                return redirect('/admin/login')->with('error', 'Tài khoản của bạn đã bị khóa!');
            }
        } else {
            return redirect('/admin/login')->with('error', 'Vui lòng đăng nhập hệ thống!');
        }
    }
}
