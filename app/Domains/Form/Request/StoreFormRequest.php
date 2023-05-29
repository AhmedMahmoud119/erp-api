<?php

namespace App\Domains\Form\Request;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title.ar' => 'required',
            'title.en' => 'required',
            'module_id' => 'required|exists:modules,id',
            'module_id.*' => 'required|exists:modules,id'
        ];
    }
    public function messages()
    {
        return [
            'title.required' =>  __('messages.The_title_field_is_required'),
            'module_id.required' =>  __('messages.The_module_id_field_is_required'),
            'module_id.exist' =>  __('messages.The_module_id_field_is_not_exist'),
            'module_id.*.required' =>  __('messages.The_module_id_field_is_required'),
            'module_id.*.exist' =>  __('messages.The_module_id_field_is_not_exist'),

        ];

    }
}
