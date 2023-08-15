<?php

namespace App\Domains\Company\Services;


use App\Domains\Company\Interfaces\CompanyRepositoryInterface;
use App\Mail\SendPassword;
use Illuminate\Support\Facades\Mail;

class CompanyService
{
    public function __construct(private CompanyRepositoryInterface $companyRepository)
    {
    }

    public function list()
    {
        return $this->companyRepository->list();
    }
    public function findById($id)
    {
        return $this->companyRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->companyRepository->delete($id);
    }

    public function create($request)
    {
        return $this->companyRepository->store($request);
    }

    public function update($id,$request)
    {
        return $this->companyRepository->update($id,$request);
    }

}
