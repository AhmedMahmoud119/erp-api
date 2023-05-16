<?php

namespace App\Domains\Tax\Services;


use App\Domains\Tax\Interfaces\TaxRepositoryInterface;
use App\Mail\SendPassword;
use Illuminate\Support\Facades\Mail;

class TaxService
{
    public function __construct(private TaxRepositoryInterface $taxRepository)
    {
    }

    public function list()
    {
        return $this->taxRepository->list();
    }
    public function findById($id)
    {
        return $this->taxRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->taxRepository->delete($id);
    }

    public function create($request)
    {
        return $this->taxRepository->store($request);
    }

    public function update($id,$request)
    {
        return $this->taxRepository->update($id,$request);
    }
}
