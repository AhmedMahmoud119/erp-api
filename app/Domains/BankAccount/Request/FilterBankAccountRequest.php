<?php

namespace App\Domains\BankAccount\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterBankAccountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'from' => 'date|nullable',
            'to' => 'date|after_or_equal:date_from|nullable',
            'balance_from' => 'numeric|nullable',
            'balance_to' => 'numeric|nullable',
         

        ];
    }
    public function messages()
    {
        return [
            'balance_from.numeric'=>__('the balance  must be number'),
            'balance_to.numeric'=>__('the balance  must be number'),
            'from.date'=>__('the date must be valid date'),
            'to.date'=>__('the date must be valid date'),
            'to.after_or_equal'=>__('the date to must be greater than or equal date from '),
        ];

    }
}
