<?php

namespace App\Domains\Vendor\Services;


use App\Domains\Vendor\Interfaces\VendorRepositoryInterface;

class VendorService
{
    public function __construct(private VendorRepositoryInterface $vendorRepository)
    {
    }

    public function list()
    {
        return $this->vendorRepository->list();
    }
    public function findById($id)
    {
        return $this->vendorRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->vendorRepository->delete($id);
    }

    public function create($request)
    {
        return $this->vendorRepository->store($request);
    }

    public function update($id,$request)
    {
        return $this->vendorRepository->update($id,$request);
    }
}
