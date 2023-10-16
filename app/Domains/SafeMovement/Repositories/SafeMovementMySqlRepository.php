<?php

namespace App\Domains\SafeMovement\Repositories;

use App\Domains\Account\Models\Account;
use App\Domains\SafeMovement\Interfaces\SafeMovementRepositoryInterface;
use App\Domains\SafeMovement\Models\SafeMovement;

class SafeMovementMySqlRepository implements SafeMovementRepositoryInterface
{
    public function __construct(private SafeMovement $safeMovement)
    {
    }

    public function list()
    {
        $safeMovements = $this->safeMovement::when(request()->date, function ($q) {
            $q->whereDate('date', '>=', request()->date);
        })->when(request()->sort_by, function ($q) {
            if (in_array(request()->sort_by, ['created_at', 'id', 'creator_id'])) {
                $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
            }
        })->orderBy('updated_at', 'desc')->with(['creator'])->paginate(request('limit', config('app.pagination_count')));

        return $safeMovements;
    }


    public function findById(string $id): SafeMovement
    {
        return $this->safeMovement::findOrFail($id);
    }
    public function store($request)
    {

        return true;
    }

    public function update(string $id, $request): bool
    {

        return true;
    }

    public function delete(string $id): bool
    {
        $this->safeMovement::findOrFail($id)?->delete();
        return true;
    }

}
