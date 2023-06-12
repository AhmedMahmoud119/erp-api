<?php

namespace App\Domains\FinancialPeriod\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use \Illuminate\Validation\Rule;

class UpdateFinancialPeriodRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'financial_Year' => 'required',
            'financial_Year_Start' => 'required',
            'financial_Year_End' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'financial_Year.required' => __('messages.the_financial_Year_field_is_required'),
            'financial_Year_Start.required' => __('messages.the_financial_Year_Start_field_is_required'),
            'financial_Year_End.required' => __('messages.the_financial_Year_End_field_is_required'),
        ];

    }
}
