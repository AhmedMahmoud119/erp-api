<?php

namespace App\Domains\JournalEntry\Imports\Sheets;

use App\Domains\JournalEntry\Models\JournalEntryDetail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class JournalEntriesDetailsSheet implements ToCollection,ShouldQueue
{
  use Importable;

  public function collection(Collection $rows)
  {
    foreach ($rows as $key => $row) {
      if ($key == 0) continue;
      JournalEntryDetail::updateOrCreate([
        'id' => $row[0],
      ], [
        'account_id' => $row[1],
        'debit' => $row[3],
        'credit' => $row[4],
        'journal_entry_id' => $row[5],
        'description' => $row[8],
      ]);
    }
  }

}
