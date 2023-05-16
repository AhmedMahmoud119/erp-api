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
        })->when(request()->date_from, function ($q) {
            $q->whereDate('created_at', '>=', request()->date_from);
        })->when(request()->date_to, function ($q) {
            $q->whereDate('created_at', '<=', request()->date_to);
        })->when(request()->industry_type, function ($q) {
            $q->where('industry_type', request()->industry_type);
        })->with('domains')->get()->paginate(config('app.pagination_count'));
    }

    public function findById(string $id)
    {
        return $this->tenant::with('domains')->findOrFail($id);
    }

    public function findByEmail(string $email)
    {
        // TODO: Implement findByEmail() method.
    }


    public function store($request):bool
    {
        $tenant = $this->tenant::create($request->except(['password', 'password_confirmation'])
            +
            [
                'creator_id' => auth()->user()->id
            ]
        );
        $tenant->domains()->create([
            'domain' => $request->domain,
        ]);

        CreateTenantJob::dispatch($request->all(),$tenant);

        return true;
    }

    public function update(string $id, $request):bool
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
