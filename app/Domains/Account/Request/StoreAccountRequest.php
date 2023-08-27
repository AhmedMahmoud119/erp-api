<?php

namespace App\Domains\Account\Request;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Validation\Rule;

class StoreAccountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'            => 'required',
            'group_id'        => 'required|exists:groups,id',
            'opening_balance' => 'numeric',
            'account_type'    => ['required', Rule::in(['debit', 'credit', 'both'])],
            'parent_id'       => 'nullable|exists:accounts,id',
        ];

    }
    public function messages()
    {
        return [

        ];

    }
}
