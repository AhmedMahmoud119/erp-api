<?php

namespace App\Domains\Product\Services;


use App\Domains\Product\Interfaces\ProductRepositoryInterface;
use App\Domains\Product\Models\Product;
use App\Mail\SendPassword;
use Illuminate\Support\Facades\Mail;

class ProductService
{
    public function __construct(private ProductRepositoryInterface $productRepository)
    {
    }
    public function findById($id)
    {
        return $this->productRepository->findById($id);
    }

    public function list()
    {
        return $this->productRepository->list();
    }

    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }

    public function create($request)
    {
        return $this->productRepository->store($request);
    }

    public function update($id, $request)
    {
        return $this->productRepository->update($id, $request);
    }
}