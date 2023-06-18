<?php

namespace App\Domains\BankAccount\Request;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Validation\Rule;

class StoreBankAccountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|regex:'.config('key.regex'),
            'account_number' =>'required|unique:bank_accounts|numeric',
            'holder_name' => 'regex:'.config('key.regex'),
//            'account_type' => 'required',
//            'chart_of_account' => 'required',
            'currency_id' => 'exists:currencies,id',
            'opening_balance' => 'required|numeric',
            'authorized_by.*' => 'regex:'.config('key.regex'),

        ];

    }
    public function messages()
    {
        return [
            'name.required' => __('messages.the_name_field_is_required'),
            'name.regex' => __('messages.The_name_must_only_contain_letters'),


        ];

    }
}
