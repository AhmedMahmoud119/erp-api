<?php

namespace App\Domains\Warehouse\Interfaces;

use App\Domains\Warehouse\Models\Warehouse;

interface WarehouseRepositoryInterface
{
    public function findById(string $id): Warehouse;
    public function list() ;
    public function store($request):bool;
    public function update(string $id, $request):bool;
    public function delete(string $id): bool;
}
