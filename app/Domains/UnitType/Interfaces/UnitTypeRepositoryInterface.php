<?php

namespace App\Domains\UnitType\Interfaces;
use App\Domains\UnitType\Models\UnitType;

interface UnitTypeRepositoryInterface
{
    public function list() ;
    public function findById(string $id): UnitType;
    public function store($request):bool;
    public function update(string $id, $request):bool;
    public function delete(string $id): bool;
}
