<?php

namespace App\Domains\Group\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use \Illuminate\Validation\Rule;

class UpdateGroupRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => __('The name field is required'),
            'name.regex' => __('The name must only contain letters'),

        ];

    }
}
