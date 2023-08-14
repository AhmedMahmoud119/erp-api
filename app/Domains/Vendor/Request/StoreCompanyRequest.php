<?php

namespace App\Domains\Company\Request;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Validation\Rule;

class StoreCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',
            'status' => ['required', Rule::in(['In-Active', 'Active'])],
            'tenant_id' => 'nullable|exists:tenants,id',
            'user_id' => 'nullable|exists:users,id',
            'modules' => 'nullable|array',
            'modules.*' => 'exists:modules,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('The name field is required'),
            'name.regex' => __('The name must only contain letters'),
            'status.required' => __('The status field is required'),
            'status.in' => __('The status is invalid'),
            'tenant_id.exists' => __('The tenant not exist'),
            'user_id.exists' => __('The user not exist'),
            'modules.*.exists' => __('The module not exist'),

        ];
    }
}
