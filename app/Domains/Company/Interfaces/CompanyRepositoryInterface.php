<?php

namespace App\Domains\Company\Interfaces;

use App\Domains\Company\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface CompanyRepositoryInterface
{
    public function findById(string $id): Company;
    public function list() ;
    public function store($request):bool;
    public function update(string $id, $request):bool;
    public function delete(string $id): bool;
}
