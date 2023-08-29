<?php

namespace App\Domains\Purchase\Controllers;

use App\Domains\Purchase\Models\EnumPermissionPurchase;
use App\Domains\Purchase\Request\StorePurchaseRequest;
use App\Domains\Purchase\Request\UpdatePurchaseRequest;
use App\Domains\Purchase\Resources\PurchaseResource;
use App\Domains\Purchase\Services\PurchaseService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function __construct(private PurchaseService $purchaseService)
    {
    }
    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionPurchase::view_purchases->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new PurchaseResource($this->purchaseService->findById($id));
    }

    public function list()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionPurchase::view_purchases->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return PurchaseResource::collection($this->purchaseService->list());
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionPurchase::delete_purchase->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->purchaseService->delete($id);
        return response()->json([
            'message' => __('Purchase deleted successfully!'),
            'status' => true,
        ], 200);
    }

    public function create(StorePurchaseRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionPurchase::create_purchase->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->purchaseService->create($request);
        return response()->json([
            'message' => __('Purchase created successfully!'),
            'status' => true,
        ], 200);
    }

    public function update($id, UpdatePurchaseRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionPurchase::edit_purchase->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->purchaseService->update($id, $request);
        return response()->json([
            'message' => __('Purchase information updated successfully!'),
            'status' => true,
        ], 200);
    }

}
