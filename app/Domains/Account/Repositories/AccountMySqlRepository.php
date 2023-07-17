<?php

namespace App\Domains\Account\Repositories;

use App\Domains\Account\Interfaces\AccountRepositoryInterface;
use App\Domains\Account\Models\Account;
use App\Domains\Group\Models\Group;
class AccountMySqlRepository implements AccountRepositoryInterface
{

    public function __construct(private Account $account)
    {
    }

    public function list()
    {
        return $this->account::when(request()->sort_column, function ($q, $v) {
            $q->orderBy(request()->sort_column, request()->sort_type ?? 'asc');
        })->when(request()->name, function ($q, $v) {
            $q->where('name','like', '%'.request()->name.'%');
        })->when(request()->group_id, function ($q, $v) {
            $q->where('group_id',request()->group_id);
        })->when(request()->creator_id, function ($q, $v) {
            $q->where('creator_id',request()->creator_id);
        })->when(request()->from_date, function ($q, $v) {
            $q->whereDate('created_at','>=',request()->from_date);
        })->when(request()->to_date, function ($q, $v) {
            $q->whereDate('created_at','<=',request()->to_date);
        })->get();
    }

    public function findById(string $id): Account
    {
        return $this->account::findOrFail($id);
    }

    public function store($request): bool
    {
        $group = Group::find($request->group_id);
        $lastAccount = Account::where('code', 'like', $group->code . '%')->orderBy('id', 'desc')->first();

        $lastAccountCode = $lastAccount ? ($lastAccount->code + 1) : $group->code . '0001';
        $code = str_pad($lastAccountCode, 8, '0', STR_PAD_LEFT);

        $this->account::create($request->all() + [
                'code'       => $code,
                'creator_id' => auth()->user()->id,
            ]);

        return true;
    }

    public function update(string $id, $request): bool
    {
        $account = $this->account::findOrFail($id);
        $account->update($request->except('code'));

        return true;
    }

    public function delete(string $id): bool
    {
        $this->account::findOrFail($id)->delete();

        return true;
    }
    public function bulkDelete(): bool
    {
        $this->account::whereIn('id',request()->ids??[])->delete();

        return true;
    }

}
