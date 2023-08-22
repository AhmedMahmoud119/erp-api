<?php

namespace App\Domains\Supplier\Models;


enum EnumPermissionSupplier: string
{

    case create_supplier = 'Create Supplier';
    case edit_supplier = 'Edit Supplier';
    case delete_supplier = 'Delete Supplier';
    case view_suppliers = 'View Suppliers';

}
