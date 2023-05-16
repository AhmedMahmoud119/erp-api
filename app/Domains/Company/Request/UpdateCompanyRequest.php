<?php

namespace App\Domains\Company\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use \Illuminate\Validation\Rule;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'name' => 'required|regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',
            'status' => ['required', Rule::in(['In-Active', 'Active'])],
            'tenant_id' => 'nullable|exists:tenants,id',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => __('messages.the_name_field_is_required'),
            'name.regex' => __('messages.The_name_must_only_contain_letters'),
            'status.required' => __('messages.The_status_field_is_required'),
            'tenant_id.exists' => __('messages.The_tenant_not_exist'),


        ];

    }
}
