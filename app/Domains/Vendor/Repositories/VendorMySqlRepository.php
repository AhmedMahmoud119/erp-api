<?php

namespace App\Domains\Vendor\Repositories;

use App\Domains\Account\Services\AccountService;
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
        $account = app(AccountService::class)->findById($request->parent_account_id);
        $vendorMaxId = $this->vendor::max('id')??0;
        $this->vendor::create([
            'code'              => ($vendorMaxId+1).$account->code,
            'name'              => $request->name,
            'contact'           => $request->contact,
            'email'             => $request->email,
            'currency_id'       => $request->currency_id,
            'parent_account_id' => $request->parent_account_id,
            'address_id'        => $request->address_id,
            'creator_id'        => auth()->user()->id,
        ]);

        return true;
    }

    public function update(string $id, $request): bool
    {
        $vendor = $this->vendor::findOrFail($id);

        $account = app(AccountService::class)->findById($request->parent_account_id);
        $vendorMaxId = $this->vendor::max('id')??0;

        $vendor->update([
            'code'              => ($vendorMaxId+1) . $account->code,
            'name'              => $request->name,
            'contact'           => $request->contact,
            'email'             => $request->email,
            'currency_id'       => $request->currency_id,
            'parent_account_id' => $request->parent_account_id,
            'address_id'        => $request->address_id,
        ]);

        return true;
    }

    public function delete(string $id): bool
    {
        $this->vendor::findOrFail($id)?->delete();

        return true;
    }
}
