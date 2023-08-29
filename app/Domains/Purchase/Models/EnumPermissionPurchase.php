<?php

namespace App\Domains\Purchase\Models;


enum EnumPermissionPurchase: string
{

    case create_supplierPurchase = 'Create Purchase';
    case edit_supplierPurchase = 'Edit Purchase';
    case delete_supplierPurchase = 'Delete Purchase';
    case view_supplierPurchases = 'View Purchases';

}
