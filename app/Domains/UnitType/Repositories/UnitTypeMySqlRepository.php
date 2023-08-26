<?php

namespace App\Domains\UnitType\Repositories;

use App\Domains\UnitType\Interfaces\UnitTypeRepositoryInterface;
use App\Domains\UnitType\Models\UnitType;

class UnitTypeMySqlRepository implements UnitTypeRepositoryInterface
{
    public function __construct(private UnitType $unitType)
    {
    }
    public function list()
    {
        return UnitType::when(request()->search, function ($q) {
            $searchTerm = '%' . request()->search . '%';
            $q->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                    ->orWhere('description', 'like', $searchTerm);
            });
        })
            ->when(request()->creator_id, function ($q) {
                return $q->where('creator_id', request()->creator_id);
            })
            ->when(request()->sort_by, function ($q) {
                if (in_array(request()->sort_by, ['name', 'creator_id'])) {
                    $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
                }
            })
            ->with('creator')
            ->orderBy('name')->paginate(request('limit', config('app.pagination_count')));
    }
    public function findById(string $id): UnitType
    {
        return $this->unitType::findOrFail($id);
    }

    public function store($request): bool
    {
        $this->unitType::create($request->validated() + [
            'creator_id' => auth()->user()->id,
        ]);
        return true;
    }

    public function update(string $id, $request): bool
    {
        $unitType = $this->unitType::findOrFail($id);
        $unitType->update($request->validated() + [
            'creator_id' => auth()->user()->id,
        ]);
        return true;
    }

    public function delete(string $id): bool
    {
        $this->unitType::findOrFail($id)?->delete();

        return true;
    }
}
