<?php

namespace App\Domains\SafeMovement\Services;

use App\Domains\SafeMovement\Interfaces\SafeMovementRepositoryInterface;

class SafeMovementService
{
    public function __construct(private SafeMovementRepositoryInterface $safeMovementRepository)
    {
    }
    public function list()
    {
        return $this->safeMovementRepository->list();
    }
    public function findById($id)
    {
        return $this->safeMovementRepository->findById($id);
    }
    public function create($request)
    {
        return $this->safeMovementRepository->store($request);
    }

    public function update($id, $request)
    {
        return $this->safeMovementRepository->update($id, $request);
    }
    public function delete($id)
    {
        return $this->safeMovementRepository->delete($id);
    }

} // End Of Service
