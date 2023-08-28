<?php

namespace App\Domains\PaymentType\Services;


use App\Domains\PaymentType\Interfaces\PaymentTypeRepositoryInterface;

class PaymentTypeService
{
    public function __construct(private PaymentTypeRepositoryInterface $paymentTypeRepository)
    {
    }

    public function list()
    {
        return $this->paymentTypeRepository->list();
    }
    public function findById($id)
    {
        return $this->paymentTypeRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->paymentTypeRepository->delete($id);
    }

    public function create($request)
    {
        return $this->paymentTypeRepository->store($request);
    }

    public function update($id,$request)
    {
        return $this->paymentTypeRepository->update($id,$request);
    }
}
