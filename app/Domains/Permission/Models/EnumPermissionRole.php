<?php

namespace App\Domains\Permission\Models;

enum EnumPermissionRole: string
{
    case create_role = 'Create Role';
    case edit_role = 'Edit Role';
    case delete_role = 'Delete Role';
    case view_roles = 'View Roles';

}
