<?php

namespace App\Domains\JournalEntry\Imports;

use App\Domains\JournalEntry\Models\JournalEntry;
use App\Domains\JournalEntry\Models\JournalEntryDetail;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class JournalEntryDetailsImport implements ToModel, WithValidation, WithHeadingRow
{

    use Importable;


    public function model(array $row)
    {
        return new JournalEntryDetail([
            'account_id'       => $row['account_id'],
            'debit'            => $row['debit'],
            'credit'           => $row['credit'],
            'tax_id'           => $row['tax_id'],
            'description'      => $row['description'],
            'journal_entry_id' => $row['journal_entry_id'],
            'date'            => $row['date'],
        ]);
    }

    public function rules(): array
    {
        return [
            'account_id'       => ['required', 'exists:accounts,id'],
            'debit'            => ['required_without:credit', 'numeric'],
            'credit'           => ['required_without:debit', 'numeric'],
            'description'      => ['nullable', 'string', 'max:255'],
            'tax_id'           => ['nullable', 'exists:taxes,id'],
            'journal_entry_id' => ['required', 'exists:journal_entries,id'],
        ];
    }
}
