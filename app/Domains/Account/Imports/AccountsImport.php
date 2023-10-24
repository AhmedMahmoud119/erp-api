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

        $group = Group::where('code', $row['account_group_code'])->first();
        $lastAccount = Account::where('code', 'like', $group->code . '%')->orderBy('id', 'desc')->first();

        $lastAccountCode = $lastAccount ? ($lastAccount->code + 1) : $group->code . '0001';
        $code = str_pad($lastAccountCode, 8, '0', STR_PAD_LEFT);


        return new Account([
            'name'            => $row['account_name'],
            'group_id'        => $group->id ?? null,
            'opening_balance' => $row['opening_balance'],
            'account_type'    => $row['account_type'],
            'parent_id'       => Account::where('code', $row['account_parent_code'])->first()->id ?? null,
            'code'            => $code,
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
