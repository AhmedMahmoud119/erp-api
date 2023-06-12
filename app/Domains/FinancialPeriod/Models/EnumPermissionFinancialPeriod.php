<?php

namespace App\Domains\FinancialPeriod\Models;


enum EnumPermissionFinancialPeriod: string
{

    case create_financialPeriod = 'Create Financial Period';
    case edit_financialPeriod = 'Edit Financial Period';
    case delete_financialPeriod = 'Delete Financial Period';
    case view_financialPeriods = 'View Financial Periods';

}
