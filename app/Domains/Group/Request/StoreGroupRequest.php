<?php

namespace App\Domains\Group\Request;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Validation\Rule;

class StoreGroupRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',
            'group_type_id' => 'required|exists:group_types,id',
        ];

    }
    public function messages()
    {
        return [
            'name.required' => __('The name field is required'),
            'name.regex' => __('The name must only contain letters'),
            'group_type_id.required' => __('The group_type_id field is required'),
            'group_type_id.exists' => __('The group_type_id not exist'),

        ];

    }
}
