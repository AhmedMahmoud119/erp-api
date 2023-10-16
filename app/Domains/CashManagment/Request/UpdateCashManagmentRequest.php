<?php

namespace App\Domains\CashManagment\Request;

use Illuminate\Foundation\Http\FormRequest;
class UpdateCashManagmentRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date' => 'required|date',
            'description' => 'nullable|regex:/^[a-zA-Z0-9گچپژیلفقهكيىموي ء-ي\s\-_]*$/',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required',
            'account_id' => 'required|exists:accounts,id',
            'buyer_id' => 'required|exists:customers,id',
        ];

    }

    public function messages()
    {
        return [
            'amount.required' => __('The amount field is required'),
            'account_id.required' => __('The account field is required'),
            'account_id.exists' => __('The account does not exist.'),
            'buyer_id.exists' => __('The buyer does not exist.'),
            'buyer_id.required' => __('The buyer field is required'),
            'date.required' => __('The date field is required'),
            'description.regex' => __('Description field contains invalid letters'),
        ];

    }

}
