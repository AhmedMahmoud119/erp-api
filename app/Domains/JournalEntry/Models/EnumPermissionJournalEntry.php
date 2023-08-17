<?php

namespace App\Domains\JournalEntry\Models;


enum EnumPermissionJournalEntry: string
{

    case create_journalEntry = 'Create Journal Entry';
    case edit_journalEntry = 'Edit Journal Entry';
    case delete_journalEntry = 'Delete Journal Entry';
    case view_journalEntries = 'View Journal Entry';
    case import_journalEntry = 'Import Journal Entry';
    case export_journalEntry = 'Export Journal Entry';
    case balance_sheet = 'Balance Sheet';
}
