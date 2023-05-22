<?php

namespace App\Domains\Tax\Models;


enum EnumPermissionTax: string
{

    case create_tax = 'Create Tax';
    case edit_tax = 'Edit Tax';
    case delete_tax = 'Delete Tax';
    case view_taxes = 'View Taxes';

}
