<?php

namespace App\Domains\Category\Interfaces;
use App\Domains\Category\Models\Category;


interface CategoryRepositoryInterface
{
    public function list() ;
    public function findById(string $id): Category;
    public function store($request):bool;
    public function update(string $id, $request):bool;
    public function delete(string $id): bool;
}
