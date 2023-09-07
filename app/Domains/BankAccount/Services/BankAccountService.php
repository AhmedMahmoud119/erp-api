<?php

namespace App\Domains\BankAccount\Services;


use App\Domains\BankAccount\Exports\BankAccountsExport;
use App\Domains\BankAccount\Imports\BankAccountsImport;
use App\Domains\BankAccount\Interfaces\BankAccountRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;

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
    public function generatePDF()
    {
        return $this->bankAccountRepository->generatePDF();
    }
    public function export()
    {
        $filename = time() . '-bankAccounts.csv';
        $path = 'exports/bankAccounts/' . $filename;
        Excel::store(new BankAccountsExport(), $path, 'public');

        return response()->json([
            'file_path' => asset('storage/'.$path)
        ]);
    }

    public function import()
    {
        Excel::import(new BankAccountsImport, request()->file);

        return 1;
    }
}
