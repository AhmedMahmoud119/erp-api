<?php

namespace App\Domains\Supplier\Request;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => "required|regex:/^[a-zA-Z0-9ء-ي,\'\-,\s]*$/",
            'email' => 'required|email|max:100',
            'contact' => 'required|min:5|max:20',
            'address' => 'required|min:5|max:100',
            'zip_code'=>'required|min:2|max:50',
            'currency_id' => 'required|exists:currencies,id',
            'city_id' => 'required|exists:cities,id',
            'state_id' => 'required|exists:states,id',
            'country_id' => 'required|exists:countries,id',
            'parent_id' => 'required|numeric|exists:accounts,id',
        ];
    }
    public function messages()
    {
        return [
            'name.regex' => __('The name contins invalid letter'),
            'currency_id.exists' => __('The currency not supported'),
        ];
    }
}
