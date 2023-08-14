<?php

namespace App\Domains\Role\Controllers;

use App\Domains\Permission\Models\EnumPermissionRole;
use App\Domains\Role\Request\DeleteRoleRequest;
use App\Domains\Role\Request\StoreRoleRequest;
use App\Domains\Role\Request\UpdateRoleRequest;
use App\Domains\Role\Resources\RolePermissionsResource;
use App\Domains\Role\Resources\RoleResource;
use App\Domains\Role\Services\RoleService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    public function __construct(private RoleService $roleService)
    {
    }

    public function list()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionRole::view_roles->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return RolePermissionsResource::collection($this->roleService->list());
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionRole::delete_role->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($this->roleService->delete($id)) {


            return response()->json([
                'message' => __('Deleted Successfully'),
                'status' => true,

            ], 200);
        }
        return response()->json([
            'message' => __("can not delete because the role assigned to users"),
            'status' => false,

        ], 402);
    }

    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionRole::view_roles->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RolePermissionsResource($this->roleService->findById($id));
    }

    public function create(StoreRoleRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionRole::create_role->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->roleService->create($request);
        return response()->json([
            'message' => __('Created Successfully'),
            'status' => true,

        ], 200);
    }

    public function update($id, UpdateRoleRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionRole::edit_role->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($this->roleService->update($id, $request)) {
            return response()->json([
                'message' => __('Updated Successfully'),
                'status' => true,

            ], 200);
        }
        return response()->json([
            'message' => __('can not update super admin role'),
            'status' => false,

        ], 402);
    }
}
