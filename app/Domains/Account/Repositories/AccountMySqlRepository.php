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
        return $this->account::when(request()->search, function ($q) {
            $q->where('name', 'like', '%' . request()->search . '%')
                ->orWhere('code', 'like', '%' . request()->search . '%');
        })->when(request()->group_id, function ($q) {
            $q->where('group_id', request()->group_id);
        })->when(request()->creator_id, function ($q) {
            $q->where('creator_id', request()->creator_id);
        })->when(request()->from, function ($q) {
            $q->whereDate('created_at', '>=', request()->from);
        })->when(request()->to, function ($q) {
            $q->whereDate('created_at', '<=', request()->to);
        })->when(request()->sort_by, function ($q) {
            if (in_array(request()->sort_by, ['name', 'code', 'created_at', 'updated_at', 'opening_balance', 'account_type', 'group_id', 'creator_id', 'parent_id'])) {
                if (request()->sort_by == 'group_id') {
                    $q->whereHas('group', function ($q) {
                        $q->orderBy('name', request()->sort_type);
                    });
                } elseif (request()->sort_by == 'creator_id') {
                    $q->whereHas('creator', function ($q) {
                        $q->orderBy('name', request()->sort_type);
                    });
                } elseif (request()->sort_by == 'parent_id') {
                    $q->whereHas('parent', function ($q) {
                        $q->orderBy('name', request()->sort_type);
                    });
                } else {

                    $q->orderBy(request()->sort_by, request()->sort_type);
                }
            }
            return $q;
        })->orderBy('updated_at', 'desc')
            ->with(['group', 'creator', 'parent'])
            ->paginate(request('limit', config('app.pagination_count')));
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
                'code' => $this->generateCode($request->group_id),
                'creator_id' => auth()->user()->id,
            ]);

        return true;
    }

    public function storeFromBankAccount($parent_account_id, $parent_expenses_account_id, $name)
    {
        $parent = $this->account::find($parent_account_id);
        $group = Group::find($parent->group_id);

        $lastAccount = Account::where('code', 'like', $group->code . '%')->orderBy('id', 'desc')->first();

        $lastAccountCode = $lastAccount ? ($lastAccount->code + 1) : $group->code . '0001';
        $code = str_pad($lastAccountCode, 8, '0', STR_PAD_LEFT);

        $account = $this->account::create([
            'name' => $name,
            'group_id' => $parent->group_id,
            'parent_id' => $parent_account_id,
            'is_parent' => 0,
            'opening_balance' => 0,
            'account_type' => $parent->account_type,
            'code' => $code,
            'creator_id' => auth()->user()->id,
        ]);


        $parent_expenses = $this->account::find($parent_expenses_account_id);
        $group = Group::find($parent_expenses->group_id);

        $lastAccount = Account::where('code', 'like', $group->code . '%')->orderBy('id', 'desc')->first();

        $lastAccountCode = $lastAccount ? ($lastAccount->code + 1) : $group->code . '0001';
        $code = str_pad($lastAccountCode, 8, '0', STR_PAD_LEFT);

        $expenses_account = $this->account::create([
            'name' => 'expenses '.$name,
            'group_id' => $parent_expenses->group_id,
            'parent_id' => $parent_expenses_account_id,
            'is_parent' => 0,
            'opening_balance' => 0,
            'account_type' => $parent_expenses->account_type,
            'code' => $code,
            'creator_id' => auth()->user()->id,
        ]);

        return [
            'account_id' => $account->id,
            'expenses_account_id' => $expenses_account->id,
        ];
    }


    public function storeFromSupplier($parent_account_id, $name)
    {
        $parent = $this->account::find($parent_account_id);
        $group = Group::find($parent->group_id);

        $lastAccount = Account::where('code', 'like', $group->code . '%')->orderBy('id', 'desc')->first();

        $lastAccountCode = $lastAccount ? ($lastAccount->code + 1) : $group->code . '0001';
        $code = str_pad($lastAccountCode, 8, '0', STR_PAD_LEFT);

        $account = $this->account::create([
            'name' => $name,
            'group_id' => $parent->group_id,
            'parent_id' => $parent_account_id,
            'is_parent' => 0,
            'opening_balance' => 0,
            'account_type' => $parent->account_type,
            'code' => $code,
            'creator_id' => auth()->user()->id,
        ]);

        return [
            'account_id' => $account->id,
        ];
    }

    public function update(string $id, $request): bool
    {
        $account = $this->account::findOrFail($id);
        $account->update($request->except('code')+['code' => $this->generateCode($request->group_id)]);

        return true;
    }

    public function delete(string $id): bool
    {
        $account = $this->account::findOrFail($id);

        if ($account->journalEntryDetail->isEmpty()) {
            $account->delete();
            return true;
        } else {
            return false;
        }
    }

    public function bulkDelete(): bool
    {
        $accounts = $this->account::whereIn('id', request()->ids ?? [])->get();

        if ($accounts->pluck('journalEntryDetail')->flatten()->isEmpty()) {
            $accounts->delete();
            return true;
        } else {
            return false;
        }

    }

    public function parents()
    {
        return $this->account::where('is_parent', 1)->get();
    }

    public function notParents()
    {
        return $this->account::where('is_parent', 0)->when(request()->has('parent_id'),function($q){
            $q->where('parent_id', request()->parent_id);
        })->get();
    }
    private function generateCode(int $parentId)
    {
        $group = Group::find($parentId);
        $lastAccount = Account::where('code', 'like', $group->code . '%')->whereRaw('LENGTH(code) = ?', [8])->orderBy('id', 'desc')->first();

        $lastAccountCode = $lastAccount ? ($lastAccount->code + 1) : $group->code . '0001';
        $code = str_pad($lastAccountCode, 8, '0', STR_PAD_LEFT);

        return $code;
    }
}
