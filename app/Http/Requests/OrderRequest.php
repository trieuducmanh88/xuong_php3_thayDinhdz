<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'ten_nguoi_nhan'=>'required|string|max:255',
            'sdt_nguoi_nhan'=>'required|string|regex:/^[0-9-]{10,13}$/i|min:10',
            'email_nguoi_nhan'=>'required|string|email|max:255',
            'dia_chi_nguoi_nhan'=>'required|string|max:255',
        ];
    }

    public function messages(){
           return [
                'ten_nguoi_nhan.required'=>'Tên người nhận là bắt buộc',
                'ten_nguoi_nhan.string'=>'Tên người nhận phải là kiểu ký tự',
                'ten_nguoi_nhan.max'=>'Tên người nhận không quá 255 ký tự',

                'sdt_nguoi_nhan.required'=>'Số điện thoại người nhận là bắt buộc',
                'sdt_nguoi_nhan.string'=>'Số điện thoại người phải là kiểu ký tự',
                'sdt_nguoi_nhan.regex'=>'Số điện thoại người nhận không đúng định dạng',
                'sdt_nguoi_nhan.min'=>'Số điện thoại người nhận phải đúng ',

                'email_nguoi_nhan.required'=>'Email người nhận là bắt buộc',
                'email_nguoi_nhan.string'=>'Email người nhận phải là kiểu ký tự',
                'email_nguoi_nhan.email'=>'Email người nhận phải là địa chỉ email hợp lệ',
                'email_nguoi_nhan.max'=>'Email người nhận không vượt quá 255 ký tự',

                'dia_chi_nguoi_nhan.required'=>'Địa chỉ người nhận là bắt buộc',
                'dia_chi_nguoi_nhan.string'=>'Địa chỉ người nhận phải là kiểu ký tự',
                'dia_chi_nguoi_nhan.max'=>'Địa chỉ người nhận vượt quá 255 ký tự',
           ];
    }
}
