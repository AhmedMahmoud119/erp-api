<?php

namespace App\Domains\Vendor\Controllers;

use App\Domains\Vendor\Models\EnumPermissionVendor;
use App\Domains\Vendor\Request\StoreVendorRequest;
use App\Domains\Vendor\Request\UpdateVendorRequest;
use App\Domains\Vendor\Resources\VendorResource;
use App\Domains\Vendor\Services\VendorService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function __construct(private VendorService $vendorService)
    {
    }

    public function list()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionVendor::view_vendor->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return  VendorResource::collection($this->vendorService->list());
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionVendor::delete_vendor->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->vendorService->delete($id);
        return response()->json([
            'message' => __('Deleted Successfully'),
            'status' => true,
        ], 200);
    }

    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionVendor::view_vendor->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VendorResource($this->vendorService->findById($id));
    }

    public function create(StoreVendorRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionVendor::create_vendor->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->vendorService->create($request);
        return response()->json([
            'message' => __('Created Successfully'),
            'status' => true,
        ], 200);
    }

    public function update($id, UpdateVendorRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionVendor::edit_vendor->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->vendorService->update($id, $request);
        return response()->json([
            'message' => __('Updated Successfully'),
            'status' => true,
        ], 200);
    }
}
