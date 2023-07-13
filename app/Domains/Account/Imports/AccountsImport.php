<?php

namespace App\Domains\Account\Imports;

use App\Domains\Account\Models\Account;
use App\Domains\Group\Models\Group;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class AccountsImport implements ToModel, WithValidation, WithHeadingRow
{

    use Importable;


    public function model(array $row)
    {

        return new Account([
            'name'            => $row['account_name'],
            'group_id'        => Group::where('code', $row['account_group_code'])->first()->id ?? null,
            'opening_balance' => $row['opening_balance'],
            'account_type'    => $row['account_type'],
            'parent_id'       => Account::where('code', $row['account_parent_code'])->first()->id ?? null,
            'code'            => $row['account_code'],
            'creator_id'      => auth()->user()->id,
        ]);
    }

    public function rules(): array
    {
        return [
            'account_name'        => 'required',
            'account_group_code'  => 'required|exists:groups,code',
            'opening_balance'     => 'numeric',
            'account_type'        => ['required', Rule::in(['Cr', 'Dr', 'Both'])],
            'account_parent_code' => 'nullable|exists:accounts,code',
        ];

    }

}
