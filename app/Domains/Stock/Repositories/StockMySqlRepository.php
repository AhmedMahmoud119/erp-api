<?php

namespace App\Domains\Stock\Repositories;

use App\Domains\Product\Models\Product;
use App\Domains\Stock\Interfaces\StockRepositoryInterface;
use App\Domains\Stock\Models\Stock;

class StockMySqlRepository implements StockRepositoryInterface
{
    public function __construct(private Stock $stock)
    {
    }
    public function findById(string $id): Stock
    {
        $stock = $this->stock::findOrFail($id);
        $stock->load(['creator', 'product', 'warehouse']);
        return $stock;
    }
    public function list()
    {
        return Stock::when(request()->creator_id, function ($q) {
            return $q->where('creator_id', request()->creator_id);
        })
            ->when(request()->sort_by, function ($q) {
                if (in_array(request()->sort_by, ['quantity', 'created_at', 'creator_id'])) {
                    $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
                }
            })
            ->with(['creator', 'product', 'warehouse'])
            ->orderBy('quantity')->paginate(request('limit', config('app.pagination_count')));
    }

    public function store($request): bool
    {
        $product = Product::findOrFail($request->product_id);

        $this->stock::create($request->validated() + [
            'creator_id' => auth()->user()->id,
        ]);
        return true;
    }

    public function update(string $id, $request): bool
    {
        return true;
    }

    public function delete(string $id): bool
    {
        $this->stock::findOrFail($id)?->delete();

        return true;
    }

}