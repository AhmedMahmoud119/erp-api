<?php

namespace App\Domains\SupplierPurchase\Controllers;

use App\Domains\SupplierPurchase\Models\EnumPermissionSupplierPurchase;
use App\Domains\SupplierPurchase\Request\StoreSupplierPurchaseRequest;
use App\Domains\SupplierPurchase\Request\UpdateSupplierPurchaseRequest;
use App\Domains\SupplierPurchase\Resources\SupplierPurchaseResource;
use App\Domains\SupplierPurchase\Services\SupplierPurchaseService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;

class SupplierPurchaseController extends Controller
{
    public function __construct(private SupplierPurchaseService $supplierPurchaseService)
    {
    }
    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionSupplierPurchase::view_supplierPurchases->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new SupplierPurchaseResource($this->supplierPurchaseService->findById($id));
    }

    public function list()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionSupplierPurchase::view_supplierPurchases->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return SupplierPurchaseResource::collection($this->supplierPurchaseService->list());
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionSupplierPurchase::delete_supplierPurchase->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->supplierPurchaseService->delete($id);
        return response()->json([
            'message' => __('Purchase deleted successfully!'),
            'status' => true,
        ], 200);
    }

    public function create(StoreSupplierPurchaseRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionSupplierPurchase::create_supplierPurchase->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->supplierPurchaseService->create($request);
        return response()->json([
            'message' => __('Purchase created successfully!'),
            'status' => true,
        ], 200);
    }

    public function update($id, UpdateSupplierPurchaseRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionSupplierPurchase::edit_supplierPurchase->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->supplierPurchaseService->update($id, $request);
        return response()->json([
            'message' => __('Purchase information updated successfully!'),
            'status' => true,
        ], 200);
    }

}