<?php

namespace App\Domains\SupplierPurchase\Models;


enum EnumPermissionSupplierPurchase: string
{

    case create_supplierPurchase = 'Create SupplierPurchase';
    case edit_supplierPurchase = 'Edit SupplierPurchase';
    case delete_supplierPurchase = 'Delete SupplierPurchase';
    case view_supplierPurchases = 'View SupplierPurchases';

}
