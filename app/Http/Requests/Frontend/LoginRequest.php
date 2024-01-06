<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ];
    }
   public function attributes() {
        return [
            'email' => 'Email',
            'password' => 'Password',
        ];
    }
    public function messages()
    {
        return [
            'required'=>':attribute Không được để trống',
            'email.email' => ':attribute sai định dạng ',
            'email.unique' => ':attribute: email đã tồn tại'
        ];
    }
}
