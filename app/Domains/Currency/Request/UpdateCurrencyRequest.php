<?php

namespace App\Domains\Currency\Request;

use App\Domains\Currency\Models\EnumCurrencies;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use \Illuminate\Validation\Rule;

class UpdateCurrencyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'name' => 'required|regex:/^[a-zA-Z\s]*$/',
            'code' => ['required','alpha','min:3','max:3',Rule::unique('currencies')->ignore(request()->id),Rule::in(array_column(EnumCurrencies::cases(), 'value'))],
            'symbol' => ['max:3',Rule::unique('currencies')->ignore(request()->id)],
            'price_rate' => ['required', Rule::in(['Custom', 'Official'])],
            'backup_changes' => ['required_if:price_rate,Official', Rule::in(['Custom', '12_pm_every_day', '12_am_every_day', '24_hours_per_day'])],
            'price' => 'required_if:price_rate,Custom',
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
