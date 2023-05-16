<?php

namespace App\Domains\Role\Controllers;

use App\Domains\Role\Request\DeleteRoleRequest;
use App\Domains\Role\Request\StoreRoleRequest;
use App\Domains\Role\Request\UpdateRoleRequest;
use App\Domains\Role\Resources\RolePermissionsResource;
use App\Domains\Role\Resources\RoleResource;
use App\Domains\Role\Services\RoleService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(private RoleService $roleService)
    {
    }

    public function list()
    {

        return RolePermissionsResource::collection($this->roleService->list());
    }

    public function delete($id)
    {
        if ($this->roleService->delete($id)) {


            return response()->json([
                'message' => __('messages.deleted_successfully'),
                'status' => true,

            ], 200);
        }
        return response()->json([
            'message' => __("messages.can_not_delete_because_the_role_assigned_to_users"),
            'status' => false,

        ], 402);

    }

    public function findById($id)
    {
        return new RolePermissionsResource($this->roleService->findById($id));
    }

    public function create(StoreRoleRequest $request)
    {

        $this->roleService->create($request);
        return response()->json([
            'message' => __('messages.created_successfully'),
            'status' => true,

        ], 200);
    }

    public function update($id, UpdateRoleRequest $request)
    {
        $this->roleService->update($id, $request);
        return response()->json([
            'message' => __('messages.updated_successfully'),
            'status' => true,

        ], 200);
    }
}
