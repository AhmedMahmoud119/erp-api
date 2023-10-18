<?php

namespace App\Domains\Supplier\Repositories;

use App\Domains\Account\Repositories\AccountMySqlRepository;
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
    public function list()
    {
        $result = $this->supplier::when(request()->search, function ($q) {
            $searchTerm = '%' . request()->search . '%';
            $q->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm);
                $query->orWhere('code', 'like', $searchTerm);
            });
        })->when(request()->transaction_from, function ($q) {
            $q->whereHas('purchase', function ($query) {
                $query->whereDate('date', '>=', request()->transaction_from);
            });
        })->when(request()->transaction_to, function ($q) {
            $q->whereHas('purchase', function ($query) {
                $query->whereDate('date', '<=', request()->transaction_to);
            });
        })->when(request()->from, function ($q) {
            $q->whereDate('created_at', '>=', request()->from);
        })->when(request()->to, function ($q) {
            $q->whereDate('created_at', '<=', request()->to);
        })->when(request()->creator_id, function ($q) {
            return $q->where('creator_id', request()->creator_id);
        })->when(request()->sort_by, function ($q) {
            if (in_array(request()->sort_by, ['name', 'created_at', 'code', 'contact', 'email'])) {
                $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
            }
        })->with(['account', 'currency'])->withSum('purchase', 'total')->orderBy('name')
            ->paginate(request('limit', config('app.pagination_count')));
        return $result;
    }

    public function store($request): bool
    {
//        $address = Address::create([
//            'address' => $request->address,
//            'phone' => $request->address_phone,
//            'name' => $request->address_name,
//            'zip_code' => $request->zip_code,
//            'state_id' => $request->state_id,
//            'city_id' => $request->city_id,
//            'country_id' => $request->country_id,
//        ]);

        $accountCode = Account::find($request->parent_account_id);
        $spplierMaxId = $this->supplier::max('id') ?? 0;

        $data = app(AccountMySqlRepository::class)->storeFromSupplier($request->parent_account_id, $request->name);

        $data = [
            'code' => $accountCode->code . ($spplierMaxId + 1),
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
//            'address_id' => $address->id,
            'parent_account_id' => $request->parent_account_id,
            'account_id' => $data['account_id'],
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
//        Address::find($supplier->address_id)->update([
//            'address' => $request->address,
//            'phone' => $request->address_phone,
//            'name' => $request->address_name,
//            'zip_code' => $request->zip_code,
//            'state_id' => $request->state_id,
//            'city_id' => $request->city_id,
//            'country_id' => $request->country_id,
//        ]);

//        $accountCode = Account::find($request->parent_account_id);
        $spplierId = $id;
        $data = [
//            'code' => $accountCode->code . ($spplierId),
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
//            'parent_account_id' => $request->parent_account_id,
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
