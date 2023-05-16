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
           'password.required' => __('messages.The_password_field_is_required'),
           'email.required' => __('messages.The_email_field_is_required'),

        ];

    }
}
