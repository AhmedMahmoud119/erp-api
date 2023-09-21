<?php

namespace App\Domains\Supplier\Interfaces;
use App\Domains\Supplier\Models\Supplier;

interface SupplierRepositoryInterface
{
    public function list() ;
    public function findById($id):Supplier ;
    public function store($request):bool;
    public function update(string $id, $request):bool;
    public function delete(string $id): bool;
}
