<?php

namespace App\Domains\Product\Models;


enum EnumPermissionProduct: string
{

    case create_product = 'Create Product';
    case edit_product = 'Edit Product';
    case delete_product = 'Delete Product';
    case view_products = 'View Products';

}
