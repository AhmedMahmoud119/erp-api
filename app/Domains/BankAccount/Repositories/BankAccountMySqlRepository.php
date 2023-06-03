<?php

namespace App\Domains\BankAccount\Repositories;

use App\Domains\BankAccount\Interfaces\BankAccountRepositoryInterface;
use App\Domains\BankAccount\Models\BankAccount;
use Illuminate\Database\Eloquent\Collection;


use carbon\Carbon;
use Illuminate\Http\Request;

class BankAccountMySqlRepository implements BankAccountRepositoryInterface
{

    public function __construct(private BankAccount $bankAccount)
    {
    }

    public function list()
    {
        return $this->bankAccount::when(request()->sort_by, function ($q) {
            if (in_array(request()->sort_by, [
                'id',
                'name',
                'account_number',
                'holder_name',
                'account_type',
                'chart_of_account',
                'currency_id',
                'opening_balance',
                'creator_id',
                'created_at',
            ])) {
                $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
            }
            $q->orderBy('name', 'asc');
        })->when(request()->search, function ($q) {
            $q->where('name', 'like', '%' . request()->search . '%')->orwhere('currency_id', 'like',
                    '%' . request()->search . '%')->orwhere('opening_balance', 'like',
                    '%' . request()->search . '%')->orwhere('account_number', 'like',
                    '%' . request()->search . '%')->orwhere('account_type', 'like', '%' . request()->search . '%');

        })->when(request()->name, function ($q) {
            $q->where('name', request()->name);
        })->when(request()->from, function ($q) {
                $q->whereDate('created_at', '>=', request()->date_from);
            })->when(request()->to, function ($q) {
                $q->whereDate('created_at', '<=', request()->date_to);
            })->when(request()->creator_id, function ($q) {
                $q->where('creator_id', request()->creator_id);
            })->with('creator')->orderBy('name', 'asc')->paginate(request('limit', config('app.pagination_count')));
    }

    public function findById(string $id): BankAccount
    {
        return $this->bankAccount::findOrFail($id);
    }

    public function store($request): bool
    {
        $bankAccount = $this->bankAccount::create([
            'name'             => $request->name,
            'account_number'   => $request->account_number,
            'holder_name'      => $request->holder_name,
            'account_type'     => $request->account_type,
            'chart_of_account' => $request->chart_of_account,
            'currency_id'      => $request->currency_id,
            'authorized_by'    => $request->authorized_by,
            'creator_id'       => auth()->user()->id,

        ]);


        return true;
    }

    public function update(string $id, $request): bool
    {

        $bankAccount = $this->bankAccount::findOrFail($id);

        $bankAccount->update([
            'name'             => $request->name,
            'account_number'   => $request->account_number,
            'holder_name'      => $request->holder_name,
            'account_type'     => $request->account_type,
            'chart_of_account' => $request->chart_of_account,
            'currency_id'      => $request->currency_id,
            'status'           => $request->status,
            'creator_id'       => auth()->user()->id,
        ]);
        $bankAccount->users()->sync($request->authorized_by);


        return true;
    }

    public function delete(string $id): bool
    {
        $bankAccount = $this->bankAccount::findOrFail($id);
        if ($bankAccount) {

            $bankAccount->users()->detach();
            $bankAccount->delete();
        }

        return true;
    }

}
