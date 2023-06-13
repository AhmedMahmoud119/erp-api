<?php

namespace App\Domains\FinancialPeriod\Interfaces;

use App\Domains\FinancialPeriod\Models\FinancialPeriod;
use Illuminate\Database\Eloquent\Collection;

interface FinancialPeriodRepositoryInterface
{
    public function findById(string $id): FinancialPeriod;
    public function list();
    public function store($request):bool;
    public function update(string $id, $request):bool;
    public function delete(string $id): bool;
}
