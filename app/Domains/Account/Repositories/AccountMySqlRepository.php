<?php

namespace App\Domains\Account\Repositories;

use App\Domains\Account\Interfaces\AccountRepositoryInterface;
use App\Domains\Account\Models\Account;
use Illuminate\Support\Facades\Storage;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;

class AccountMySqlRepository implements AccountRepositoryInterface
{
    public function __construct(private Account $account)
    {
    }

    public function list()
    {
        return $this->account::get();
    }

    public function findById(string $id): Account
    {
        return $this->account::findOrFail($id);
    }

    public function store($request): bool
    {
        $this->account::create([
        ]);


        return true;
    }

    public function update(string $id, $request): bool
    {

        $account = $this->account::findOrFail($id);

        $account->update([

        ]);



        return true;
    }

    public function delete(string $id): bool
    {
        $this->account::findOrFail($id)->delete();

        return true;
    }


    public function generatePDF()
    {
        $bankaccounts = Account::with('creator')->get();


        $data = [

        ];
        $pdf = PDF::loadView('myPDF', $data);

        $path = public_path('storage/exports/accounts/');
        $fileName = time() . '-accountsDetailes.pdf';
        $pdf->save($path . '/' . $fileName);
        return response()->json([
            'file_path' => asset('storage/exports/accounts/' . $fileName)
        ]);

    }
}
