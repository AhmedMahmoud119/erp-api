<?php

namespace App\Domains\Tenant\Repositories;

use App\Domains\Tenant\Interfaces\TenantRepositoryInterface;
use App\Domains\Tenant\Models\Tenant;
use App\Domains\User\Models\User;
use App\Jobs\CreateTenantJob;

class TenantMySqlRepository implements TenantRepositoryInterface
{
    public function __construct(private Tenant $tenant)
    {
    }

    public function list()
    {
        return $this->tenant::when(request()->tenant_id, function ($q) {
            $q->where('id', request()->tenant_id);
        })->when(request()->email, function ($q) {
            $q->where('email', request()->email);
        })->when(request()->assigned_id, function ($q) {
            $q->where('assigned_id', request()->assigned_id);
        })->when(request()->creator_id, function ($q) {
            $q->where('creator_id', request()->creator_id);
        })->when(request()->from, function ($q) {
            $q->whereDate('created_at', '>=', request()->from);
        })->when(request()->to, function ($q) {
            $q->whereDate('created_at', '<=', request()->to);
        })->when(request()->industry_type, function ($q) {
            $q->where('industry_type', request()->industry_type);
        })->when(request()->status, function ($q) {
            $q->where('status', request()->status);
        })->when(request()->plan, function ($q) {
            $q->where('plan', request()->plan);
        })->when(request()->search, function ($q) {
            $q->where('name', 'like', '%' . request()->search . '%')
                ->orWhere('email', 'like', '%' . request()->search . '%')
                ->orWhere('phone', 'like', '%' . request()->search . '%')
                ->orWhere('name', 'like', '%' . request()->search . '%')
                ->orWhere('id', 'like', '%' . request()->search . '%');
        })->with('domains')->paginate(request('limit', config('app.pagination_count')));
    }

    public function findById(string $id)
    {
        return $this->tenant::with('domains')->findOrFail($id);
    }

    public function findByEmail(string $email)
    {
        // TODO: Implement findByEmail() method.
    }


    public function store($request): bool
    {
        $tenant = $this->tenant::create(
            $request->except(['password', 'password_confirmation'])
                +
                [
                    'creator_id' => auth()->user()->id
                ]
        );
        $tenant->domains()->create([
            'domain' => $request->domain,
        ]);
        return true;
    }

    public function update(string $id, $request): bool
    {
        $tenant = $this->tenant::findOrFail($id);
        $tenant->update([
            'name' => $request->name ?? $tenant->name,
            'email' => $request->email ?? $tenant->email,
            'phone' => $request->phone ?? $tenant->phone,
            'domain' => $request->domain ?? $tenant->domain,
            'password' => $request->password ?? $tenant->password,
            'status' => $request->status ?? $tenant->status,
            'industry_type' => $request->industry_type ?? $tenant->industry_type,
            'assigned_id' => $request->assigned_id ?? $tenant->assigned_id,
            'plan' => $request->plan ?? $tenant->plan,

        ]);

        $tenant->domains()->update([
            'domain' => $request->domain ?? $tenant->domains?->first()->domain,
        ]);
        return true;
    }

    public function delete(string $id): bool
    {
        $this->tenant::findOrFail($id)?->delete();
        return true;
    }
}
