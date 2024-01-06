<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            'brand'=>'required|max:30',
        ];
    }
     public function attributes()
    {
        return [
            'brand' => 'Brand',
        ];
    }
    public function messages()
    {
        return [
            'required'=>':attribute không được để trống',
            'max'=>':attribute không được quá :max ký tự',
        ];
    }
}

