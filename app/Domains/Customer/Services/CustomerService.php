<?php

namespace App\Domains\Customer\Services;


use App\Domains\Customer\Interfaces\CustomerRepositoryInterface;

class CustomerService
{
    public function __construct(private CustomerRepositoryInterface $customerRepository)
    {
    }

    public function list()
    {
        return $this->customerRepository->list();
    }
    public function findById($id)
    {
        return $this->customerRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->customerRepository->delete($id);
    }

    public function create($request)
    {
        return $this->customerRepository->store($request);
    }

    public function update($id,$request)
    {
        return $this->customerRepository->update($id,$request);
    }
}
