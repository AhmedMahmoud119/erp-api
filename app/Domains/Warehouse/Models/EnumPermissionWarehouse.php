<?php

namespace App\Domains\Warehouse\Models;


enum EnumPermissionWarehouse: string
{

    case create_warehouse = 'Create Warehouse';
    case edit_warehouse = 'Edit Warehouse';
    case delete_warehouse = 'Delete Warehouse';
    case view_warehouse = 'View Warehouse';

}
