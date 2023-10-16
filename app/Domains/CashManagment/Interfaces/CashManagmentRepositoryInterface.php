<?php

namespace App\Domains\CashManagment\Interfaces;

use App\Domains\CashManagment\Models\CashManagment;

interface CashManagmentRepositoryInterface
{
    public function findById(string $id): CashManagment;
    public function list();
    public function store($request);
    public function update(string $id, $request): bool;
    public function delete(string $id): bool;
}
