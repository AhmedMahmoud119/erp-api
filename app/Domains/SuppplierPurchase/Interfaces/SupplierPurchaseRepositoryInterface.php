<?php

namespace App\Domains\SupplierPurchase\Interfaces;



interface SupplierPurchaseRepositoryInterface
{
    public function list();
    public function findById(string $id): SupplierPurchase;
    public function store($request): bool;
    public function update(string $id, $request): bool;
    public function delete(string $id): bool;
}
