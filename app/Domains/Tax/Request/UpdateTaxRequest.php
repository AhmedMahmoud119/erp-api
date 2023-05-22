<?php

namespace App\Domains\Tax\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use \Illuminate\Validation\Rule;

class UpdateTaxRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'name' => 'required',
            'code' => 'required',
            'percentage' => 'required|numeric',
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
