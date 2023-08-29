<?php

namespace App\Domains\Purchase\Services;


use App\Domains\Purchase\Interfaces\PurchaseRepositoryInterface;

class PurchaseService
{
    public function __construct(private PurchaseRepositoryInterface $purchaseRepository)
    {
    }
    public function findById($id){
        return $this->purchaseRepository->findById($id);
    }

    public function list()
    {
        return $this->purchaseRepository->list();
    }

    public function delete($id)
    {
        return $this->purchaseRepository->delete($id);
    }

    public function create($request)
    {
        return $this->purchaseRepository->store($request);
    }

    public function update($id,$request)
    {
        return $this->purchaseRepository->update($id,$request);
    }
}
