<?php

namespace App\Domains\GroupType\Request;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Validation\Rule;

class StoreGroupTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type_name' => 'required|regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',
            'code' =>  ['required', 'integer', 'gt:5'],
        ];

    }
    public function messages()
    {
        return [
            'type_name.required' => __('The name field is required'),
            'type_name.regex' => __('The name must only contain letters'),
            'code.required' => __('The code field is required'),
        ];

    }
}
