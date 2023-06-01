<?php

namespace App\Domains\BankAccount\Interfaces;

use App\Domains\BankAccount\Models\BankAccount;
use Illuminate\Database\Eloquent\Collection;

interface BankAccountRepositoryInterface
{
    public function findById(string $id): BankAccount;
    public function list();
    public function store($request):bool;
    public function update(string $id, $request):bool;
    public function delete(string $id): bool;
}
