<?php

namespace App\Domains\CashManagment\Services;

use App\Domains\CashManagment\Interfaces\CashManagmentRepositoryInterface;

class CashManagmentService
{
    public function __construct(private CashManagmentRepositoryInterface $cashManagmentRepository)
    {
    }
    public function list()
    {
        return $this->cashManagmentRepository->list();
    }
    public function findById($id)
    {
        return $this->cashManagmentRepository->findById($id);
    }
    public function create($request)
    {
        return $this->cashManagmentRepository->store($request);
    }

    public function update($id, $request)
    {
        return $this->cashManagmentRepository->update($id, $request);
    }
    public function delete($id)
    {
        return $this->cashManagmentRepository->delete($id);
    }

} // End Of Service
