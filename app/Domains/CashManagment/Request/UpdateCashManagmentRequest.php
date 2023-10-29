<?php

namespace App\Domains\CashManagment\Request;


use App\Domains\Account\Models\Account;
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
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required',
            'account_id' => 'required_with:cashable_id|nullable||exists:accounts,id',
            'cashable_id' => 'required_with:account_id|nullable|exists:accounts,id',

        ];

    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (isset($this->cashable_id)) {
                $result = false;
                $result = Account::where([
                    ['parent_id', $this->account_id],
                    ['id', $this->cashable_id]
                ])->exists();
            }
            if (!$result) {
                $validator->errors()->add('cashable_id', __('Cash Account does not belongs to the parent, Please select the right one.'));
                return;
            }
        });
    }

    public function messages()
    {
        return [
            // 'description.string' => __('Description field contains invalid letters'),
            // 'amount.required' => __('The amount field is required'),
            // 'date.required' => __('The date field is required'),
            // 'account_id.required_with' => __('Please select  account'),
            // 'account_id.exists' => __('The Account does not exist.'),
            // 'cashable_id.exists' => __('The Cash Account does not exist.'),
            // 'cashable_id.required_with' => __('Please select cash account.'),
        ];
    }

}
