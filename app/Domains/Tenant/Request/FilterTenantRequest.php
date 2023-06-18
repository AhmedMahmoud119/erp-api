<?php

namespace App\Domains\Tenant\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterTenantRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date_from' => 'date|nullable',
            'date_to' => 'date|after_or_equal:date_from|nullable',

        ];
    }
    public function messages()
    {
        return [

            'date_from.date'=>__('the date must be valid date'),
            'date_to.date'=>__('the date must be valid date'),
            'date_to.after_or_equal'=>__('the date to must be greater than or equal date from '),

        ];

    }
}
