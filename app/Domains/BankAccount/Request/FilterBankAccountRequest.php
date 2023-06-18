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
            'balance_from' => 'date|nullable',
            'balance_to' => 'date|after_or_equal:date_from|nullable',

        ];
    }
    public function messages()
    {
        return [
            'balance_from.date'=>__('the date must be valid date'),
            'balance_to.date'=>__('the date must be valid date'),
            'balance_to.after_or_equal'=>__('the date to must be greater than or equal date from '),
            'from.date'=>__('the date must be valid date'),
            'to.date'=>__('the date must be valid date'),
            'to.after_or_equal'=>__('the date to must be greater than or equal date from '),
        ];

    }
}
