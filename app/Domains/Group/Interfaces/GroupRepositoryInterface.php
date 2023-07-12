<?php

namespace App\Domains\Group\Interfaces;

use App\Domains\Group\Models\Group;
use Illuminate\Database\Eloquent\Collection;

interface GroupRepositoryInterface
{
    public function findById(string $id): Group;
    public function list();
    public function store($request) ;
    public function update(string $id, $request):bool;
    public function delete(string $id): bool;
}
