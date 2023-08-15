<?php

namespace App\Domains\Vendor\Request;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendorRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'              => 'required|regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',
            'contact'           => 'required|digits:11|starts_with:010,011,012,015|numeric',
            'email'             => 'required|email',
            'currency_id'       => 'required|exists:currencies,id',
            'address'           => 'required|max:200',
            'country_id'        => 'required|exists:countries,id',
            'city_id'           => 'required|exists:cities,id',
            'zip_code'          => 'required',
            'parent_account_id' => 'required|exists:accounts,id',

        ];
    }

    public function messages()
    {
        return [
            'name.required'              => __('The name field is required'),
            'name.regex'                 => __('The name must only contain letters'),
            'contact.required'           => __('The contact field is required'),
            'email.required'             => __('The email field is required'),
            'currency_id.required'       => __('The currency field is required'),
            'address_id.required'        => __('The address field is required'),
            'parent_account_id.required' => __('The parent account field is required'),

        ];
    }
}
