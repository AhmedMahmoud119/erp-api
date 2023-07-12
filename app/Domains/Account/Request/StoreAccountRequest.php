<?php

namespace App\Domains\Account\Request;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Validation\Rule;

class StoreAccountRequest extends FormRequest
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
