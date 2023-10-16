<?php

namespace App\Domains\Account\Interfaces;

use App\Domains\Account\Models\Account;
use Illuminate\Database\Eloquent\Collection;

interface AccountRepositoryInterface
{
    public function findById(string $id): Account;
    public function list();
    public function parents();
    public function store($request):bool;
    public function update(string $id, $request):bool;
    public function delete(string $id): bool;
}
