<?php

namespace App\Domains\Permission\Interfaces;

use App\Domains\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

interface PermissionRepositoryInterface
{
    public function findById(string $id): Permission;
    public function list();
}
