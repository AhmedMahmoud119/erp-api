<?php

namespace App\Domains\SafeMovement\Models;


enum EnumPermissionSafeMovement: string
{

    case create_SafeMovement = 'Create Safe Movement';
    case edit_SafeMovement = 'Edit Safe Movement';
    case delete_SafeMovement = 'Delete Safe Movement';
    case view_SafeMovements = 'View Safe Movements';



}
