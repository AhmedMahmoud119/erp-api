<?php

namespace App\Domains\FinancialPeriod\Request;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Validation\Rule;

class StoreFinancialPeriodRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|unique:financial_periods,title',
            'start' => 'required|date|before:end',
            'end' => 'required|date|after:start',
            'status' => 'required|in:open,closed',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => __('messages.the_financial_Year_field_is_required'),
            'start.required' => __('messages.the_financial_Year_Start_field_is_required'),
            'end.required' => __('messages.the_financial_Year_End_field_is_required'),
            'status.required' => __('messages.the_financial_Year_Status_field_is_required'),
        ];
    }
}
