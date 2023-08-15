<?php

namespace App\Domains\Vendor\Repositories;

use App\Domains\Account\Services\AccountService;
use App\Domains\Vendor\Interfaces\VendorRepositoryInterface;
use App\Domains\Vendor\Models\Address;
use App\Domains\Vendor\Models\Vendor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class VendorMySqlRepository implements VendorRepositoryInterface
{

    public function __construct(private Vendor $vendor)
    {
    }

    public function findById(string $id): Vendor
    {
        $vendor = $this->vendor::findOrFail($id);
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
        })->with('creator')->paginate(request('limit', config('app.pagination_count')));
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

        $account = app(AccountService::class)->findById($request->parent_account_id);
        $vendorMaxId = $this->vendor::max('id') ?? 0;
        $this->vendor::create([
            'code'              => $account->code . ($vendorMaxId + 1),
            'name'              => $request->name,
            'contact'           => $request->contact,
            'email'             => $request->email,
            'currency_id'       => $request->currency_id,
            'parent_account_id' => $request->parent_account_id,
            'address_id'        => $address->id,
            'creator_id'        => auth()->user()->id,
        ]);

        return true;
    }

    public function update(string $id, $request): bool
    {
        $vendor = $this->vendor::findOrFail($id);

        Address::find($vendor->address_id)->update([
            'address'    => $request->address,
            'phone'      => $request->address_phone,
            'name'       => $request->address_name,
            'zip_code'   => $request->zip_code,
            'state_id'   => $request->state_id,
            'city_id'    => $request->city_id,
            'country_id' => $request->country_id,
        ]);

        $account = app(AccountService::class)->findById($request->parent_account_id);
        $vendorMaxId = $this->vendor::max('id') ?? 0;

        $vendor->update([
            'code'              => $account->code . ($vendorMaxId + 1),
            'name'              => $request->name,
            'contact'           => $request->contact,
            'email'             => $request->email,
            'currency_id'       => $request->currency_id,
            'parent_account_id' => $request->parent_account_id,
            'creator_id'        => auth()->user()->id,
        ]);

        return true;
    }

    public function delete(string $id): bool
    {
        $this->vendor::findOrFail($id)?->delete();

        return true;
    }
}
