<?php

namespace App\Domains\Pack\Repositories;

use App\Domains\Pack\Interfaces\PackRepositoryInterface;
use App\Domains\Pack\Models\Pack;
use Illuminate\Database\Eloquent\Collection;

class PackMySqlRepository implements PackRepositoryInterface
{
    public function __construct(private Pack $pack)
    {
    }
    public function findById(string $id): Pack
    {
        return $this->pack::findOrFail($id);
    }
    public function list()
    {
        return Pack::when(request()->search, function ($q) {
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
                if (in_array(request()->sort_by, ['name', 'quantity', 'purchase_price', 'selling_price', 'creator_id'])) {
                    $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
                }
            })->with(['creator', 'products'])
            ->orderBy('name')->paginate(request('limit', config('app.pagination_count')));

    }
    public function store($request): bool
    {
        $pack = $this->pack::create($request->validated() + [
            'creator_id' => auth()->user()->id
        ]);

        $pack->products()->attach($request->products);
        return true;
    }

    public function update(string $id, $request): bool
    {
        return true;
    }

    public function delete(string $id): bool
    {
        return true;
    }
}
