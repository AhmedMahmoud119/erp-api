<?php

namespace App\Domains\Permission\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;


class Permission extends SpatiePermission
{

    public function permissionCategory(){
        return $this->belongsTo(PermissionCategory::class);
    }
}
