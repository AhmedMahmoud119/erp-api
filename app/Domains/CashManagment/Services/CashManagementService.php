<?php

namespace App\Domains\CashManagment\Services;

use App\Domains\CashManagment\Interfaces\CashManagmentRepositoryInterface;

class CashManagementService
{
    public function __construct(private CashManagmentRepositoryInterface $cashManagementRepository)
    {
    }
    public function list()
    {
        return $this->cashManagementRepository->list();
    }
    public function findById($id)
    {
        return $this->cashManagementRepository->findById($id);
    }
    public function create($request)
    {
        return $this->cashManagementRepository->store($request);
    }

    public function update($id, $request)
    {
        return $this->cashManagementRepository->update($id, $request);
    }
    public function delete($id)
    {
        return $this->cashManagementRepository->delete($id);
    }

} // End Of Service
