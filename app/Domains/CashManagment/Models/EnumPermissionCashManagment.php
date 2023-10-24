<?php

namespace App\Domains\CashManagment\Models;


enum EnumPermissionCashManagment: string
{

    case create_CashManagement = 'Create Cash Management';
    case edit_CashManagement = 'Edit Cash Management';
    case delete_CashManagement = 'Delete Cash Management';
    case view_CashManagements = 'View Cash Managements';
}
