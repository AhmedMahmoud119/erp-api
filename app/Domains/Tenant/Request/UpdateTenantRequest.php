<?php

namespace App\Domains\Tenant\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use \Illuminate\Validation\Rule;

class UpdateTenantRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'name' => 'required|regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',
            'phone' => ['digits:11','starts_with:010,011,012,015','numeric',Rule::unique('tenants')->ignore(request()->id)],
            'email' => ['required', 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', Rule::unique('tenants')->ignore(request()->id)],
            'status' => ['required', Rule::in(['Disabled', 'Active' , 'Suspended'])],
            'domain' => ['required',Rule::unique('domains','domain')->ignore(request()->id,'tenant_id')],
            'assigned_id' => 'required|exists:users,id',

        ];

    }
    public function messages()
    {
        return [
            'name.required' => __('messages.the_name_field_is_required'),
            'name.regex' => __('messages.The_name_must_only_contain_letters'),
            'domain.required' => __('messages.The_domain_field_is_required'),
            'domain.unique' => __('messages.The_domain_has_already_been_taken'),
            'email.required' => __('messages.The_email_field_is_required'),
            'email.email' => __('messages.The_email_must_be_a_valid_email_address'),
            'email.unique' => __('messages.The_email_has_already_been_taken'),
            'phone.required' => __('messages.The_phone_field_is_required'),
            'phone.unique' => __('messages.The_phone_has_already_been_taken'),
            'phone.digits' => __('messages.The_phone_must_be_11_digits'),
            'phone.starts_with' => __('messages.The_phone_must_start_with_one_of_the_following:_010_011_012_015'),
            'phone.numeric' => __('messages.The_phone_must_be_a_number'),
            'assigned_id.required' => __('messages.The_assigned_id_field_is_required'),
            'assigned_id.exist' => __('messages.The_assigned_id_not_exist'),


        ];

    }
}
