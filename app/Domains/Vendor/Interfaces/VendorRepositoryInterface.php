<?php

namespace App\Domains\Vendor\Interfaces;

use App\Domains\Vendor\Models\Vendor;

interface VendorRepositoryInterface
{
    public function findById(string $id): Vendor;
    public function list() ;
    public function store($request):bool;
    public function update(string $id, $request):bool;
    public function delete(string $id): bool;
}
