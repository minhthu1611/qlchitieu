<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DangkyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'=>'required|email|unique:user',
            'pass'=>'required',
            'hoten'=>'required',
            'gt'=>'required',
            'tuoi'=>'required',
            'diachi'=>'required',
            'thunhap'=>'required',
        ];
    }
    public function messages()
    {
        return[
            'email.required'=>'Email trống!',
            'email.email'=>'Email sai cú pháp!',
            'email.unique'=>'Email đã tồn tại!',
            'pass.required'=>'Password trống!',
            'hoten.required'=>'Họ tên trống!',
            'tuoi.required'=>'Tuổi trống',
            'diachi.required'=>'Địa chỉ trống!',
            'thunhap.required'=>'Thu nhập trống!'
        ];
    }
}
