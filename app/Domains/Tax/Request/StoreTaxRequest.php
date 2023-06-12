<?php

namespace App\Domains\Tax\Request;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Validation\Rule;

class StoreTaxRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'code' => 'required|unique:taxes',
            'percentage' => 'required|numeric',
            'modules.*' => 'nullable|exists:modules,id',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => __('messages.the_name_field_is_required'),
            'code.required' => __('messages.The_code_field_is_required'),
            'percentage.required' => __('messages.The_percentage_field_is_required'),
        ];

    }
}
