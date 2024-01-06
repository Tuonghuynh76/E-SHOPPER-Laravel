<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddCountryRequest extends FormRequest
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
            'name'=>'required|max:30',
        ];
    }
     public function attributes()
    {
        return [
            'name' => 'Country',
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

