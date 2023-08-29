<?php

namespace App\Domains\SupplierPurchase\Repositories;

use App\Domains\Product\Models\Product;
use App\Domains\SupplierPurchase\Interfaces\SupplierPurchaseRepositoryInterface;
use App\Domains\SupplierPurchase\Models\SupplierPurchase;
use App\Domains\Tax\Models\Tax;

class SupplierPurchaseMySqlRepository implements SupplierPurchaseRepositoryInterface
{
    public function __construct(private SupplierPurchase $supplierPurchase)
    {
    }
    public function findById(string $id): SupplierPurchase
    {
        $supplierPurchase = $this->supplierPurchase::findOrFail($id);
        $supplierPurchase->load(['supplier', 'products', 'stock', 'creator', 'taxes']);
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
        })->with(['supplier', 'products', 'stock', 'creator', 'taxes'])
            ->orderBy('date')->paginate(request('limit', config('app.pagination_count')));
    }

    public function store($request): bool
    {
        $data = $request->all();
        $subtotal = 0;
        // Calc total price for each product after its discount
        foreach ($data['products'] as $productData) {
            $product = Product::find($productData['product_id']);
            $discountValue = ($productData['discount'] / 100) * $product->selling_price;
            $product_price = $product->selling_price - $discountValue;
            $subtotal += $productData['quantity'] * $product_price;
        }
        $taxes = [];
        foreach ($data['taxes'] as $taxData) {
            $taxes[] = $taxData['tax_id'];
        }
        $taxAmount = Tax::whereIn('id', $taxes)->sum('percentage');
        $totalTax = $subtotal * $taxAmount / 100;
        $totalAmount = $subtotal + $totalTax;

        $purchase = $this->supplierPurchase::create($request->validated() + [
            'creator_id' => auth()->user()->id,
            'total' => $totalAmount,
        ]);
        $purchase->products()->sync($data['products']);
        $purchase->taxes()->sync($data['taxes']);
        return true;
    }

    public function update(string $id, $request): bool
    {
        $supplierPurchase = $this->supplierPurchase::findOrFail($id);
        $data = $request->all();
        $subtotal = 0;
        foreach ($data['products'] as $productData) {
            $product = Product::find($productData['product_id']);
            $discountValue = ($productData['discount'] / 100) * $product->selling_price;
            $product_price = $product->selling_price - $discountValue;
            $subtotal += $productData['quantity'] * $product_price;
        }
        $taxes = [];
        foreach ($data['taxes'] as $taxData) {
            $taxes[] = $taxData['tax_id'];
        }
        $taxAmount = Tax::whereIn('id', $taxes)->sum('percentage');
        $totalTax = $subtotal * $taxAmount / 100;
        $totalAmount = $subtotal + $totalTax;

        $supplierPurchase->update($request->validated() + [
            'creator_id' => auth()->user()->id,
            'total' => $totalAmount,
        ]);
        $supplierPurchase->products()->sync($data['products']);
        $supplierPurchase->taxes()->sync($data['taxes']);
        return true;
    }

    public function delete(string $id): bool
    {
        $this->supplierPurchase::findOrFail($id)?->delete();

        return true;
    }

}