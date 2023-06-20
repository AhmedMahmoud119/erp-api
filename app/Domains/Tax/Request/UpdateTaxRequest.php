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
            'code' => ['required',Rule::unique('taxes')->ignore(request()->id)],
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
