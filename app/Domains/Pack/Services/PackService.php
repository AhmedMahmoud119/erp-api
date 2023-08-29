<?php

namespace App\Domains\Pack\Services;


use App\Domains\Pack\Interfaces\PackRepositoryInterface;
use App\Mail\SendPassword;
use Illuminate\Support\Facades\Mail;

class PackService
{
    public function __construct(private PackRepositoryInterface $packRepository)
    {
    }
    public function findById($id)
    {
        return $this->packRepository->findById($id);
    }

    public function list()
    {
        return $this->packRepository->list();
    }

    public function delete($id)
    {
        return $this->packRepository->delete($id);
    }

    public function create($request)
    {
        return $this->packRepository->store($request);
    }

    public function update($id, $request)
    {
        return $this->packRepository->update($id, $request);
    }
}
