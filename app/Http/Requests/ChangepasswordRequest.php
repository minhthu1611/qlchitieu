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
            'now_password'=>'required|min:5|regex:/[a-zA-Z0-9]$/',
            'password'=>'required|min:5|regex:/[a-zA-Z0-9]$/|confirmed',
            'password_confirmation'=>'required'
        ];
    }
    public function messages()
    {
        return [
            
        ];
    }
}
