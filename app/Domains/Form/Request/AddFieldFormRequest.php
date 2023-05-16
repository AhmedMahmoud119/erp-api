<?php

namespace App\Domains\Form\Request;

use Illuminate\Foundation\Http\FormRequest;

class AddFieldFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'field_id' => 'required|exists:fields,id',
        ];
    }
    public function messages()
    {
        return [
            'field_id.required' =>  __('messages.The_field_id_field_is_required'),
            'field_id.exists' =>  __('messages.The_field_id_not_exist'),



        ];
    }
}
