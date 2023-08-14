<?php

namespace App\Domains\Vendor\Repositories;

use App\Domains\Vendor\Interfaces\VendorRepositoryInterface;
use App\Domains\Vendor\Models\Vendor;
use Illuminate\Database\Eloquent\Collection;

class VendorMySqlRepository implements VendorRepositoryInterface
{
    public function __construct(private Vendor $vendor)
    {
    }

    public function findById(string $id): Vendor
    {
        $vendor =  $this->vendor::findOrFail($id);
        $vendor->load('creator');
        return $vendor;
    }



    public function list()
    {
        return $this->vendor::when(request()->creator_id, function ($q) {
            $q->where('creator_id', request()->creator_id);
        })->when(request()->from, function ($q) {
            $q->whereDate('created_at', '>=', request()->from);
        })->when(request()->to, function ($q) {
            $q->whereDate('created_at', '<=', request()->to);
        })->with('creator')
            ->paginate(request('limit', config('app.pagination_count')));
    }

    public function store($request): bool
    {
        $this->vendor::create([
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
        $vendor = $this->vendor::findOrFail($id);
        $vendor->update([
            'name' => $request->name ?? $vendor->name,
            'status' => $request->status ?? $vendor->status,
            'user_id' => $request->user_id ?? $vendor->user_id,
            'description' => $request->description ?? $vendor->description,
            'tenant_id' => $request->tenant_id ?? $vendor->tenant_id,
        ]);

        return true;
    }

    public function delete(string $id): bool
    {
        $this->vendor::findOrFail($id)?->delete();
        return true;
    }
}
