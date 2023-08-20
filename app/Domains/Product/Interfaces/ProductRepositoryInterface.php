<?php

namespace App\Domains\Product\Interfaces;

use App\Domains\Product\Models\Product;

interface ProductRepositoryInterface
{
    public function findById(string $id): Product;
    public function list();
    public function store($request): bool;
    public function update(string $id, $request): bool;
    public function delete(string $id): bool;
}