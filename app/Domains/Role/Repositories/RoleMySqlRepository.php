<?php

namespace App\Domains\Role\Repositories;

use App\Domains\Permission\Models\Permission;
use App\Domains\Role\Interfaces\RoleRepositoryInterface;
use App\Domains\Role\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleMySqlRepository implements RoleRepositoryInterface
{
    public function __construct(private Role $role)
    {
    }

    public function findById(string $id)
    {
        $role =  $this->role::select('id', 'name', 'created_at')->with(['permissions' => function ($query) {
            $query->select('id', 'name');
        }])->with('users')->findOrFail($id);
        $role->permissions = $role->getAllPermissions();
        return $role;
    }

    public function list()
    {


        return $this->role::select('id', 'name', 'created_at')
            ->when(request()->search, function ($q) {
                $q->where('name', 'like', '%' . request()->search . '%');
            })
            ->when(request()->from, function ($q) {
                $q->whereDate('created_at', '>=', request()->from);
            })
            ->when(request()->to, function ($q) {
                $q->whereDate('created_at', '<=', request()->to);
            })
            ->when(request()->name, function ($q) {
                $q->where('name', request()->name);
            })
            ->when(request()->creator_id, function ($q) {
                $q->where('creator_id', request()->creator_id);
            })
            ->when(request()->sort_by, function ($q) {
                if (in_array(request()->sort_by, ['name', 'created_at'])) {
                    $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
                }
                return $q;
            })
            ->with(['permissions' => function ($query) {
                $query->select('id', 'name');
            }])->with('users')->paginate(request('limit', config('app.pagination_count')));
    }

    public function store($request): bool
    {
        $role = $this->role::create($request->all() + ['guard_name' => 'api']);
        $role->permissions()->sync($request->permissions);
        return true;
    }

    public function update(string $id, $request): bool
    {
        if ($id == 1) {
            return false;
        }

        $role = $this->role::findOrFail($id);
        $role->update([
            'name' => $request->name ?? $role->name,
        ]);
        $role->permissions()->sync($request->permissions);
        return true;
    }

    public function delete(string $id): bool
    {
        $role = $this->role::findOrFail($id);
        if ($role->users->isEmpty()) {
            $role->delete();
            return true;
        }

        return false;
    }
}
