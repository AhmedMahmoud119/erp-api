<?php

namespace App\Domains\CashManagment\Repositories;

use App\Domains\Account\Models\Account;
use App\Domains\CashManagment\Interfaces\CashManagmentRepositoryInterface;
use App\Domains\CashManagment\Models\CashManagment;

class CashManagmentMySqlRepository implements CashManagmentRepositoryInterface
{
    public function __construct(private CashManagment $cashManagment)
    {
    }

    public function list()
    {
        $cashManagments = $this->cashManagment::when(request()->date, function ($q) {
            $q->whereDate('date', '>=', request()->date);
        })->when(request()->sort_by, function ($q) {
            if (in_array(request()->sort_by, ['created_at', 'id', 'creator_id'])) {
                $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
            }
        })->orderBy('updated_at', 'desc')->with(['creator'])->paginate(request('limit', config('app.pagination_count')));

        return $cashManagments;
    }


    public function findById(string $id): CashManagment
    {
        return $this->cashManagment::findOrFail($id);
    }
    public function store($request)
    {
        $this->cashManagment::create($request->validated +[
            'creator_id'=> auth()->user()->id,
        ]);

        return true;
    }

    public function update(string $id, $request): bool
    {

        return true;
    }

    public function delete(string $id): bool
    {
        $this->cashManagment::findOrFail($id)?->delete();
        return true;
    }

}
