<?php

namespace App\Domains\JournalEntry\Imports;

use App\Domains\JournalEntry\Models\JournalEntry;
use App\Domains\JournalEntry\Models\JournalEntryDetail;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class JournalEntryImport implements ToModel, WithValidation, WithHeadingRow
{

    use Importable;

    public function model(array $row)
    {

        $entry =  new JournalEntry([
            'title'       => $row['title'],
            'entry_no'    => $row['entry_no'],
            'date'        => $row['date'],
            'description' => $row['description'],
        ]);
        $details =  collect($row['accounts'])->map(
            fn ($detail) =>
            [
                'account_id' => $detail['account_id'],
                'debit'      => $detail['debit'],
                'credit'     => $detail['credit'],
                'tax_id'     => $detail['tax_id'] ?? null,
            ]
        )->toArray();
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
