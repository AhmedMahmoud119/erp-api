<?php

namespace App\Domains\JournalEntry\Exports\Sheets;

use App\Domains\JournalEntry\Models\JournalEntry;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class JournalEntrySheet implements FromCollection, WithHeadings, WithMapping, ShouldQueue
{
  public function headings(): array
  {
    return [
      'id',
      'title',
      'entry_no',
      'date',
      'description',
      'creator',
      'creator_id'
    ];
  }

  public function collection()
  {
    return JournalEntry::with('creator')->get();
  }
  public function map($journalEntry): array
  {
    return [
      $journalEntry->id,
      $journalEntry->title,
      $journalEntry->entry_no,
      $journalEntry->date,
      $journalEntry->description,
      $journalEntry->creator->name ?? null,
      $journalEntry->creator_id,
    ];
  }
}
