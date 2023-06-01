<?php

namespace App\Domains\BankAccount\Services;


use App\Domains\BankAccount\Interfaces\BankAccountRepositoryInterface;
use App\Mail\SendPassword;
use Illuminate\Support\Facades\Mail;

class BankAccountService
{
    public function __construct(private BankAccountRepositoryInterface $bankAccountRepository)
    {
    }

    public function list()
    {
        return $this->bankAccountRepository->list();
    }
    public function findById($id)
    {
        return $this->bankAccountRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->bankAccountRepository->delete($id);
    }

    public function create($request)
    {

        return $this->bankAccountRepository->store($request);
    }

    public function update($id,$request)
    {

        return $this->bankAccountRepository->update($id,$request);
    }
}
