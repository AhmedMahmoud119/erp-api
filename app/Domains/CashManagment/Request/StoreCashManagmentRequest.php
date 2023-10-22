<?php

namespace App\Domains\CashManagment\Request;

use App\Domains\Customer\Models\Customer;
use App\Domains\Supplier\Models\Supplier;
use Illuminate\Foundation\Http\FormRequest;

class StoreCashManagmentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'date' => 'required|date',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required',
            'account_id' => 'required|exists:accounts,id',
            'cashable_id' => 'required_with:cashable|nullable|integer',
            'cashable' => 'nullable|string',

        ];

    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (isset($this->cashable_id)) {
                $result = false;
                if (strtolower($this->cashable) == 'customer') {
                    $result = Customer::where('id', $this->cashable_id)->exists();
                } elseif (strtolower($this->cashable) == strtolower('supplier')) {
                    $result = Supplier::where('id', $this->cashable_id)->exists();
                }
                if (!$result) {
                    $validator->errors()->add('cashable_id', 'The cashable does not exists.');
                    return;
                }
            }
        });
    }

    public function messages()
    {
        return [
            'description.regex' => __('Description field contains invalid letters'),
            'amount.required' => __('The amount field is required'),
            'date.required' => __('The date field is required'),
            'account_id.required' => __('please select  account'),
            'account_id.exists' => __('The account does not exist.'),
            'cashable_id.required_with' => __('please select cashe account.'),
        ];
    }
}
