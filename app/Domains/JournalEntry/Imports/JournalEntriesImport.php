<?php

namespace App\Domains\JournalEntry\Imports;

use App\Domains\JournalEntry\Imports\Sheets\JournalEntriesDetailsSheet;
use App\Domains\JournalEntry\Imports\Sheets\JournalEntriesSheet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class JournalEntriesImport implements WithMultipleSheets, ShouldQueue, WithChunkReading, WithBatchInserts
{
    use Importable;

    public function sheets(): array
    {
        return [
            new JournalEntriesSheet,
            new JournalEntriesDetailsSheet,
        ];
    }
    public function chunkSize(): int
    {
        return 500;
    }
    public function batchSize(): int
    {
        return 500;
    }

}
