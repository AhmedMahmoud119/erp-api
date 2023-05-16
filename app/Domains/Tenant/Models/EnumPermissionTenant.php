<?php

namespace App\Domains\Tenant\Models;


enum EnumPermissionTenant: string
{

    case create_tenant = 'Create Tenant';
    case edit_tenant = 'Edit Tenant';
    case delete_tenant = 'Delete Tenant';
    case view_tenants = 'View Tenants';

}
