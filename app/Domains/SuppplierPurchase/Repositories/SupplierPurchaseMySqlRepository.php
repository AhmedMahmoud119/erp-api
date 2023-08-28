<?php

namespace App\Domains\SupplierPurchase\Repositories;

use App\Domains\SupplierPurchase\Interfaces\SupplierPurchaseRepositoryInterface;
use App\Domains\SupplierPurchase\Models\SupplierPurchase;

class SupplierPurchaseMySqlRepository implements SupplierPurchaseRepositoryInterface
{
    public function __construct(private SupplierPurchase $supplierPurchase)
    {
    }
    public function findById(string $id): SupplierPurchase
    {
        $supplierPurchase = $this->supplierPurchase::findOrFail($id);
        $supplierPurchase->load(['supplier', 'products', 'stock','creator']);
        return $supplierPurchase;
    }
    public function list()
    {
        return SupplierPurchase::when(request()->creator_id, function ($q) {
            return $q->where('creator_id', request()->creator_id);
        })->when(request()->sort_by, function ($q) {
            if (in_array(request()->sort_by, ['quantity', 'selling_price', 'purchasing_price', 'created_at', 'creator_id'])) {
                $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
            }
        })->with(['creator', 'product', 'warehouse'])
            ->orderBy('quantity')->paginate(request('limit', config('app.pagination_count')));
    }

    public function store($request): bool
    {
        $this->supplierPurchase::create($request->validated() + [
            'creator_id' => auth()->user()->id,
        ]);
        return true;
    }

    public function update(string $id, $request): bool
    {
        $supplierPurchase = $this->supplierPurchase::findOrFail($id);
        $supplierPurchase->update($request->validated() + [
            'creator_id' => auth()->user()->id,
        ]);
        return true;
    }

    public function delete(string $id): bool
    {
        $this->supplierPurchase::findOrFail($id)?->delete();

        return true;
    }

}
