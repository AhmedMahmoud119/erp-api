<?php

namespace App\Domains\UnitType\Services;


use App\Domains\UnitType\Interfaces\UnitTypeRepositoryInterface;
use App\Domains\UnitType\Models\UnitType;

class UnitTypeService
{
    public function __construct(private UnitTypeRepositoryInterface $unitTypeRepository)
    {
    }

    public function list()
    {
        return $this->unitTypeRepository->list();
    }
    public function findById($id)
    {
        return $this->unitTypeRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->unitTypeRepository->delete($id);
    }

    public function create($request)
    {
        return $this->unitTypeRepository->store($request);
    }

    public function update($id, $request)
    {
        return $this->unitTypeRepository->update($id, $request);
    }
}