<?php

namespace App\Domains\JournalEntry\Models;


enum EnumPermissionJournalEntry: string
{

    case create_company = 'Create Company';
    case edit_company = 'Edit Company';
    case delete_company = 'Delete Company';
    case view_companies = 'View Companies';

}
