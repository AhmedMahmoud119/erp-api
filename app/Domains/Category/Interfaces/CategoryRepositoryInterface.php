<?php

namespace App\Domains\Category\Interfaces;


interface CategoryRepositoryInterface
{
    public function list() ;
    public function store($request):bool;
    public function update(string $id, $request):bool;
    public function delete(string $id): bool;
}
