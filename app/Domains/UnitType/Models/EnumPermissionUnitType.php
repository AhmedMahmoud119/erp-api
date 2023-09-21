<?php

namespace App\Domains\UnitType\Models;


enum EnumPermissionUnitType: string
{

    case create_unit_type = 'Create UnitType';
    case edit_unit_type = 'Edit UnitType';
    case delete_unit_type = 'Delete UnitType';
    case view_unit_type = 'View UnitType';

}
