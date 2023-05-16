<?php

namespace App\Domains\Field\Interfaces;

use App\Domains\Field\Models\Field;
use Illuminate\Database\Eloquent\Collection;

interface FieldRepositoryInterface
{
    public function findById(int $id): Field;
    public function list();
    public function store($request);
    public function update(int $id, $request): bool;
    public function delete(int $id): bool;

}
