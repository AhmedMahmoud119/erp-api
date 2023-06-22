<?php

namespace App\Domains\Field\Request;

use App\Domains\Field\Models\EnumFieldTypes;
use App\Domains\Field\Models\EnumSomeRequirements;
use App\Domains\Field\Rules\LangKeysRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFieldRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
//            'title' => [new LangKeysRule],
            'title.en' => ['required'],
            'title.ar' => ['required'],
            'title.*' => ['required'],


            'type' => ['required', Rule::in(array_column(EnumFieldTypes::cases(), 'value'))],
            'some_requirements.*' => [Rule::in(array_column(EnumSomeRequirements::cases(), 'value'))],
           'options.ar' => ['required_if:type,' . EnumFieldTypes::checkbox->value . ',' . EnumFieldTypes::radioButton->value
                . ',' . EnumFieldTypes::rating->value . ',' . EnumFieldTypes::dropdown->value . ',' . EnumFieldTypes::toggleSwitch->value],
            'options.en' => ['required_if:type,' . EnumFieldTypes::checkbox->value . ',' . EnumFieldTypes::radioButton->value
                . ',' . EnumFieldTypes::rating->value . ',' . EnumFieldTypes::dropdown->value . ',' . EnumFieldTypes::toggleSwitch->value],

            'options.*.*' => ['required_if:type,' . EnumFieldTypes::checkbox->value . ',' . EnumFieldTypes::radioButton->value
                . ',' . EnumFieldTypes::rating->value . ',' . EnumFieldTypes::dropdown->value . ',' . EnumFieldTypes::toggleSwitch->value]
        ];
    }

    public function messages()
    {
        return [
            'title.ar.required' => __('The title field is required in arabic'),
            'type.required' => __('The type field is required'),
            'options.required_if' => __('The options field is required'),
        ];
    }
}
