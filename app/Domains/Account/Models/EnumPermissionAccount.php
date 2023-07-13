<?php

namespace App\Domains\Account\Models;


enum EnumPermissionAccount: string
{

    case create_account = 'Create Account';
    case edit_account = 'Edit Account';
    case delete_account = 'Delete Account';
    case view_accounts = 'View Accounts';
    case generatePDF_accounts = 'Generate PDF Accounts';
    case export_accounts = 'Export Accounts';

}
