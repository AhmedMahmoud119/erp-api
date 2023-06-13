<?php

namespace App\Domains\FinancialPeriod\Services;


use App\Domains\FinancialPeriod\Interfaces\FinancialPeriodRepositoryInterface;
use App\Mail\SendPassword;
use Illuminate\Support\Facades\Mail;

class FinancialPeriodService
{
    public function __construct(private FinancialPeriodRepositoryInterface $financialPeriodRepository)
    {
    }

    public function list()
    {
        return $this->financialPeriodRepository->list();
    }
    public function findById($id)
    {
        return $this->financialPeriodRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->financialPeriodRepository->delete($id);
    }

    public function create($request)
    {
        return $this->financialPeriodRepository->store($request);
    }

    public function update($id,$request)
    {
        return $this->financialPeriodRepository->update($id,$request);
    }
}
