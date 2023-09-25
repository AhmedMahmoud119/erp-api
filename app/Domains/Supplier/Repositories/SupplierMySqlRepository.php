<?php

namespace App\Domains\Supplier\Repositories;

use App\Domains\Supplier\Interfaces\SupplierRepositoryInterface;
use App\Domains\Supplier\Models\Supplier;
use App\Domains\Vendor\Models\Address;
use Illuminate\Database\Eloquent\Collection;
use App\Domains\Account\Models\Account;

class SupplierMySqlRepository implements SupplierRepositoryInterface
{
    public function __construct(private Supplier $supplier)
    {
    }
    public function list($filter)
    {
        return $this->supplier::filter($filter)->with(['currency','account','address'])->withSum('purchase', 'total')->paginate(request('limit', config('app.pagination_count')));
    }

    public function store($request): bool
    {
        $address = Address::create([
            'address' => $request->address,
            'phone' => $request->address_phone,
            'name' => $request->address_name,
            'zip_code' => $request->zip_code,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'country_id' => $request->country_id,
        ]);

        $accountCode = Account::find($request->parent_account_id);
        $spplierMaxId = $this->supplier::max('id') ?? 0;
        $data = [
            'code' => $accountCode->code . ($spplierMaxId + 1),
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'address_id' => $address->id,
            'parent_account_id' => $request->parent_account_id,
            'currency_id' => $request->currency_id,
        ];
        $this->supplier::create($data);
        return true;
    }

    public function update(string $id, $request): bool
    {
        $supplier = $this->supplier::find($id);
        if (!$supplier) {
            return false;
        }
        Address::find($supplier->address_id)->update([
            'address' => $request->address,
            'phone' => $request->address_phone,
            'name' => $request->address_name,
            'zip_code' => $request->zip_code,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'country_id' => $request->country_id,
        ]);

        $accountCode = Account::find($request->parent_account_id);
        $spplierId = $id;
        $data = [
            'code' => $accountCode->code . ($spplierId),
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'parent_account_id' => $request->parent_account_id,
            'currency_id' => $request->currency_id,
        ];
        $supplier->update($data);
        return true;

    }

    public function delete(string $id): bool
    {
        $this->supplier::findOrFail($id)->delete();

        return true;
    }
}
