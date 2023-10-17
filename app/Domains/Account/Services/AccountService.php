<?php

namespace App\Domains\Account\Services;


use App\Domains\Account\Imports\AccountsImport;
use App\Domains\Account\Interfaces\AccountRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;

class AccountService
{
    public function __construct(private AccountRepositoryInterface $accountRepository)
    {
    }

    public function list()
    {
        return $this->accountRepository->list();
    }
    public function parents()
    {
        return $this->accountRepository->parents();
    }
    public function notParents()
    {
        return $this->accountRepository->notParents();
    }
    public function findById($id)
    {
        return $this->accountRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->accountRepository->delete($id);
    }
    public function bulkDelete()
    {
        return $this->accountRepository->bulkDelete();
    }

    public function create($request)
    {

        return $this->accountRepository->store($request);
    }

    public function update($id,$request)
    {

        return $this->accountRepository->update($id,$request);
    }

    public function import()
    {
        Excel::import(new AccountsImport, request()->file);

        return true;
    }

}
