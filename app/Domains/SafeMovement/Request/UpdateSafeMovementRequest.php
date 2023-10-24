<?php

namespace App\Domains\SafeMovement\Request;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSafeMovementRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date' => 'required|date',
            'description' => 'nullable|regex:/^[a-zA-Z0-9گچپژیلفقهكيىموي ء-ي\s\-_]*$/',
            'amount' => 'required|numeric|min:0',
            'source_id' => 'required|exists:accounts,id',
            'destination_id' => 'required|exists:accounts,id',
            'assets_involved' => 'nullable|string',
        ];

    }

    public function messages()
    {
        return [
            'amount.required' => __('The amount field is required'),
            'destination_id.required' => __('The destination safe field is required'),
            'destination_id.exists' => __('The destination safe does not exist.'),
            'source_id.exists' => __('The source safe does not exist.'),
            'source_id.required' => __('The source safe field is required'),
            'date.required' => __('The date field is required'),
            'description.regex' => __('Description field contains invalid letters'),
        ];

    }
}
