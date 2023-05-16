<?php

namespace App\Domains\Tax\Interfaces;

use App\Domains\Tax\Models\Tax;
use Illuminate\Database\Eloquent\Collection;

interface TaxRepositoryInterface
{
    public function findById(string $id): Tax;
    public function list();
    public function store($request):bool;
    public function update(string $id, $request):bool;
    public function delete(string $id): bool;
}
