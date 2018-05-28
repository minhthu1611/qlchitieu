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
        $max=date("Y")-16;
        return [
            'email'=>'required|email|unique:user',
            'password'=>'required|regex:/[a-zA-Z0-9]$/|min:5',
            'name'=>'required',
            'namsinh'=>'required|numeric|min:1900|max:'.$max.'',
            'address'=>'required',
            'thunhap'=>'required|numeric|min:10000',
        ];
    }
    public function messages()
    {
        return[
            'email.required'=>'Email trống!',
            'email.email'=>'Email sai cú pháp!',
            'email.unique'=>'Email đã tồn tại!',
            'password.required'=>'Password trống!',
            'password.regex'=>'Password không được sử dụng ký tự đặt biệt!',
            'password.min'=>'Password không được nhỏ hơn 5 ký tự',
            'name.required'=>'Họ tên trống!',
            'namsinh.required'=>'Tuổi không được để trống',
            'namsinh.numeric'=>'Năm sinh phải là số',
            'namsinh.min'=>'Năm sinh không hợp lệ',
            'namsinh.max'=>'Năm sinh không hợp lệ',
            'address.required'=>'Địa chỉ trống!',
            'thunhap.required'=>'Thu nhập trống!',
            'thunhap.numeric'=>'Thu nhập phải là số',
            'thunhap.min'=>'Thu nhập không được nhỏ hơn 10000',
            
        ];
    }
}
