<?php

namespace App\Domains\Category\Services;


use App\Domains\Category\Interfaces\CategoryRepositoryInterface;
use App\Mail\SendPassword;
use Illuminate\Support\Facades\Mail;

class CategoryService
{
    public function __construct(private CategoryRepositoryInterface $categoryRepository)
    {
    }
    public function findById($id){
        return $this->categoryRepository->findById($id);
    }

    public function list()
    {
        return $this->categoryRepository->list();
    }

    public function delete($id)
    {
        return $this->categoryRepository->delete($id);
    }

    public function create($request)
    {
        return $this->categoryRepository->store($request);
    }

    public function update($id,$request)
    {
        return $this->categoryRepository->update($id,$request);
    }
}
