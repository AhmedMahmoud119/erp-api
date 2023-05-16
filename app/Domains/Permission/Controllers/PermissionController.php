<?php

namespace App\Domains\Permission\Controllers;
use App\Domains\Permission\Resources\PermissionModuleResource;
use App\Domains\Permission\Services\PermissionService;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function __construct(private PermissionService $permissionService)
    {
    }

    public function list() {
        return PermissionModuleResource::collection($this->permissionService->list());
    }

    public function findById($id) {
        return $this->permissionService->findById($id);
    }

}
