<?php

namespace App\Domains\Tenant\Services;


use App\Domains\Tenant\Interfaces\TenantRepositoryInterface;
use App\Mail\SendPassword;
use Illuminate\Support\Facades\Mail;

class TenantService
{
    public function __construct(private TenantRepositoryInterface $tenantRepository)
    {
    }

    public function list()
    {
        return $this->tenantRepository->list();
    }
    public function findById($id)
    {
        return $this->tenantRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->tenantRepository->delete($id);
    }

    public function create($request)
    {
//        Mail::to($request->email)->send(new SendPassword($request->password??123456));
        return $this->tenantRepository->store($request);
    }

    public function update($id,$request)
    {
        return $this->tenantRepository->update($id,$request);
    }
}
