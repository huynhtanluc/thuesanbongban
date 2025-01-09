<?php

namespace App\Http\Requests\KhachHang\BaiViet;

use Illuminate\Foundation\Http\FormRequest;

class CreateBaiVietRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ten_bai_viet'  =>  'required|min:3|max:255',
            'noi_dung'      =>  'required|min:3',
            'noi_dung_ngan' =>  'required|min:3',
            'hinh_anh'      =>  'required',
        ];
    }


    public function messages()
    {
        return [
            'ten_bai_viet.required'     => 'Tiêu đề bài viết không được để trống!',
            'ten_bai_viet.max'          => 'Tiêu đề bài viết không được quá 255 ký tự!',

            'noi_dung.required'         => 'Nội dung bài viết không được để trống!',
            
            'noi_dung_ngan.required'    => 'Nội dung ngắn không được để trống!',

            'hinh_anh.required'         => 'Hình ảnh không được để trống!',
        ];
    }
}
