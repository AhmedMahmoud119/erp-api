<?php

namespace App\Domains\JournalEntry\Request;

use App\Domains\Tax\Models\Tax;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use \Illuminate\Validation\Rule;

class UpdateJournalEntryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'entry_no' => ['required', 'numeric'],
            'date' => ['required', 'date'],
            'description' => ['required', 'string'],
            'details' => ['required', 'array'],
            'details.*.account_id' => ['required', 'exists:accounts,id'],
            'details.*.debit' => ['required_without:accounts.*.credit', 'numeric'],
            'details.*.credit' => ['required_without:accounts.*.debit', 'numeric'],
            'details.*.description' => ['nullable', 'string', 'max:255'],
            'details.*.tax_id' => ['nullable', 'exists:taxes,id'],
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $details = collect($this->details)->map(
                fn ($detail) =>
                [
                    'account_id' => $detail['account_id'],
                    'debit' => $detail['debit'],
                    'credit' => $detail['credit'],
                    'tax_id' => $detail['tax_id'] ?? null,
                ]
            )->toArray();
            
            $unique = collect($details)->unique('account_id');
            if ($unique->count() != count($details)) {
                $validator->errors()->add('details', __('validation.unique'));
            }
            $details = collect($details)->map(function ($account) {
                $tax = Tax::find($account['tax_id']);
                if ($tax) {
                    $account['debit'] = $account['debit'] + ($account['debit'] * $tax->percentage) / 100;
                    $account['credit'] = $account['credit'] + ($account['credit'] * $tax->percentage) / 100;
                }
                return $account;
            });
            $debit = $details->sum('debit');
            $credit = $details->sum('credit');
            if ($debit != $credit) {
                $validator->errors()->add('details', __('validation.not_equal'));
            }
        });
    }
    public function messages()
    {
        return [
            'title' => __('validation.required'),
            'entry_no' => __('validation.required'),
            'date' => __('validation.required'),
            'description' => __('validation.required'),
            'details.required' => __('validation.required'),
            'details.*.account_id.required' => __('validation.required'),
            'details.*.account_id.exists' => __('validation.exists'),
            'details.*.debit.required_without' => __('validation.required_without'),
            'details.*.credit.required_without' => __('validation.required_without'),
            'details.*.debit.numeric' => __('validation.numeric'),
            'details.*.credit.numeric' => __('validation.numeric'),
            'details.*.description.string' => __('validation.string'),
            'details.*.description.max' => __('validation.max'),
            'details.*.tax_id.exists' => __('validation.exists'),
            'details.*.tax_id.numeric' => __('validation.numeric'),
        ];
    }
}
