<?php

namespace App\Domains\Currency\Request;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Validation\Rule;

class StoreCurrencyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|regex:/^[a-zA-Z\s]*$/',
            'code' => 'required|unique:currencies|alpha|min:3|max:3',
            'symbol' => 'max:3',
            'price_rate' => ['required', Rule::in(['Custom', 'Official'])],
            'backup_changes' => ['required_if:price_rate,Official', Rule::in(['Custom', '12_pm_every_day', '12_am_every_day', '24_hours_per_day'])],
            'custom_price' => 'required_if:price_rate,Custom|number',
            'from' => 'required_if:backup_changes,Custom',
            'to' => 'required_if:backup_changes,Custom',
            'default' => [ Rule::in(['0', '1'])],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => __('messages.the_name_field_is_required'),
            'name.regex' => __('messages.The_name_must_only_contain_letters'),


        ];

    }
}
