<?php

namespace App\Domains\Form\Request;

use Illuminate\Foundation\Http\FormRequest;

class HideFieldFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'hidden' => 'required|integer|between:0,1',
        ];
    }

    public function messages()
    {
        return [
            'hidden.required' =>  __('messages.The_hidden_field_is_required'),
            'hidden.integer' =>  __('messages.The_hidden_not_field_must_be_real_number'),
            'hidden.between' =>  __('messages.The_hidden_not_field_must_be_0_or_1'),

        ];
    }
}
