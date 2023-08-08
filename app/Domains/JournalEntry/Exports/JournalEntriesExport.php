<?php

namespace App\Domains\JournalEntry\Exports;

use App\Domains\JournalEntry\Exports\Sheets\JournalEntryDetailsSheet;
use App\Domains\JournalEntry\Exports\Sheets\JournalEntrySheet;
use Illuminate\Bus\Queueable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class JournalEntriesExport implements WithMultipleSheets, WithHeadings
{
    use Exportable;
    public function headings(): array
    {
        return [
            ['Entries '],
            ['Entry Accounts']
        ];
    }

    public function sheets(): array
    {
        $sheets[] = new JournalEntrySheet;
        $sheets[] = new JournalEntryDetailsSheet;

        return $sheets;
    }
}
