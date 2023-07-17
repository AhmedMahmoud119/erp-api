<?php

namespace App\Domains\Permission\Repositories;

use App\Domains\Module\Models\Module;
use App\Domains\Permission\Interfaces\PermissionRepositoryInterface;
use App\Domains\Permission\Models\Permission;

class PermissionMySqlRepository implements PermissionRepositoryInterface
{
    public function __construct(private Permission $permission)
    {
    }

    public function findById(string $id): Permission
    {
        return $this->permission::select('id', 'name')->findOrFail($id);
    }

    public function list()
    {
        $permissionModule = Module::select('id','name')
            ->with([
                'permissionCategories.permissions'=>
                    function ($q){
                        $q->where('permissions.name', 'like', '%' . request()->search . '%');
                    }
            ])->paginate(request('limit',config('app.pagination_count')));
        return $permissionModule;
    }

}
