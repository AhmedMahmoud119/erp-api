<?php

namespace App\Domains\Category\Models;


enum EnumPermissionCategory: string
{

    case create_category = 'Create Category';
    case edit_category = 'Edit Category';
    case delete_category = 'Delete Category';
    case view_categories = 'View Categories';

}
