<?php

namespace App\Domains\Form\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use \Illuminate\Validation\Rule;

class UpdateFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
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
