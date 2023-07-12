<?php

namespace App\Domains\Account\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use \Illuminate\Validation\Rule;

class UpdateAccountRequest extends FormRequest
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
