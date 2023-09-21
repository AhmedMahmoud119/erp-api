<?php

namespace App\Domains\Purchase\Repositories;

use App\Domains\Customer\Models\Customer;
use App\Domains\Product\Models\Product;
use App\Domains\Supplier\Models\Supplier;
use App\Domains\Purchase\Interfaces\PurchaseRepositoryInterface;
use App\Domains\Purchase\Models\Purchase;
use App\Domains\Tax\Models\Tax;
use App\Domains\Vendor\Models\Vendor;

class PurchaseMySqlRepository implements PurchaseRepositoryInterface
{
    public function __construct(private Purchase $purchase)
    {
    }
    public function findById(string $id): Purchase
    {
        $purchase = $this->purchase::findOrFail($id);
        $purchase->load(['products', 'stock', 'creator', /*'taxes',*/ 'purchasable']);
        return $purchase;
    }
    public function list()
    {
        return Purchase::when(request()->creator_id, function ($q) {
            return $q->where('creator_id', request()->creator_id);
        })
        ->when(request()->sort_by, function ($q) {
            if (in_array(request()->sort_by, ['quantity', 'selling_price', 'purchasing_price', 'created_at', 'creator_id'])) {
                $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
            }
        })
        ->when(request()->type, function ($q) {
            return $q->where('purchasable_type','like', '%'.request()->type.'%');
        })
        ->with(['products', 'stock', 'creator', /*'taxes',*/ 'purchasable'])
            ->orderBy('date')->paginate(request('limit', config('app.pagination_count')));
    }

    public function store($request): bool
    {
        $data = $request->validated();
        $subtotal = 0;
        // Calc total price for each product after its discount
        foreach ($data['products'] as $productData) {
            $product = Product::find($productData['product_id']);
            $discountValue = ($productData['discount'] / 100) * $product->selling_price;
            $product_price = $product->selling_price - $discountValue;
            $subtotal += $productData['quantity'] * $product_price;
        }
//        $taxes = [];
//        foreach ($data['taxes'] as $taxData) {
//            $taxes[] = $taxData['tax_id'];
//        }
//        $taxAmount = Tax::whereIn('id', $taxes)->sum('percentage');
//        $totalTax = $subtotal * $taxAmount / 100;
        $totalAmount = $subtotal /*+ $totalTax*/;

        $purchase = $this->purchase::create($request->validated() + [
            'creator_id' => auth()->user()->id,
            'total' => $totalAmount,
        ]);
        $purchase->products()->sync($data['products']);
//        $purchase->taxes()->sync($data['taxes']);
        if ($request->supplier_id) {
            $supplier = Supplier::find($request->supplier_id);
            $supplier->purchase()->save($purchase);
        }elseif ($request->vendor_id){
            $vendor = Vendor::find($request->vendor_id);
            $vendor->purchase()->save($purchase);
        }elseif ($request->customer_id){
            $customer = Customer::find($request->customer_id);
            $customer->purchase()->save($purchase);
        }
        return true;
    }

    public function update(string $id, $request): bool
    {
        $purchase = $this->purchase::findOrFail($id);
        $data = $request->validated();
        $subtotal = 0;
        foreach ($data['products'] as $productData) {
            $product = Product::find($productData['product_id']);
            $discountValue = ($productData['discount'] / 100) * $product->selling_price;
            $product_price = $product->selling_price - $discountValue;
            $subtotal += $productData['quantity'] * $product_price;
        }
//        $taxes = [];
//        foreach ($data['taxes'] as $taxData) {
//            $taxes[] = $taxData['tax_id'];
//        }
//        $taxAmount = Tax::whereIn('id', $taxes)->sum('percentage');
//        $totalTax = $subtotal * $taxAmount / 100;
        $totalAmount = $subtotal /*+ $totalTax */;

        $purchase->update($request->validated() + [
            'creator_id' => auth()->user()->id,
            'total' => $totalAmount,
        ]);
        $purchase->products()->sync($data['products']);
//        $purchase->taxes()->sync($data['taxes']);
        if ($request->supplier_id) {
            $supplier = Supplier::find($request->supplier_id);
            $supplier->purchase()->save($purchase);
        }elseif ($request->vendor_id){
            $vendor = Vendor::find($request->vendor_id);
            $vendor->purchase()->save($purchase);
        }elseif ($request->customer_id){
            $customer = Customer::find($request->customer_id);
            $customer->purchase()->save($purchase);
        }

        return true;
    }

    public function delete(string $id): bool
    {
        $this->purchase::findOrFail($id)?->delete();

        return true;
    }

}
