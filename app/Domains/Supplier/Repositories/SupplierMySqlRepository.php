<?php

namespace App\Domains\Supplier\Repositories;

use App\Domains\Supplier\Interfaces\SupplierRepositoryInterface;
use App\Domains\Supplier\Models\Supplier;
use Illuminate\Database\Eloquent\Collection;
use App\Domains\Account\Models\Account;

class SupplierMySqlRepository implements SupplierRepositoryInterface
{
    public function __construct(private Supplier $supplier)
    {
    }
    public function list()
    {
       
    }

    public function store($request): bool
    {
        return true;
      
    }

    public function update(string $id, $request): bool
    {
        return true;
        
    }

    public function delete(string $id): bool
    {
        $this->supplier::findOrFail($id)->delete();

        return true;
      
    }
}
