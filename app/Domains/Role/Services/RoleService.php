<?php

namespace App\Domains\Role\Services;


use App\Domains\Role\Interfaces\RoleRepositoryInterface;
use App\Domains\Role\Request\StoreRoleRequest;

class RoleService
{
    public function __construct(private RoleRepositoryInterface $roleRepository)
    {
    }

    public function list()
    {
        return $this->roleRepository->list();
    }
    public function findById($id)
    {
        return $this->roleRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->roleRepository->delete($id);
    }

    public function create(StoreRoleRequest $request)
    {
        return $this->roleRepository->store($request);
    }

    public function update($id,$request)
    {
        return $this->roleRepository->update($id,$request);
    }
}
