<?php

namespace App\Domains\SupplierPurchase\Services;


use App\Domains\SupplierPurchase\Interfaces\SupplierPurchaseRepositoryInterface;

class SupplierPurchaseService
{
    public function __construct(private SupplierPurchaseRepositoryInterface $supplierPurchaseRepository)
    {
    }
    public function findById($id){
        return $this->supplierPurchaseRepository->findById($id);
    }

    public function list()
    {
        return $this->supplierPurchaseRepository->list();
    }

    public function delete($id)
    {
        return $this->supplierPurchaseRepository->delete($id);
    }

    public function create($request)
    {
        return $this->supplierPurchaseRepository->store($request);
    }

    public function update($id,$request)
    {
        return $this->supplierPurchaseRepository->update($id,$request);
    }
}
