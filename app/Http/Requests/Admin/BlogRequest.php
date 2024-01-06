<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title'=>'required|max:191',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description'=>'required',            
            'content'=>'required',            
        ];
    }
    public function attributes() {
        return [
            'title' => 'Title',
            'image' => 'Image',
            'description' => 'Description',
            'content' => 'Content',
        ];
    }
    public function messages()
    {
        return [
            'required'=>':attribute không được để trống',
            'max'=>':attribute không được quá :max ký tự',  
            'image.image' => ':attribute phải là hình ảnh',
            'mimes' => ':attribute phải định dạng như sau:jpeg,png,jpg,gif',
            'image.max' => ':attribute maximum file size to upload :max',
        ];
    }
}
