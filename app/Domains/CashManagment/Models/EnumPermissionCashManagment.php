<?php

namespace App\Domains\CashManagment\Models;


enum EnumPermissionCashManagment: string
{

    case create_CashManagment = 'Create Cash Managment';
    case edit_CashManagment = 'Edit Cash Managment';
    case delete_CashManagment = 'Delete Cash Managment';
    case view_CashManagments = 'View Cash Managments';



}
