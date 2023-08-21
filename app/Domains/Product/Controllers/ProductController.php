<?php

namespace App\Domains\Product\Controllers;

use App\Domains\Product\Models\EnumPermissionProduct;
use App\Domains\Product\Request\StoreProductRequest;
use App\Domains\Product\Request\UpdateProductRequest;
use App\Domains\Product\Resources\ProductResource;
use App\Domains\Product\Services\ProductService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService)
    {
    }

    public function list()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionProduct::view_products->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return ProductResource::collection($this->productService->list());
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionProduct::delete_product->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->productService->delete($id);
        return response()->json([
            'message' => __('Product moved to trash!'),
            'status' => true,
        ], 200);
    }

    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionProduct::view_products->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductResource($this->productService->findById($id));
    }

    public function create(StoreProductRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionProduct::create_product->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->productService->create($request);
        return response()->json([
            'message' => __('Product Created Successfully!'),
            'status' => true,
        ], 200);
    }

    public function update($id, UpdateProductRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionProduct::edit_product->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->productService->update($id, $request);
        return response()->json([
            'message' => __('Product Updated Successfully!'),
            'status' => true,
        ], 200);
    }

}
