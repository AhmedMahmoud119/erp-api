<?php

namespace App\Domains\BankAccount\Repositories;

use App\Domains\Account\Models\Account;
use App\Domains\Account\Repositories\AccountMySqlRepository;
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
            if (
                in_array(request()->sort_by, [
                    'id',
                    'code',
                    'name',
                    'account_number',
                    'holder_name',
                    'account_type',
                    'chart_of_account',
                    'currency_id',
                    'opening_balance',
                    'current_balance',
                    'creator_id',
                    'created_at',
                ])
            ) {
                $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
            }
            $q->orderBy('name', 'asc');
        })->when(request()->search, function ($q) {
            $q->where('name', 'like', '%' . request()->search . '%')->orWhere(
                'currency_id',
                'like',
                '%' . request()->search . '%'
            )->orWhere(
                'opening_balance',
                'like',
                '%' . request()->search . '%'
            )->orWhere(
                'account_number',
                'like',
                '%' . request()->search . '%'
            )->orWhere('account_type', 'like', '%' . request()->search . '%');
        })->when(request()->name, function ($q) {
            $q->where('name', 'like', '%' . request()->name . '%');
        })->when(request()->from, function ($q) {
            $q->whereDate('created_at', '>=', request()->from);
        })->when(request()->to, function ($q) {
            $q->whereDate('created_at', '<=', request()->to);
        })->when(request()->balance_from, function ($q) {
            $q->where('opening_balance', '>=', request()->balance_from);
        })->when(request()->balance_to, function ($q) {
            $q->where('opening_balance', '<=', request()->balance_to);
        })->when(request()->status, function ($q) {
            $q->where('status', '=', request()->status);
        })->when(request()->creator_id, function ($q) {
            $q->where('creator_id', request()->creator_id);
        })->with('creator', 'currency', 'parent:id,name')->paginate(request('limit', config('app.pagination_count')));
    }

    public function findById(string $id): BankAccount
    {
        $BankAccount = $this->bankAccount::findOrFail($id);
        $BankAccount->load('parent:id,name', 'creator', 'currency');
        return $BankAccount;
    }

    public function store($request): bool
    {

        $data = app(AccountMySqlRepository::class)->storeFromBankAccount($request->parent_account_id,$request->parent_expenses_account_id
            , $request->name);

        $this->bankAccount::create([
            'name' => $request->name,
            'code' => $this->generateCode($request->parent_account_id),
            'account_number' => $request->account_number,
            'holder_name' => $request->holder_name,
            'account_type' => $request->account_type,
            'account_id' => $data['account_id'],
            'expenses_account_id' => $data['expenses_account_id'],
            'parent_account_id' => $request->parent_account_id,
            'parent_expenses_account_id' => $request->parent_expenses_account_id,
            'currency_id' => $request->currency_id,
            'opening_balance' => $request->opening_balance,
            'current_balance' => $request->opening_balance,
            'authorized_by' => $request->authorized_by,
            'creator_id' => auth()->user()->id,
        ]);

        return true;
    }

    public function update(string $id, $request): bool
    {

        $bankAccount = $this->bankAccount::findOrFail($id);

        $bankAccount->update([
//            'code' => $this->generateCode($request->account_id),
            'name' => $request->name,
            'account_number' => $request->account_number,
            'holder_name' => $request->holder_name,
            'account_type' => $request->account_type,
            'authorized_by' => $request->authorized_by,
//            'account_id' => $request->account_id,
            'current_balance' => $request->current_balance,
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
        $bankaccounts = $this->list();


        $data = [
            'title' => 'Bank Accounts List',
            'date' => date('m/d/Y'),
            'bankaccounts' => $bankaccounts,
        ];
        $pdf = PDF::loadView('myPDF', $data);

        $path = public_path('storage/');
        $fileName = time() . '-bankAccountsDetailes.pdf';
        $pdf->save($path . $fileName);

        return response()->json([
            'file_path' => asset('storage/' . $fileName),
        ]);
    }

    /**
     * Generate new Bank Account code based on parent id
     * @param int $parentId
     * @return string
     */
    private function generateCode(int $parentId)
    {
        $account = Account::find($parentId);
        $lastBankAccount = $this->bankAccount::where('code', 'like', $account->code . '%')->whereRaw('LENGTH(code) = ?', [4])->orderBy('id', 'desc')->first();
        $lastBankAccountCode = $lastBankAccount ? ($lastBankAccount->code + 1) : $account->code . '0001';
        $code = str_pad($lastBankAccountCode, 12, '0', STR_PAD_LEFT);

        return $code;
    }
} // End Of Repo
