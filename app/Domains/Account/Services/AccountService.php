<?php

namespace App\Domains\Account\Services;


use App\Domains\Account\Exports\AccountsExport;
use App\Domains\Account\Interfaces\AccountRepositoryInterface;
use App\Mail\SendPassword;
use Illuminate\Support\Facades\Mail;
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
    public function findById($id)
    {
        return $this->accountRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->accountRepository->delete($id);
    }

    public function create($request)
    {

        return $this->accountRepository->store($request);
    }

    public function update($id,$request)
    {

        return $this->accountRepository->update($id,$request);
    }
    public function generatePDF()
    {
        return $this->accountRepository->generatePDF();
    }
    public function export()
    {
        $filename = time() . '-accounts.csv';
        $path = 'exports/accounts/' . $filename;
        Excel::store(new AccountsExport(), $path, 'public');

        return response()->json([
            'file_path' => asset('storage/'.$path)
        ]);
    }
}
