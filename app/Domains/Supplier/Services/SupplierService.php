<?php

namespace App\Domains\Supplier\Services;


use App\Domains\Supplier\Interfaces\SupplierRepositoryInterface;
use App\Mail\SendPassword;
use Illuminate\Support\Facades\Mail;

class SupplierService
{
    public function __construct(private SupplierRepositoryInterface $supplierRepository)
    {
    }

    public function list()
    {
        return $this->supplierRepository->list();
    }
   
    public function delete($id)
    {
        return $this->supplierRepository->delete($id);
    }

    public function create($request)
    {
        return $this->supplierRepository->store($request);
    }

    public function update($id,$request)
    {
        return $this->supplierRepository->update($id,$request);
    }
}
