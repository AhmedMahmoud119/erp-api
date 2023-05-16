<?php

namespace App\Domains\Currency\Services;


use App\Domains\Currency\Interfaces\CurrencyRepositoryInterface;
use App\Mail\SendPassword;
use Illuminate\Support\Facades\Mail;

class CurrencyService
{
    public function __construct(private CurrencyRepositoryInterface $currencyRepository)
    {
    }

    public function list()
    {
        return $this->currencyRepository->list();
    }
    public function findById($id)
    {
        return $this->currencyRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->currencyRepository->delete($id);
    }

    public function create($request)
    {
        return $this->currencyRepository->store($request);
    }

    public function update($id,$request)
    {
        return $this->currencyRepository->update($id,$request);
    }
}
