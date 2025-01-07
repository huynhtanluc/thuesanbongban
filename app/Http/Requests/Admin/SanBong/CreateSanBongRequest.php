<?php

namespace App\Http\Requests\Admin\SanBong;

use Illuminate\Foundation\Http\FormRequest;

class CreateSanBongRequest extends FormRequest
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
            'ten_san'       => 'required|string|min:5|max:100',
            'dien_tich'     => 'required|numeric|min:1',
            'gia_dau_thau'  => 'required|numeric|min:1000',
            'phan_tram_coc' => 'required|numeric|min:1|max:100',
            'id_khu_vuc'    => 'required|exists:khu_vucs,id',
            'id_chu_san'    => 'required|exists:chu_sans,id'
        ];
    }

    public function messages()
    {
        return [
            'ten_san.required'      => 'Tên sân không được để trống',
            'ten_san.min'           => 'Tên sân phải từ 5 ký tự trở lên',
            'ten_san.max'           => 'Tên sân không được quá 100 ký tự',

            'dien_tich.required'    => 'Diện tích không được để trống',
            'dien_tich.numeric'     => 'Diện tích phải là số',
            'dien_tich.min'         => 'Diện tích phải lớn hơn 0',

            'gia_dau_thau.required' => 'Giá đấu thầu không được để trống',
            'gia_dau_thau.numeric'  => 'Giá đấu thầu phải là số',
            'gia_dau_thau.min'      => 'Giá đấu thầu phải từ 1.000đ trở lên',

            'phan_tram_coc.required'=> 'Phần trăm cọc không được để trống',
            'phan_tram_coc.numeric' => 'Phần trăm cọc phải là số',
            'phan_tram_coc.min'     => 'Phần trăm cọc phải từ 1% trở lên',
            'phan_tram_coc.max'     => 'Phần trăm cọc không được quá 100%',

            'id_khu_vuc.required'   => 'Loại Sân không được để trống',
            'id_khu_vuc.exists'     => 'Loại Sân không tồn tại',

            'id_chu_san.required'   => 'Chủ sân không được để trống',
            'id_chu_san.exists'     => 'Chủ sân không tồn tại'
        ];
    }
}
