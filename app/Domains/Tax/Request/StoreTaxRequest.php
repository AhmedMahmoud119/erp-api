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
            'name.required' => __('The name field is required'),
            'code.required' => __('The name field is required'),
            'percentage.required' => __('The percentage field is required'),
        ];

    }
}
