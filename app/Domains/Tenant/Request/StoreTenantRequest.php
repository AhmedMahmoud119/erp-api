<?php

namespace App\Domains\Tenant\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTenantRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',
            'domain' => 'required|unique:domains',
            'phone' => 'required|unique:tenants|digits:11|starts_with:010,011,012,015|numeric',
            'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,3}$/ix|unique:tenants',
            'status' => ['required', Rule::in(['Disabled', 'Active' , 'Suspended'])],
            'industry_type' => ['required', Rule::in(['Schools', 'ERP System' , 'Health', 'Retail'])],

            'assigned_id' => 'required|exists:users,id',
        ];
    }
    public function messages()
    {
        return [



            'name.required' => __('The name field is required'),
            'name.regex' => __('The name must only contain letters'),
            'domain.required' => __('The domain field is required'),
            'domain.unique' => __('The domain has already been taken'),
            'email.required' => __('The email field is required'),
            'email.email' => __('The email must be a valid email address'),
            'email.unique' => __('The email has already been taken'),
            'phone.required' => __('The phone field is required'),
            'phone.unique' => __('The phone has already been taken'),
            'phone.digits' => __('The phone must be 11 digits'),
            'phone.starts_with' => __('The phone must start with one of the following: 010, 011, 012, 015'),
            'phone.numeric' => __('The phone must be a number'),
            'assigned_id.required' => __('The assigned id field is required'),
            'assigned_id.exist' => __('The assigned id not exist'),
            'industry_type.required' => __('The industry_type field is required'),


        ];

    }
}
