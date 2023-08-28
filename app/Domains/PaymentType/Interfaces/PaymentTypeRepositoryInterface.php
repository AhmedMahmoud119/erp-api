<?php

namespace App\Domains\PaymentType\Interfaces;

use App\Domains\PaymentType\Models\PaymentType;

interface PaymentTypeRepositoryInterface
{
    public function findById(string $id): PaymentType;
    public function list() ;
    public function store($request):bool;
    public function update(string $id, $request):bool;
    public function delete(string $id): bool;
}
