<?php

namespace App\Http\Requests\Admin\KhachHang;

use Illuminate\Foundation\Http\FormRequest;

class CreateKhachHangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ho_va_ten'     => 'required|string|min:5|max:100',
            'email'         => 'required|email|unique:khach_hangs,email',
            'so_dien_thoai' => 'required|numeric|digits:10|unique:khach_hangs,so_dien_thoai',
            'ngay_sinh'     => 'required|date|before:today',
            'gioi_tinh'     => 'required|numeric|in:0,1',
            'chung_minh_thu'=> 'required|numeric|digits_between:9,12|unique:khach_hangs,chung_minh_thu',
            'anh'           => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'ho_va_ten.required'      => 'Họ và tên không được để trống',
            'ho_va_ten.min'           => 'Họ và tên phải từ 5 ký tự trở lên',
            'ho_va_ten.max'           => 'Họ và tên không được quá 100 ký tự',

            'email.required'          => 'Email không được để trống',
            'email.email'             => 'Email không đúng định dạng',
            'email.unique'            => 'Email đã tồn tại trong hệ thống',

            'so_dien_thoai.required'  => 'Số điện thoại không được để trống',
            'so_dien_thoai.numeric'   => 'Số điện thoại phải là số',
            'so_dien_thoai.digits'    => 'Số điện thoại phải đủ 10 số',
            'so_dien_thoai.unique'    => 'Số điện thoại đã tồn tại trong hệ thống',

            'ngay_sinh.required'      => 'Ngày sinh không được để trống',
            'ngay_sinh.date'          => 'Ngày sinh không đúng định dạng',
            'ngay_sinh.before'        => 'Ngày sinh phải nhỏ hơn ngày hiện tại',

            'gioi_tinh.required'      => 'Giới tính không được để trống',
            'gioi_tinh.numeric'       => 'Giới tính phải là số',
            'gioi_tinh.in'            => 'Giới tính không hợp lệ',

            'chung_minh_thu.required' => 'Chứng minh thư không được để trống',
            'chung_minh_thu.numeric'  => 'Chứng minh thư phải là số',
            'chung_minh_thu.digits_between' => 'Chứng minh thư phải từ 9 đến 12 số',
            'chung_minh_thu.unique'   => 'Chứng minh thư đã tồn tại trong hệ thống',

            'anh.image'               => 'File phải là hình ảnh',
            'anh.mimes'               => 'Định dạng hình ảnh phải là jpg, png, jpeg',
            'anh.max'                 => 'Kích thước hình ảnh không được quá 2MB'
        ];
    }
}
