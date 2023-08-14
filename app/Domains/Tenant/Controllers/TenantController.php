<?php

namespace App\Domains\Tenant\Controllers;

use App\Domains\Tenant\Models\EnumPermissionTenant;
use App\Domains\Tenant\Request\FilterTenantRequest;
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

    public function list(FilterTenantRequest $request)
    {
        if(tenant('id')){
            return false;
        }
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionTenant::view_tenants->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return TenantResource::collection($this->tenantService->list());
    }

    public function delete($id)
    {
        if(tenant('id')){
            return false;
        }
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionTenant::delete_tenant->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->tenantService->delete($id);
        return response()->json([
            'message' => __('Deleted Successfully'),
            'status' => true,
        ], 200);
    }

    public function findById($id)
    {
        if(tenant('id')){
            return false;
        }
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionTenant::view_tenants->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TenantResource($this->tenantService->findById($id));
    }


    public function create(StoreTenantRequest $request)
    {
        if(tenant('id')){
            return false;
        }
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionTenant::create_tenant->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->tenantService->create($request);
        return response()->json([
            'message' => __('Created Successfully'),
            'status' => true,
        ], 200);
    }

    public function update($id, UpdateTenantRequest $request)
    {
        if(tenant('id')){
            return false;
        }
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionTenant::edit_tenant->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->tenantService->update($id, $request);
        return response()->json([
            'message' => __('Updated Successfully'),
            'status' => true,
        ], 200);
    }
}
