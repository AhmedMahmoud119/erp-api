<?php

namespace App\Domains\Field\Models;


enum EnumPermissionField: string
{

    case create_field = 'Create Field';
    case edit_field = 'Edit Field';
    case delete_field = 'Delete Field';
    case view_fields = 'View Fields';

}
