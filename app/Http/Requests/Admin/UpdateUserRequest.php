<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UpdateUserRequest extends FormRequest
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
        $id = Auth::id();

        return [
            'Name'=>'required|max:191',
            'Email' => 'required|email|unique:users,email,'.$id,
            'Password'=>'required|max:25',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    public function attributes() {
        return [
            'Name' => 'Họ tên',
            'Email' => 'Email',
            'Password' => 'Mật khẩu',
            'image' => 'Avatar',
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
            'email.email' => 'Email sai định dạng',
            'unique' => 'Email đã tồn tại',
        ];
    }
}
