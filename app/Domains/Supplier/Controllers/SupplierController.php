<?php

namespace App\Domains\Supplier\Controllers;

use App\Domains\Supplier\Models\EnumPermissionSupplier;
use App\Domains\Supplier\Request\StoreSupplierRequest;
use App\Domains\Supplier\Request\UpdateSupplierRequest;
use App\Domains\Supplier\Resources\SupplierResource;
use App\Domains\Supplier\Services\SupplierService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct(private SupplierService $supplierService)
    {
    }

    public function list()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionSupplier::view_suppliers->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return  SupplierResource::collection($this->supplierService->list());
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionSupplier::delete_supplier->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->supplierService->delete($id);
        return response()->json([
            'message' => __('Supplier deleted successfully!'),
            'status' => true,
        ], 200);
    }

    public function create(StoreSupplierRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionSupplier::create_supplier->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->supplierService->create($request);
        return response()->json([
            'message' => __('Supplier created successfully!'),
            'status' => true,
        ], 200);
    }

    public function update($id, UpdateSupplierRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionSupplier::edit_supplier->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (!$this->supplierService->update($id, $request))
        {
            return response()->json([
                'message' => __('Could not find the Supplier information!'),
                'status' => false,
            ], 422);
        }

       return response()->json([
                'message' => __('Supplier information updated successfully!'),
                'status' => true,
            ], 200);

    }
}
