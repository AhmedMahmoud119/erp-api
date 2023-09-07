<?php

namespace App\Domains\JournalEntry\Exports\Sheets;

use App\Domains\JournalEntry\Models\JournalEntryDetail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class JournalEntryDetailsSheet implements FromCollection, WithHeadings, WithMapping, ShouldQueue
{
  public function headings(): array
  {
    return [
      'id',
      'account_id',
      'account code',
      'debit',
      'credit',
      'journal_entry_id',
      'description',
    ];
  }

  public function collection()
  {
    return JournalEntryDetail::with('account')->get();
  }
  public function map($journalEntryDetail): array
  {
    return [
      $journalEntryDetail->id,
      $journalEntryDetail->account_id,
      $journalEntryDetail->account->code,
      $journalEntryDetail->debit,
      $journalEntryDetail->credit,
      $journalEntryDetail->journal_entry_id,
      $journalEntryDetail->description,
    ];
  }
}
