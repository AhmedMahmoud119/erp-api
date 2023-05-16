<?php

namespace App\Domains\Company\Models;


enum EnumPermissionCompany: string
{

    case create_company = 'Create Company';
    case edit_company = 'Edit Company';
    case delete_company = 'Delete Company';
    case view_companies = 'View Companies';

}
