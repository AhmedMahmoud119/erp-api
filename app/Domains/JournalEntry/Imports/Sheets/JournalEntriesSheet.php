<?php

namespace App\Domains\JournalEntry\Imports\Sheets;

use App\Domains\JournalEntry\Models\JournalEntry;
use App\Domains\JournalEntry\Models\JournalEntryDetail;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class JournalEntriesSheet implements ToCollection
{
  public function collection(Collection $rows)
  {
    foreach ($rows as $key=> $row) {
      if($key == 0) continue;
      JournalEntry::updateOrCreate([
        'id' => $row[0],
      ], [
        'title' => $row[1],
        'entry_no'  => $row[2],
        'date' => Carbon::parse($row[3])->format('Y-m-d'),  
        'description' => $row[4],
        'creator_id' => $row[6],
      ]);
    }
  }
}
