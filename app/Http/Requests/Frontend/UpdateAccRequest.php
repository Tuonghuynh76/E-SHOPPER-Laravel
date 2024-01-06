<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UpdateAccRequest extends FormRequest
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
        $id = Auth::id();
        return [
            'name'=>'required|max:191',
            'password'=>'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'address'=>'required',
            'id_country'=>'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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
