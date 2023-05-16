<?php

namespace App\Domains\Role\Models;

use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\PermissionRegistrar;


class Role extends SpatieRole
{
    use SoftDeletes;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'model_has_roles', 'role_id', 'model_id');
    }
}
