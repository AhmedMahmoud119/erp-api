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
            'holder_name' => 'nullable|regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',
//            'account_type' => 'required',
//            'chart_of_account' => 'required',
            'currency_id' => 'nullable|exists:currencies,id',
            'authorized_by.*' => 'nullable|regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',
            'status'=>Rule::in('Active','In-Active'),
            'current_balance'=>'gt:0',


        ];
    }
    public function messages()
    {
        return [
            'name.required' => __('The name field is required'),
            'name.regex' => __('The name must only contain letters'),
            'holder_name.regex' => __('The holder_name must be only contain letters'),
            'authorized_by.*.regex' => __('The authorized_by.* must be only contain letters'),
            'currency_id.exists' => __('The currency_id not exist'),
            'account_number.required' => __('The account_number field is required'),
            'account_number.numeric' => __('The account_number must be a number'),
            'account_number.unique' => __('The account_number has already been taken'),
            'opening_balance.required' => __('The opening_balance field is required'),
            'opening_balance.numeric' => __('The opening_balance must be a number'),
            'status.in' => __('The status is invalid'),

        ];

    }
}
