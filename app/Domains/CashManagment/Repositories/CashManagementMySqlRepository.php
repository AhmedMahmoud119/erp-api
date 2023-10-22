<?php

namespace App\Domains\CashManagment\Repositories;

use App\Domains\CashManagment\Interfaces\CashManagmentRepositoryInterface;
use App\Domains\CashManagment\Models\CashManagment;
use App\Domains\Customer\Models\Customer;
use App\Domains\Supplier\Models\Supplier;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Collection;


class CashManagementMySqlRepository implements CashManagmentRepositoryInterface
{
    public function __construct(private CashManagment $cashManagment)
    {
    }
    public function list()
    {
        $cashManagments = $this->cashManagment::when(request()->date_from, function ($q) {
            $q->whereDate('date', '>=', request()->date_from);
        })->when(request()->date_to, function ($q) {
            $q->whereDate('date', '<=', request()->date_to);
        })->when(request()->account_id, function ($q) {
            $q->where('account_id', request()->account_id);
        })->when(request()->amount, function ($q) {
            $q->where('amount', '>=', (request()->amount));
            $q->where('amount', '<', (request()->amount + 1));
        })->when(request()->payment_method, function ($q) {
            $q->where('payment_method', 'like', '%' . request()->payment_method . '%');
        })->when(request()->from, function ($q) {
            $q->whereDate('created_at', '>=', request()->from);
        })->when(request()->to, function ($q) {
            $q->whereDate('created_at', '<=', request()->to);
        })->when(request()->sort_by, function ($q) {
            if (in_array(request()->sort_by, ['id', 'date', 'amount', 'created_at', 'creator_id'])) {
                $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
            }
        })
            ->when(request()->has('type'), function ($q) {
                return $q->where('cashable_type', 'like', '%' . request()->type . '%');
            })->orderBy('updated_at', 'desc')->with(['creator:id,name', 'account:id,name', 'cashable:id,name,code'])->paginate(request('limit', config('app.pagination_count')));

        return $cashManagments;
    }
    public function findById(string $id): CashManagment
    {
        $cash = $this->cashManagment::findOrFail($id);
        $cash->load(['creator:id,name', 'account:id,name', 'cashable:id,name,code']);
        return $cash;
    }
    public function store($request)
    {
        $cashable = $this->getCashableAccount($request->cashable_id, $request->cashable_id);
        try {
            DB::beginTransaction();
            $cashManagment = $this->cashManagment::create($request->validated() + [
                'creator_id' => auth()->user()->id,
            ]);
            
            if (!$cashable)
                throw new Exception;
            $cashable->cash()->save($cashManagment);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }
    public function update(string $id, $request): bool
    {
        try {
            DB::beginTransaction();
            $cashManagement = $this->cashManagment::findOrFail($id);
            $cashManagement->update(request()->except('cashable_id', 'cashable'));
            $cashable = $this->getCashableAccount($request->cashable, $request->cashable_id);

            if (!$cashable)
                throw new Exception;
            $cashManagement->cashable()->associate($cashable);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function delete(string $id): bool
    {
        $deleted = $this->cashManagment::find($id)?->delete();
        if ($deleted)
            return true;
        return false;
    }

    /**
     * Get The Cashable Account based on request
     * @param string $cashable
     * @param int $id
     * @return mixed
     */
    private function getCashableAccount(string $cashable, int $id)
    {
        $cashAccount = null;
        if (strtolower($cashable) === 'customer') {
            $cashAccount = Customer::findOrfail($id);
        } elseif (strtolower($cashable) === 'supplier') {
            $cashAccount = Supplier::findOrfail($id);
        }
        return $cashAccount;
    }

}
