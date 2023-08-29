<?php

namespace App\Domains\Pack\Interfaces;
use App\Domains\Pack\Models\Pack;


interface PackRepositoryInterface
{
    public function findById(string $id): Pack;
    public function list();
    public function store($request): bool;
    public function update(string $id, $request): bool;
    public function delete(string $id): bool;
}
