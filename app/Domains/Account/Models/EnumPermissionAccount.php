<?php

namespace App\Domains\Account\Models;


enum EnumPermissionAccount: string
{

    case create_account = 'Create Account';
    case edit_account = 'Edit Account';
    case delete_account = 'Delete Account';
    case view_accounts = 'View Accounts';
    case import_accounts = 'Import Accounts';
    case view_chart_of_accounts = 'View Chart Account';

}
