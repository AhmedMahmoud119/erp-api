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
        $pack = $this->pack::findOrFail($id);
        $pack->load(['creator', 'products']);
        return $pack;
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
                $q->where('creator_id', request()->creator_id);
            })
            ->when(request()->filled('quantity_from'), function ($q) {
                $q->where('quantity', '>=', request()->quantity_from);
            })
            ->when(request()->filled('quantity_to'), function ($q) {
                $q->where('quantity', '<=', request()->quantity_to);
            })
            ->when(request()->filled('price'), function ($q) {
                $q->where('price', '<', (request()->price + 1));
                $q->where('price', '>=', (request()->price));
            })
            ->when(request()->sort_by, function ($q) {
                if (in_array(request()->sort_by, ['id', 'name', 'quantity', 'price', 'creator_id'])) {
                    $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
                }
            })->with(['creator:name,id,email', 'products:id,code,name'])
            ->orderBy('name')->paginate(request('limit', config('app.pagination_count')));

    }
    public function store($request): bool
    {
        $pack = $this->pack::create($request->validated() + [
            'creator_id' => auth()->user()->id
        ]);

        $pack->products()->sync($request->products);
        return true;
    }

    public function update(string $id, $request): bool
    {
        $pack = $this->pack::findOrFail($id);
        $pack->update($request->validated() + [
            'creator_id' => auth()->user()->id
        ]);
        $pack->products()->sync($request->products);
        return true;
    }

    public function delete(string $id): bool
    {
        $this->pack::findOrFail($id)?->delete();

        return true;
    }
}
