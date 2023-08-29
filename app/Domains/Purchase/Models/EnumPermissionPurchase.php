<?php

namespace App\Domains\Purchase\Models;


enum EnumPermissionPurchase: string
{

    case create_purchase = 'Create Purchase';
    case edit_purchase = 'Edit Purchase';
    case delete_purchase = 'Delete Purchase';
    case view_purchases = 'View Purchases';

}
