<?php

namespace App\Domains\BankAccount\Repositories;

use App\Domains\BankAccount\Interfaces\BankAccountRepositoryInterface;
use App\Domains\BankAccount\Models\BankAccount;
use Illuminate\Support\Facades\Storage;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;

class BankAccountMySqlRepository implements BankAccountRepositoryInterface
{
    public function __construct(private BankAccount $bankAccount)
    {
    }

    public function list()
    {
        return $this->bankAccount::when(request()->sort_by, function ($q) {
            if (in_array(request()->sort_by, ['id','name', 'account_number', 'holder_name','account_type', 'chart_of_account', 'currency_id', 'opening_balance','current_balance','creator_id','created_at'])) {
                $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
            }
            $q->orderBy('name', 'asc');
        })->when(request()->search,function ($q)
            {
                $q->where('name','like','%' . request()->search . '%')
                    ->orwhere('currency_id','like','%' . request()->search . '%')
                    ->orwhere('opening_balance','like','%' . request()->search . '%')
                    ->orwhere('account_number','like','%' . request()->search . '%')
                    ->orwhere('account_type','like','%' . request()->search . '%');

            })  ->when(request()->name,function ($q){
            $q->where('name',request()->name );
             })
            ->when(request()->from, function ($q) {
                $q->whereDate('created_at', '>=', request()->from);
            })->when(request()->to, function ($q) {
                $q->whereDate('created_at', '<=', request()->to);
            })
            ->when(request()->balance_from, function ($q) {
                $q->where('opening_balance', '>=', request()->balance_from);
            })->when(request()->balance_to, function ($q) {
                $q->where('opening_balance', '<=', request()->opening_balance);
            })
            ->when(request()->status, function ($q) {
                $q->where('status', '=', request()->status);
            })
            ->when(request()->creator_id,function ($q){
                $q->where('creator_id',request()->creator_id );
            })->with('creator','currency')
            ->orderBy('name', 'asc')->get();
    }
    public function findById(string $id) :BankAccount
    {
        return $this->bankAccount::findOrFail($id);
    }

    public function store($request):bool
    {
        $this->bankAccount::create([
            'name' => $request->name ,
            'account_number' => $request->account_number ,
            'holder_name' => $request->holder_name ,
            'account_type' => $request->account_type ,
            'chart_of_account' => $request->chart_of_account,
            'currency_id' => $request->currency_id,
            'opening_balance'=>$request->opening_balance,
            'current_balance'=>$request->opening_balance,
            'authorized_by' => $request->authorized_by,
            'creator_id' => auth()->user()->id ,

        ]);


        return true;
    }

    public function update(string $id, $request):bool
    {

        $bankAccount = $this->bankAccount::findOrFail($id);

            $bankAccount->update([
                'name' => $request->name ,
                'account_number' => $request->account_number,
                'holder_name' => $request->holder_name,
                'account_type' => $request->account_type ,
                'authorized_by' => $request->authorized_by,
                'chart_of_account' => $request->chart_of_account,
                'current_balance'=>$request->current_balance,
                'currency_id' => $request->currency_id,
                'status' => $request->status,
            ]);


        return true;
    }

    public function delete(string $id): bool
    {
         $this->bankAccount::findOrFail($id)->delete();

        return true;
    }



    public function generatePDF()
    {
        $bankaccounts = BankAccount::with('creator')->get();


        $data = [
            'title' => 'Bank Accounts List',
            'date' => date('m/d/Y'),
            'bankaccounts' => $bankaccounts
        ];
        $pdf = PDF::loadView('myPDF', $data);

        $path = public_path('storage/exports/bankAccounts/');
        $fileName = time(). '-bankAccountsDetailes.pdf' ;
            $pdf->save($path . '/' . $fileName);
        return response()->json([
            'file_path' =>  asset('storage/exports/bankAccounts/'. $fileName)
        ]);

    }
}
