<?php

namespace App\Domains\Form\Interfaces;

use App\Domains\Form\Models\Form;
use Illuminate\Database\Eloquent\Collection;

interface FormRepositoryInterface
{
    public function findById(string $id): Form;
    public function list();
    public function store($request);
    public function update(string $id, $request);
    public function delete(string $id): bool;
}
