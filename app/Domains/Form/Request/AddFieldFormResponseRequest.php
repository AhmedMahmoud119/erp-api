<?php

namespace App\Domains\Form\Request;

use App\Domains\Form\Rules\CheckFormFields;
use Illuminate\Foundation\Http\FormRequest;

class AddFieldFormResponseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'value' => ['required',new CheckFormFields],
        ];
    }
    public function messages()
    {
        return [
            'value.required' =>  __('messages.The_value_field_is_required'),

        ];
    }
}
