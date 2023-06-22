<?php

namespace App\Domains\Currency\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterCurrencyRequest extends FormRequest
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

        ];
    }
    public function messages()
    {
        return [
            'from.date'=>__('the date must be valid date'),
            'to.date'=>__('the date must be valid date'),
            'to.after_or_equal'=>__('the date to must be greater than or equal date from '),
        ];

    }
}
