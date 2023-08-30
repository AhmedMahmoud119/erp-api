<?php

namespace App\Domains\GroupType\Interfaces;

use App\Domains\GroupType\Models\GroupType;
use Illuminate\Database\Eloquent\Collection;

interface GroupTypeRepositoryInterface
{
    public function findById(string $id): GroupType;
    public function list();
    public function store($request):bool;
    public function update(string $id, $request):bool;
    public function delete(string $id): bool;
    public function getTreeView();
}
