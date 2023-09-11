<?php

namespace App\Domains\BankAccount\Imports;

use App\Domains\Account\Models\Account;
use App\Domains\BankAccount\Models\BankAccount;
use App\Domains\Currency\Models\Currency;
use App\Domains\Group\Models\Group;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class BankAccountsImport implements ToModel, WithValidation, WithHeadingRow
{

    use Importable;


    public function model(array $row)
    {
        return new BankAccount([
            'name'             => $row['bank_name'],
            'account_number'   => $row['account_number'],
            'holder_name'      => $row['holder_name'],
            'account_type'     => $row['account_type'],
            'chart_of_account' => $row['chart_of_account'],
            'currency_id'      => Currency::where('code', $row['account_currency'])->first()->id,
            'opening_balance'  => $row['opening_balance'],
            'authorized_by'    => $row['authorized_by'],
            'creator_id'       => auth()->user()->id,
        ]);
    }

    public function rules(): array
    {

        return [
            'bank_name'        => 'required|regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',
            'account_number'   => 'required|unique:bank_accounts,account_number|numeric',
            'holder_name'      => 'nullable|regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',
            'authorized_by'    => 'nullable|regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',
            'account_type'     => 'required',
            'account_currency' => 'required|exists:currencies,code',
            'chart_of_account' => 'required',
            'opening_balance'  => 'required|numeric|gt:0',
        ];

    }

}
