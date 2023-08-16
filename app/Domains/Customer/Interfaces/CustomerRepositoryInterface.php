<?php

namespace App\Domains\Customer\Interfaces;

use App\Domains\Customer\Models\Customer;

interface CustomerRepositoryInterface
{
    public function findById(string $id): Customer;
    public function list() ;
    public function store($request):bool;
    public function update(string $id, $request):bool;
    public function delete(string $id): bool;
}
