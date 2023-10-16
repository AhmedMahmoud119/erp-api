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
            'code' => $code,
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
}
