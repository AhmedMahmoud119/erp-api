<?php

namespace App\Domains\User\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use \Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',
            'phone' => ['digits:11','starts_with:010,011,012,015','numeric',Rule::unique('users')->ignore(request()->id)],
            'email' => ['required', 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,3}$/ix', Rule::unique('users')->ignore(request()->id)],
            'status' => ['required', Rule::in(['Disabled', 'Active' , 'Suspended'])],
            'parent_id' => ['nullable','exists:users,id',Rule::notIn([$this->route('id')])],
            'role_id' => 'required|exists:roles,id',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => __('The name field is required'),
            'name.regex' => __('The name must only contain letters'),
            'email.required' => __('The email field is required'),
            'email.email' => __('The email must be a valid email address'),
            'email.unique' => __('The email has already been taken'),
            'phone.required' => __('The phone field is required'),
            'phone.unique' => __('The phone has already been taken'),
            'phone.digits' => __('The phone must be 11 digits'),
            'phone.starts_with' => __('The phone must start with one of the following: 010, 011, 012, 015'),
            'phone.numeric' => __('The phone must be a number'),
            'role_id.required' => __('The role_id field is required'),
            'role_id.exists' => __('The role_id not exist'),
            'parent_id.exists' => __('The parent_id not exist'),
            'parent_id.notIn' => __('The parent_id is invalid'),
            'status.required' => __('The status field is required'),

        ];

    }
}
