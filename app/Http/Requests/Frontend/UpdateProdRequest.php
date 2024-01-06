<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProdRequest extends FormRequest
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
            'name' => 'required|max:50|min:5',
            'price' => 'required|integer',
            'id_category' => 'required',
            'id_brand' => 'required',
            'company' => 'required',
            'detail' => 'required',
            'files.*' => 'image|mimes:jpeg,png,jpg,gif',
        ]; 
    }
    public function messages()
    {
        return [
            'required'=>'Vui lòng nhập :attribute',
            'max'=>':attribute không được lớn hơn :max kí tự',
            'min'=>':attribute không được nhỏ hơn :min kí tự',              
            'integer' =>':attribute only accepts number',
            'image' => ':attribute: Hình ảnh upload lên phải là hình ảnh',
            'mimes' => ':attribute: Hình ảnh upload lên phải định dạng như sau:jpeg,png,jpg,gif',
        ];
    }
}
