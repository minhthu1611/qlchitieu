<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KhoanchiRequest extends FormRequest
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
            'tenkhoanchi'=>'required',
            'sotien'=>'required|numeric|min:10000'
        ];
    }
    public function messages()
    {
        return[
            'tenkhoanchi.required'=>"Tên khoản chi trống!",
            'sotien.required'=>"Giá trị khoản chi không được rỗng!",
            'sotien.min'=>"Giá trị khoản chi phải lớn hơn 1.000",
            'sotien.numeric'=>"Phải là kiểu số!"
        ];
    }
}
