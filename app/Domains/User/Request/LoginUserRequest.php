<?php

namespace App\Domains\User\Request;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password' => 'required',
            'email' => 'required',
        ];

    }
    public function messages()
    {
       return [
           'password.required' => __('The password field is required'),
           'email.required' => __('The email field is required'),

        ];

    }
}
