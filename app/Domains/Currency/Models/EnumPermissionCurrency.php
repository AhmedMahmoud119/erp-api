<?php

namespace App\Domains\Currency\Models;


enum EnumPermissionCurrency: string
{

    case create_currency = 'Create Currency';
    case edit_currency = 'Edit Currency';
    case delete_currency = 'Delete Currency';
    case view_currencies = 'View Currencies';
    case get_codes = 'Get Codes';

}
