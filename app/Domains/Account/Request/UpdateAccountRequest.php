<?php

namespace App\Domains\Account\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use \Illuminate\Validation\Rule;

class UpdateAccountRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'name'            => 'required',
            'group_id'        => 'required|exists:groups,id',
            'opening_balance' => 'numeric',
            'account_type'    => ['required', Rule::in(['debit', 'credit', 'both'])],
            'parent_id'       => 'nullable|exists:accounts,id',
            'is_parent'       => ['nullable', Rule::in([0,1])],
            'icon'            => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required'            => 'Account name is required',
            'group_id.required'        => 'Account group is required',
            'group_id.exists'          => 'Account group is invalid',
            'opening_balance.numeric'  => 'Opening balance must be a number',
            'account_type.required'    => 'Account type is required',
            'account_type.in'          => 'Account type is invalid',
            'parent_id.exists'         => 'Parent account is invalid',
            'is_parent.in'             => 'Invalid Parent format',
        ];
    }
}
