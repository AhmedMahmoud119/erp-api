<?php

namespace App\Domains\Language\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateLanguageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'key' => 'required',
            'value_ar' => 'required',
            'value_en' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'key.required' => 'required',
            'value_ar.required' => 'required',
            'value_en.required' => 'required',
        ];
    }
}
