<?php

namespace App\Domains\SafeMovement\Repositories;

use App\Domains\Account\Models\Account;
use App\Domains\SafeMovement\Interfaces\SafeMovementRepositoryInterface;
use App\Domains\SafeMovement\Models\SafeMovement;
use DB;

class SafeMovementMySqlRepository implements SafeMovementRepositoryInterface
{
    public function __construct(private SafeMovement $safeMovement)
    {
    }

    public function list()
    {
        $safeMovements = $this->safeMovement::when(request()->search, function ($q) {
            $q->where('description', 'like', '%' . request()->search . '%');
        })->when(request()->date, function ($q) {
            $q->whereDate('date', '>=', request()->date);
        })->when(request()->source, function ($q) {
            $q->where('source_id', request()->source);
        })->when(request()->amount, function ($q) {
            $q->where('amount', '>=', (request()->amount));
            $q->where('amount', '<', (request()->amount + 1));
        })->when(request()->destination, function ($q) {
            $q->where('destination_id', request()->destination);
        })->when(request()->sort_by, function ($q) {
            if (in_array(request()->sort_by, ['date', 'amount', 'source_id', 'destination_id', 'created_at', 'id', 'creator_id'])) {
                $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
            }
        })->orderBy('updated_at', 'desc')->with(['creator:id,name', 'destination:id,name', 'source:id,name'])->paginate(request('limit', config('app.pagination_count')));

        return $safeMovements;
    }


    public function findById(string $id): SafeMovement
    {
        $safeMovement = $this->safeMovement::findOrFail($id);
        $safeMovement->load(['creator:id,name', 'destination:id,name', 'source:id,name']);
        return $safeMovement;
    }
    public function store($request)
    {
        try {
            DB::beginTransaction();
            $this->safeMovement::create($request->validated() + [
                'creator_id' => auth()->user()->id,
            ]);
            DB::commit();
            return true;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

    }

    public function update(string $id, $request): bool
    {
        try {
            DB::beginTransaction();
            $safeMovement = $this->safeMovement::findOrFail($id);
            $safeMovement->update($request->validated());
            DB::commit();
            return true;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(string $id): bool
    {
        $this->safeMovement::findOrFail($id)?->delete();
        return true;
    }

}
