<?php

namespace App\Domains\FixedAsset\Services;

use App\Domains\FixedAsset\Interfaces\FixedAssetRepositoryInterface;

class FixedAssetService
{
    public function __construct(private FixedAssetRepositoryInterface $FixedAssetRepository)
    {
    }
    public function list()
    {
        return $this->FixedAssetRepository->list();
    }
    public function findById($id)
    {
        return $this->FixedAssetRepository->findById($id);
    }
    public function create($request)
    {
        return $this->FixedAssetRepository->store($request);
    }

    public function update($id, $request)
    {
        return $this->FixedAssetRepository->update($id, $request);
    }
    public function delete($id)
    {
        return $this->FixedAssetRepository->delete($id);
    }
    public function parents()
    {
        return $this->FixedAssetRepository->parents();
    }

} // End Of Service
