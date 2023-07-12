<?php

namespace App\Domains\Account\Models;


enum EnumPermissionAccount: string
{

    case create_bankAccount = 'Create Account';
    case edit_bankAccount = 'Edit Account';
    case delete_bankAccount = 'Delete Account';
    case view_bankAccounts = 'View Accounts';
    case generatePDF_bankAccounts = 'Generate PDF Accounts';
    case export_bankAccounts = 'Export Accounts';

}
