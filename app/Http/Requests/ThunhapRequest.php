<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThunhapRequest extends FormRequest
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
            'tenthunhap'=>'required',
            'giatri'=>'required|numeric|min:10000'
        ];
    }
    public function messages()
    {
        return[
            'tenthunhap.required'=>"Tên thu nhập trống!",
            'giatri.required'=>"Giá trị thu nhập không được rỗng!",
            'giatri.min'=>"Giá trị khoản chi phải lớn hơn 1.000",
            'giatri.numeric'=>"Phải là kiểu số!"
        ];
    }
}
