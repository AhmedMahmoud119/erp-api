<?php

namespace App\Domains\Purchase\Interfaces;
use App\Domains\Purchase\Models\Purchase;



interface PurchaseRepositoryInterface
{
    public function list();
    public function findById(string $id): Purchase;
    public function store($request): bool;
    public function update(string $id, $request): bool;
    public function delete(string $id): bool;
}
