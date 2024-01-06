<?php

namespace App\Http\Requests\api;

use App\Http\Requests\api\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'=>'required|max:191',
            'email' => 'required|email|unique:users',
            'password'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_country'=>'required',
        ];
    }
    public function attributes() {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'phone' => 'Phone',
            'address' => 'Address',
            'id_country' => 'Country',
            'avatar' => 'Avatar',
        ];
    }
    public function messages()
    {
        return [
            'required'=>':attribute: Không được để trống',
            'max'=>':attribute: Không được quá :max ký tự',
            'email.email' => ':attribute: email sai định dạng',
            'email.unique' => ':attribute: email đã tồn tại',
            'avatar' => ':attribute: Hình ảnh upload lên phải là hình ảnh',
            'mimes' => ':attribute: Hình ảnh upload lên phải định dạng như sau:jpeg,png,jpg,gif',
            'avatar.max' => ':attribute: Hình ảnh upload lên vượt quá kích thướcc cho phép :max'
        ];
    }
}
