<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChitieuRequest extends FormRequest
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
            'chitieungay'=>'required',
            'giatri'=>'required|numeric|min:10000'
        ];
    }
    public function messages()
    {
        return[
            'chitieungay.required'=>"Tên khoản chi trống!",
            'giatri.required'=>"Giá trị khoản chi không được rỗng!",
            'giatri.min'=>"Giá trị khoản chi phải lớn hơn 1.000",
            'giatri.numeric'=>"Phải là kiểu số!"
        ];
    }
}
