<?php

namespace App\Domains\Supplier\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use \Illuminate\Validation\Rule;

class UpdateSupplierRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => "required|regex:/^[a-zA-Z0-9ء-ي,\'\-,\s]*$/",// for all punctuation \p{P}
            'email'=>'required|email|max:100',
            'contact'=>'required|min:5|max:20',
            'address'=>'min:5|max:100',
            'currency_id' => 'nullable|exists:currencies,id',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => __('The name field is required'),
            'name.regex' => __('The name contins invalid letter'),
            'email.required' => __('The email field is required'),
            'currency_id.exists' => __('The currency not exist'),
            'contact.required' => __('The contact field is required'),
        ];
    }
}
