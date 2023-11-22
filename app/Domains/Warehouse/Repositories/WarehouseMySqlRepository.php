<?php

namespace App\Domains\Warehouse\Repositories;

use App\Domains\Warehouse\Interfaces\WarehouseRepositoryInterface;
use App\Domains\Vendor\Models\Address;
use App\Domains\Warehouse\Models\Warehouse;

class WarehouseMySqlRepository implements WarehouseRepositoryInterface
{

    public function __construct(private Warehouse $warehouse)
    {
    }

    public function findById(string $id): Warehouse
    {
        $warehouse = $this->warehouse::findOrFail($id);
        $warehouse->load('creator','assigned');

        return $warehouse;
    }

    public function list()
    {
        return $this->warehouse::when(request()->search, function ($q) {
            $searchTerm = '%' . request()->search . '%';
            $q->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                    ->orWhere('description', 'like', $searchTerm);
            });
        })
            ->when(request()->creator_id, function ($q) {
            $q->where('creator_id', request()->creator_id);
        })->when(request()->from, function ($q) {
            $q->whereDate('created_at', '>=', request()->from);
        })->when(request()->to, function ($q) {
            $q->whereDate('created_at', '<=', request()->to);
        })->when(request()->sort_by, function ($q) {
            if (in_array(request()->sort_by, ['name', 'created_at', 'creator_id'])) {
                $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
            }
        })->with('creator','assigned')->paginate(request('limit', config('app.pagination_count')));
    }

    public function store($request): bool
    {
        $address = Address::create([
            'address'    => $request->address,
            'phone'      => $request->address_phone,
            'name'       => $request->address_name,
            'zip_code'   => $request->zip_code,
            'state_id'   => $request->state_id,
            'city_id'    => $request->city_id,
            'country_id' => $request->country_id,
        ]);

        $this->warehouse::create([
            'name'        => $request->name,
            'description' => $request->description,
            'assigned_id' => $request->assigned_id,
            'address_id'  => $address->id,
            'creator_id'  => auth()->user()->id,
        ]);

        return true;
    }

    public function update(string $id, $request): bool
    {
        $warehouse = $this->warehouse::findOrFail($id);
        Address::find($warehouse->address_id)->update([
            'address'    => $request->address,
            'phone'      => $request->address_phone,
            'name'       => $request->address_name,
            'zip_code'   => $request->zip_code,
            'state_id'   => $request->state_id,
            'city_id'    => $request->city_id,
            'country_id' => $request->country_id,
        ]);

        $warehouse->update([
            'name'        => $request->name,
            'description' => $request->description,
            'assigned_id' => $request->assigned_id,
        ]);

        return true;
    }

    public function delete(string $id): bool
    {
        $this->warehouse::findOrFail($id)?->delete();

        return true;
    }
}
