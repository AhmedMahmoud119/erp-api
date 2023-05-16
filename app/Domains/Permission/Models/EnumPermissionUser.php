<?php

namespace App\Domains\Permission\Models;

enum EnumPermissionUser: string
{
    case create_user = 'Create User';
    case edit_user = 'Edit User';
    case delete_user = 'Delete User';
    case view_users = 'View Users';
    case export_users = 'Export Users';

}
