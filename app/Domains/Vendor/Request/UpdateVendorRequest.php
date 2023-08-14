<?php

namespace App\Domains\Vendor\Request;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Validation\Rule;

class UpdateVendorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'              => 'required|regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',
            'contact'           => 'required',
            'email'             => 'required|email',
            'currency_id'       => 'required|exists:currencies,id',
            'address_id'        => 'required',
            'parent_account_id' => 'required|exists:accounts,id',
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
            'modules.*.required' => __('The module is required'),
        ];
    }
}
