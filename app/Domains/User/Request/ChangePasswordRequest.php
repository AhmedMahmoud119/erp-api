<?php

namespace App\Domains\User\Request;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ];
    }
    public function messages()
    {
        return [
            'old_password.required' => __('messages.The old_password field is required'),
            'new_password.required' => __('messages.The_new_password_field_is_required'),
            'new_password.confirmed' => __('messages.The_new_password_confirmation_does_not_match'),

        ];

    }
}
