<?php

namespace App\Domains\Role\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'name' => ['string', 'nullable','regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/', Rule::unique('roles')->ignore(request()->id)],
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ];
    }
    public function messages()
    {
        return [
            'name.regex' => __('messages.The_name_must_only_contain_letters'),
            'permissions.required' => __('messages.The_permissions_is_required'),
            'permissions.array' => __('messages.The_permissions_must_be_of_type_array'),
            'permissions.*.exists' => __('messages.The_permissions_not_exist'),

        ];
    }
}
