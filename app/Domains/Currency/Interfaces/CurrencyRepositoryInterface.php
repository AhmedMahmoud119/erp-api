<?php

namespace App\Domains\Currency\Interfaces;

use App\Domains\Currency\Models\Currency;
use Illuminate\Database\Eloquent\Collection;

interface CurrencyRepositoryInterface
{
    public function findById(string $id): Currency;
    public function list();
    public function store($request,$price):bool;
    public function update(string $id, $request,$price):bool;
    public function delete(string $id): bool;
}
