<?php

namespace App\Domains\Vendor\Models;


enum EnumPermissionVendor: string
{

    case create_vendor = 'Create Vendor';
    case edit_vendor = 'Edit Vendor';
    case delete_vendor = 'Delete Vendor';
    case view_vendor = 'View Vendor';

}
