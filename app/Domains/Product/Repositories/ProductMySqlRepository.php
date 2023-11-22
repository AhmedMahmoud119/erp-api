<?php

namespace App\Domains\Product\Repositories;

use App\Domains\Product\Interfaces\ProductRepositoryInterface;
use App\Domains\Product\Models\Product;
use App\Domains\Product\Models\Spec;
use Illuminate\Database\Eloquent\Collection;

class ProductMySqlRepository implements ProductRepositoryInterface
{
    public function __construct(private Product $product)
    {
    }
    public function findById(string $id): Product
    {
        $product =  $this->product::findOrFail($id);
        $product->load( 'creator', 'category', 'taxes', 'unit', 'specs' );
        return $product;

    }
    public function list()
    {
        return Product::when(request()->search, function ($q) {
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
                if (in_array(request()->sort_by, ['name', 'purchase_price', 'selling_price', 'creator_id'
                , 'quantity'])) {
                    $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
                }
            })->with(
                [
                    'category' => function ($query) {
                        $query->select('id', 'name');
                    },
                    'unit' => function ($query) {
                        $query->select('id', 'name');
                    },
                    'creator',
                    'taxes',
                    'specs'
                ]
            )
            ->orderBy('name')->paginate(request('limit', config('app.pagination_count')));

    }


    public function store($request): bool
    {
        $productData = $request->validated();
        $specsData = $productData['specs'];
        unset($productData['specs']);

        $product = $this->product::create($productData + [
            'creator_id' => auth()->user()->id,
        ]);

        $specIds = [];
        foreach ($specsData as $specData) {
            $specName = $specData['name'];
            $specValue = $specData['value'];
            $specId = Spec::firstOrCreate(['name' => $specName])->id;
            $specIds[$specId] = ['value'=>$specValue];
        }
        $product->specs()->sync($specIds);
        return true;
    }

    public function update(string $id, $request): bool
    {
        $productData = $request->validated();
        $specsData = $productData['specs'];
        unset($productData['specs']);

        $product = $this->product::findOrFail($id);
        $product->update($productData + [
            'creator_id' => auth()->user()->id,
        ]);
        $specIds = [];
        foreach ($specsData as $specData) {
            $specName = $specData['name'];
            $specValue = $specData['value'];
            $specId = Spec::firstOrCreate(['name' => $specName])->id;
            $specIds[$specId] = ['value'=>$specValue];
        }
        $product->specs()->sync($specIds);
        return true;
    }

    public function delete(string $id): bool
    {
        $this->product::findOrFail($id)->delete();

        return true;
    }
}
