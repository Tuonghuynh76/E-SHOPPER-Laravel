<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'password'=>'required',
            'email' => 'required|email|unique:users',
            'address'=>'required',
            'phone'=>'required',
        ];
    }
    public function attributes() {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'phone' => 'Phone',
            'address' => 'Address',
        ];
    }
    public function messages()
    {
        return [
            'required'=>':attribute: Không được để trống',
            'max'=>':attribute: Không được quá :max ký tự',
            'email.email' => ':attribute: email sai định dạng',
            'email.unique' => ':attribute: email đã tồn tại',
        ];
    }
}
