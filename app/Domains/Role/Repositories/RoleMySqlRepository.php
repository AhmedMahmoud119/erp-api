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
        return $this->role::select('id', 'name', 'created_at')->with(['permissions' => function ($query) {
            $query->select('id', 'name');
        }])->findOrFail($id);
    }

    public function findByEmail(string $email)
    {
        // TODO: Implement findByEmail() method.
    }

    public function list()
    {


        return $this->role::select('id', 'name', 'created_at')
            ->when(request()->search, function ($q) {
                $q->where('name', 'like', '%' . request()->search . '%');
            })->with(['permissions' => function ($query) {
                $query->select('id', 'name');
            }])->paginate(config('app.pagination_count'));
    }

    public function store($request): bool
    {
        $role = $this->role::create($request->all() + ['guard_name' => 'api']);
        $role->permissions()->sync($request->permissions);
        return true;
    }

    public function update(string $id, $request): bool
    {
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
