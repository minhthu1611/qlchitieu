<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangepasswordRequest extends FormRequest
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
            'now_password'=>'required|regex:/[a-zA-Z0-9]$/',
            'password'=>'required|min:5|regex:/[a-zA-Z0-9]$/|confirmed',
            'password_confirmation'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'now_password.required'=>'Mật khẩu cũ không được để trống!',
            'now_password.regex'=>'Mật khẩu cũ không được chứa ký tự đặt biệt!',
            'password.required'=>'Mật khẩu mới không được để trống!',
            'password.regex'=>'Mật khẩu mới không được chứa ký tự đặt biệt!',
            'password.min'=>'Mật khẩu mới không được nhỏ hơn 5 ký tự!',
            'password_confirmation.required'=>'Xác nhận lại mật khẩu mới không được để trống!'
        ];
    }
}
