<?php

namespace App\Domains\Company\Repositories;

use App\Domains\Company\Interfaces\CompanyRepositoryInterface;
use App\Domains\Company\Models\Company;
use App\Domains\Module\Models\Moduleables;
use Illuminate\Database\Eloquent\Collection;

class CompanyMySqlRepository implements CompanyRepositoryInterface
{
    public function __construct(private Company $company)
    {
    }

    public function findById(string $id): Company
    {
        $company =  $this->company::findOrFail($id);
        $company->load('tenant', 'user', 'creator', 'modules');
        return $company;
    }



    public function list()
    {
        return $this->company::when(request()->tenant_id, function ($q) {
            $q->where('tenant_id', request()->tenant_id);
        })->when(request()->name, function ($q) {
            $q->where('name', request()->name);
        })->when('search', function ($q) {
            $q->where('name', 'like', '%' . request()->search . '%');
        })->when(request()->user_id, function ($q) {
            $q->where('user_id', request()->user_id);
        })->when(request()->creator_id, function ($q) {
            $q->where('creator_id', request()->creator_id);
        })->when(request()->from, function ($q) {
            $q->whereDate('created_at', '>=', request()->from);
        })->when(request()->status, function ($q) {
            $q->where('status', request()->status);
        })->when(request()->to, function ($q) {
            $q->whereDate('created_at', '<=', request()->to);
        })->when(request()->modules, function ($q) {
            $q->whereHas('modules', function ($q) {
                $q->whereIn('modules.id', request()->modules);
            });
        })->when(request()->sort_by, function ($q) {
            if (in_array(request()->sort_by, ['name', 'status', 'user_id', 'creator_id', 'tenant_id', 'created_at'])) {
                $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
            }
            return $q;
        })->with('tenant', 'user', 'creator', 'modules')
            ->paginate(request('limit', config('app.pagination_count')));
    }

    public function store($request): bool
    {
        $this->company::create([
            'name' => $request->name,
            'status' => $request->status,
            'user_id' => $request->user_id,
            'description' => $request->description,
            'tenant_id' => $request->tenant_id,
            'creator_id' => auth()->user()->id,
        ])->modules()->sync($request->modules);
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
        // add modules to company 
        Moduleables::where('moduleables_id', $id)->where('moduleables_type', 'App\Domains\Company\Models\Company')->delete();
        $modules = collect($request->modules)->map(function ($module) use ($id) {
            return [
                'moduleables_id' => $id,
                'moduleables_type' => Company::class,
                'module_id' => $module,
            ];
        });
        Moduleables::insert($modules->toArray());


        return true;
    }

    public function delete(string $id): bool
    {
        $this->company::findOrFail($id)?->delete();
        return true;
    }

}
