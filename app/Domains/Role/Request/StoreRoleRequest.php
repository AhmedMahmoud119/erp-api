<?php

namespace App\Domains\Role\Request;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:roles|regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => __('messages.the_name_field_is_required'),
            'name.regex' => __('messages.The_name_must_only_contain_letters'),
            'name.unique' => __('messages.The_name_has_already_been_taken'),
            'permissions.required' => __('messages.The_permissions_is_required'),
            'permissions.array' => __('messages.The_permissions_must_be_of_type_array'),
            'permissions.*.exists' => __('messages.The_permissions_not_exist'),



        ];
    }
}
