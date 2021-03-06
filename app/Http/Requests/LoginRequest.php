<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'username'=>'required',
            'pass'=>'required'
        ];
    }
    public function messages()
    {
        return[
            'username.required'=>'Email không được để trống!',
            'pass.required'=>'Password không được để trống!',
        ];
    }
}
