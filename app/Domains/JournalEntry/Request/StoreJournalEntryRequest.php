<?php

namespace App\Domains\JournalEntry\Request;

use App\Domains\Tax\Models\Tax;
use Illuminate\Foundation\Http\FormRequest;

class StoreJournalEntryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'entry_no' => ['required', 'numeric'],
            'date' => ['required', 'date'],
            'description' => ['required', 'string'],
            'accounts' => ['required', 'array'],
            'accounts.*.account_id' => ['required', 'exists:accounts,id'],
            'accounts.*.debit' => ['required_without:accounts.*.credit', 'numeric'],
            'accounts.*.credit' => ['required_without:accounts.*.debit', 'numeric'],
            'accounts.*.description' => ['nullable', 'string', 'max:255'],
            'accounts.*.tax_id' => ['nullable', 'exists:taxes,id'],
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $accounts = collect($this->accounts)->map(
                fn ($detail) =>
                [
                    'account_id' => $detail['account_id'],
                    'debit' => $detail['debit'],
                    'credit' => $detail['credit'],
                    'tax_id' => $detail['tax_id'] ?? null,
                ]
            )->toArray();
            $accounts = collect($accounts)->map(function ($account) {
                $tax = Tax::find($account['tax_id']);
                if ($tax) {
                    $account['debit'] = $account['debit'] + ($account['debit'] * $tax->percentage) / 100;
                    $account['credit'] = $account['credit'] + ($account['credit'] * $tax->percentage) / 100;
                }
                return $account;
            });
            $debit = $accounts->sum('debit');
            $credit = $accounts->sum('credit');
            if ($debit != $credit) {
                $validator->errors()->add('accounts', __('validation.not_equal'));
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
            'accounts.required' => __('validation.required'),
            'accounts.*.account_id.required' => __('validation.required'),
            'accounts.*.account_id.exists' => __('validation.exists'),
            'accounts.*.debit.required_without' => __('validation.required_without'),
            'accounts.*.credit.required_without' => __('validation.required_without'),
            'accounts.*.debit.numeric' => __('validation.numeric'),
            'accounts.*.credit.numeric' => __('validation.numeric'),
            'accounts.*.description.string' => __('validation.string'),
            'accounts.*.description.max' => __('validation.max'),
            'accounts.*.tax_id.exists' => __('validation.exists'),
            'accounts.*.tax_id.numeric' => __('validation.numeric'),

        ];
    }
}
