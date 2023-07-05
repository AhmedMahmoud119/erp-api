<?php

namespace App\Domains\GroupType\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use \Illuminate\Validation\Rule;

class UpdateGroupTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'name' => 'required|regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',
            'group_type_id' => 'required|exists:group_types,id',
            'parent'=>['required',Rule::in(0,1)],



        ];
    }
    public function messages()
    {
        return [
            'name.required' => __('The name field is required'),
            'name.regex' => __('The name must only contain letters'),
            'group_type_id.required' => __('The group_type_id field is required'),
            'group_type_id.exists' => __('The group_type_id not exist'),
            'parent.required' => __('The parent field is required'),
            'parent.role' => __('The parent must be 0 or 1 only'),
        ];

    }
}
