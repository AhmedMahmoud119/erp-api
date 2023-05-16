<?php

namespace App\Domains\Permission\Services;


use App\Domains\Permission\Interfaces\PermissionRepositoryInterface;

class PermissionService
{
    public function __construct(private PermissionRepositoryInterface $permissionRepository)
    {
    }

    public function list()
    {
        return $this->permissionRepository->list();
    }
    public function findById($id)
    {
        return $this->permissionRepository->findById($id);
    }

}
