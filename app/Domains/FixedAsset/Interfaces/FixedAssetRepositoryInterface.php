<?php

namespace App\Domains\FixedAsset\Interfaces;

use App\Domains\FixedAsset\Models\FixedAsset;
use Illuminate\Database\Eloquent\Collection;

interface FixedAssetRepositoryInterface
{
    public function findById(string $id): FixedAsset;
    public function list();
    public function parents();
    public function store($request);
    public function update(string $id, $request): bool;
    public function delete(string $id): bool;
}