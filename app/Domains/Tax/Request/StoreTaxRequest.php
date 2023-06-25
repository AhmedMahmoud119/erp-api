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
            'code' => 'required',
            'percentage' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
<<<<<<< HEAD
            'name.required' => __('The name field is required'),
            'code.required' => __('The name field is required'),
            'percentage.required' => __('The percentage field is required'),
=======
            'name.required' => __('messages.the_name_field_is_required'),
            'percentage.required' => __('messages.The_percentage_field_is_required'),

>>>>>>> 416ac7afb2d28b0c7085e26392777507d2a40a6e
        ];

    }
}