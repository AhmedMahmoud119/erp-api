<?php

namespace App\Domains\Product\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

           ];
    }

    public function messages()
    {
        return [

        ];
    }
}
