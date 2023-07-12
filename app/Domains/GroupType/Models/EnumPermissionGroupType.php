<?php

namespace App\Domains\GroupType\Models;


enum EnumPermissionGroupType: string
{

    case create_groupType = 'Create GroupType';
    case edit_groupType = 'Edit GroupType';
    case delete_groupType = 'Delete GroupType';
    case view_groupTypes = 'View GroupTypes';


}
