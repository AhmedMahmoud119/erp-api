<?php

namespace App\Domains\Account\Request;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Validation\Rule;

class ListAccountRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'sort_column' => [
                'nullable',
                Rule::in(['name', 'code', 'group_id', 'opening_balance', 'account_type', 'parent_id']),
            ],
            'sort_type'   => ['nullable', Rule::in(['desc', 'asc'])],
        ];

    }

    public function messages()
    {
        return [

        ];

    }
}
