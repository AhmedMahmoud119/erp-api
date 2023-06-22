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
            'old_password.required' => __('The old password field is required'),
            'new_password.required' => __('The new password field is required'),
            'new_password.confirmed' => __('The new password confirmation does not match'),

        ];

    }
}
