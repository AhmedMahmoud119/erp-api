<?php

namespace App\Domains\PaymentType\Request;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentTypeRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'        => 'required|unique:payment_types,name|regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',
        ];
    }

    public function messages()
    {
        return [
            'name.required'        => __('The name field is required'),
            'name.regex'           => __('The name must only contain letters'),
            'name.unique'           => __('The name field must be unique'),
        ];
    }
}
