<?php

namespace App\Domains\BankAccount\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use \Illuminate\Validation\Rule;

class UpdateBankAccountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'name' => 'required|regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',
            'account_number' => ['required',Rule::unique('bank_accounts')->ignore(request()->id)],
            'holder_name' => 'regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',
//            'account_type' => 'required',
//            'chart_of_account' => 'required',
            'currency_id' => 'exists:currencies,id',
            'opening_balance' => 'required|numeric',
            'authorized_by.*' => 'regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',


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
