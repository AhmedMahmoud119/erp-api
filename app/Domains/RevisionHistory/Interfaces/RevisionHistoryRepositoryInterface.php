<?php

namespace App\Domains\RevisionHistory\Interfaces;

use App\Domains\RevisionHistory\Models\RevisionHistory;
use Illuminate\Database\Eloquent\Collection;

interface RevisionHistoryRepositoryInterface
{
    public function findById(string $id): RevisionHistory;
    public function findByModel(string $model,string $id): Collection;
    public function list();
    public function store($request,$model,$changes):bool;
//    public function update(string $id, $request):bool;
//    public function delete(string $id): bool;
}
