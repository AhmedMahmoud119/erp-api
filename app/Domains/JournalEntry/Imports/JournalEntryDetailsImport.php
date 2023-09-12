<?php

namespace App\Domains\JournalEntry\Imports;

use App\Domains\JournalEntry\Models\JournalEntry;
use App\Domains\JournalEntry\Models\JournalEntryDetail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class JournalEntryDetailsImport implements ToModel, WithValidation, WithHeadingRow, WithBatchInserts, WithChunkReading, ShouldQueue
{
    use Importable;
    private $id;
    public function __construct($id)
    {
        $this->id = $id;
    }


    public function model(array $row)
    {
        return new JournalEntryDetail([
            'account_id'              =>     $row['account_id'],
            'debit'             => $row['debit'],
            'credit'            => $row['credit'],
            'description'       => $row['description'],
            'journal_entry_id'  => $this->id,
        ]);
    }


    public function rules(): array
    {
        return [
            'account_id'       => ['required', 'exists:accounts,id'],
            'debit'            => ['required_without:credit', 'numeric'],
            'credit'           => ['required_without:debit', 'numeric'],
            'description'      => ['nullable', 'string', 'max:255'],
            'journal_entry_id' => ['required', 'exists:journal_entries,id'],
        ];
    }


    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
