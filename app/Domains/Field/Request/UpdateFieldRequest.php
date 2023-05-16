<?php

namespace App\Domains\Field\Request;

use App\Domains\Field\Models\EnumFieldTypes;
use App\Domains\Field\Models\EnumSomeRequirements;
use App\Domains\Field\Rules\LangKeysRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use \Illuminate\Validation\Rule;

class UpdateFieldRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'title' => ['required',new LangKeysRule],
            'title.*' => ['required'],

            'type' => ['required', Rule::in(array_column(EnumFieldTypes::cases(), 'value'))],
            'some_requirements.*' => [Rule::in(array_column(EnumSomeRequirements::cases(), 'value'))],
            'options' => ['required_if:type,' . EnumFieldTypes::checkbox->value . ',' . EnumFieldTypes::radioButton->value
                . ',' . EnumFieldTypes::rating->value . ',' . EnumFieldTypes::dropdown->value . ',' . EnumFieldTypes::toggleSwitch->value
                ,new LangKeysRule],


        ];

    }
    public function messages()
    {
        return [
            'title.required' => __('messages.The_title_field_is_required'),
            'type.required' => __('messages.The_type_field_is_required'),
            'options.required_if' => __('messages.The_options_field_is_required'),


        ];
    }
}
