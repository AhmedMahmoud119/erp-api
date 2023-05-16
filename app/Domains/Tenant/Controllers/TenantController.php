<?php

namespace App\Domains\Tenant\Controllers;

use App\Domains\Tenant\Models\EnumPermissionTenant;
use App\Domains\Tenant\Request\StoreTenantRequest;
use App\Domains\Tenant\Request\UpdateTenantRequest;
use App\Domains\Tenant\Resources\TenantResource;
use App\Domains\Tenant\Services\TenantService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenantController extends Controller
{
    public function __construct(private TenantService $tenantService)
    {
    }

    public function list()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionTenant::view_tenants->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return TenantResource::collection($this->tenantService->list());
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionTenant::delete_tenant->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->tenantService->delete($id);
        return response()->json([
            'message' => __('messages.deleted_successfully'),
            'status' => true,
        ], 200);
    }

    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionTenant::view_tenants->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TenantResource($this->tenantService->findById($id));
    }


    public function create(StoreTenantRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionTenant::create_tenant->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->tenantService->create($request);
        return response()->json([
            'message' => __('messages.created_successfully'),
            'status' => true,
        ], 200);
    }

    public function update($id, UpdateTenantRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionTenant::edit_tenant->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->tenantService->update($id, $request);
        return response()->json([
            'message' => __('messages.updated_successfully'),
            'status' => true,
        ], 200);
    }
}
