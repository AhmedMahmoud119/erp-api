<?php

namespace App\Domains\PaymentType\Request;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentTypeRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = request()->id;
        return [
            'name'        => "required|unique:payment_types,name,$id|regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/",
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
