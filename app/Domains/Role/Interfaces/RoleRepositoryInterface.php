<?php

namespace App\Domains\Role\Interfaces;

use App\Domains\Role\Models\Role;
use Illuminate\Database\Eloquent\Collection;

interface RoleRepositoryInterface
{
    public function findById(string $id);
    public function list();
    public function store($request): bool;
    public function update(string $id, $request): bool;
    public function delete(string $id): bool;
}
