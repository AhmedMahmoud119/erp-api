<?php

namespace App\Domains\Tenant\Interfaces;

use App\Domains\Tenant\Models\Tenant;
use Illuminate\Database\Eloquent\Collection;

interface TenantRepositoryInterface
{
    public function findById(string $id);
    public function findByEmail(string $email);
    public function list();
    public function store($request):bool;
    public function update(string $id, $request):bool;
    public function delete(string $id): bool;
}
