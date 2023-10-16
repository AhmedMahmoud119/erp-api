<?php

namespace App\Domains\SafeMovement\Interfaces;

use App\Domains\SafeMovement\Models\SafeMovement;

interface SafeMovementRepositoryInterface
{
    public function findById(string $id): SafeMovement;
    public function list();
    public function store($request);
    public function update(string $id, $request): bool;
    public function delete(string $id): bool;
}
