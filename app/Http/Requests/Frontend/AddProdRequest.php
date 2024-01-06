<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class AddProdRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50|min:5',
            'price' => 'required',
            'id_category' => 'required',
            'id_brand' => 'required',
            'company' => 'required|max:20',
            'detail' => 'required',
            'files' => 'required|size:3',
            'files.*' => 'image|mimes:jpeg,png,jpg,gif',
        ]; 
    }
         public function attributes()
    {
        return [
            'files' => 'File',
        ];
    }
    public function messages()
    {
        return [
            'required'=>'Vui lòng nhập :attribute',
            'id_category.required' => 'Vui lòng chọn category',
            'id_brand.required' => 'Vui lòng chọn brand',
            'max'=>':attribute không được lớn hơn :max kí tự',
            'min'=>':attribute không được nhỏ hơn :min kí tự',       
            'files.size' => ':attribute không được lớn hơn :size',     
            'image' => ':attribute: Hình ảnh upload lên phải là hình ảnh',
            'mimes' => ':attribute: Hình ảnh upload lên phải định dạng như sau:jpeg,png,jpg,gif',
        ];
    }
}
