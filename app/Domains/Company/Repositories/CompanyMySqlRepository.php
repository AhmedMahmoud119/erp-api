<?php

namespace App\Domains\Company\Repositories;

use App\Domains\Company\Interfaces\CompanyRepositoryInterface;
use App\Domains\Company\Models\Company;
use Illuminate\Database\Eloquent\Collection;

class CompanyMySqlRepository implements CompanyRepositoryInterface
{
    public function __construct(private Company $company)
    {
    }

    public function findById(string $id): Company
    {
        $company =  $this->company::findOrFail($id);
        $company->load('tenant', 'user', 'creator');
        return $company;
    }



    public function list()
    {
        return $this->company::when(request()->tenant_id, function ($q) {
            $q->where('tenant_id', request()->tenant_id);
        })->when(request()->company_id, function ($q) {
            $q->where('id', request()->company_id);
        })->when(request()->name, function ($q) {
            $q->where('name', request()->name);
        })->when(request()->user_id, function ($q) {
            $q->where('user_id', request()->user_id);
        })->when(request()->creator_id, function ($q) {
            $q->where('creator_id', request()->creator_id);
        })->when(request()->date_from, function ($q) {
            $q->whereDate('created_at', '>=', request()->date_from);
        })->when(request()->date_to, function ($q) {
            $q->whereDate('created_at', '<=', request()->date_to);
        })->with('tenant', 'user', 'creator')
            ->paginate(request('limit', config('app.pagination_count')));
    }

    public function store($request): bool
    {
        $this->company::create($request->except(['password', 'password_confirmation']) + [
            'creator_id' => auth()->user()->id
        ]);
        return true;
    }

    public function update(string $id, $request): bool
    {
        $company = $this->company::findOrFail($id);
        $company->update([
            'name' => $request->name ?? $company->name,
            'status' => $request->status ?? $company->status,
            'user_id' => $request->user_id ?? $company->user_id,
            'description' => $request->description ?? $company->description,
            'tenant_id' => $request->tenant_id ?? $company->tenant_id,
        ]);

        return true;
    }

    public function delete(string $id): bool
    {
        $this->company::findOrFail($id)?->delete();
        return true;
    }
}
