<?php

namespace App\Domains\FinancialPeriod\Repositories;

use App\Domains\FinancialPeriod\Interfaces\FinancialPeriodRepositoryInterface;
use App\Domains\FinancialPeriod\Models\FinancialPeriod;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class FinancialPeriodMySqlRepository implements FinancialPeriodRepositoryInterface
{
    public function __construct(private FinancialPeriod $financialPeriod)
    {
    }

    public function findById(string $id): FinancialPeriod
    {
        $data = $this->financialPeriod::findOrFail($id);
        $data->load('creator');
        return $data;
    }

    public function list()
    {
        return $this->financialPeriod::when(request()->search, function ($q) {
            $q->where('title', 'like', '%' . request()->search . '%');
        })->when(request()->status, function ($q) {
            $q->where('status', 'like', '%' . strtolower(request()->status). '%');
        })->when(request()->start, function ($q) {
            $q->whereDate('start', '>=', request()->start);
        })->when(request()->end, function ($q) {
            $q->whereDate('end', '<=', request()->end);
        })->when(request()->creator_id, function ($q) {
            $q->where('creator_id', request()->creator_id);
        })->when(request()->from, function ($q) {
            $q->whereDate('created_at', '>=', request()->from);
        })->when(request()->to, function ($q) {
            $q->whereDate('created_at', '<=', request()->to);
        })->when(request()->sort_by, function ($q) {
        if (in_array(request()->sort_by, ['start', 'end', 'title', 'status', 'created_at', 'id', 'creator_id'])) {
            $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
        }
        $q->orderBy('start', 'desc');
        })->orderBy('start', 'desc')->with('creator')
            ->paginate(request('limit', config('app.pagination_count')));
    }

    public function store($request): bool
    {
        $data = $request->only('title', 'status', 'start', 'end');
        if ($request->status == 'open') {
            $this->financialPeriod::where('status','open')->update([
                'status' => 'closed'
            ]);
        }
        $this->financialPeriod::create($data + [
            'creator_id' => Auth::user()->id
        ]);
        return true;
    }

    public function update(string $id, $request): bool
    {
        $data = $request->only('title', 'status', 'start', 'end');
        if ($request->status == 'open') {
            $this->financialPeriod::where('status','open')->update([
                'status' => 'closed'
            ]);
        }else if($request->status == 'closed') {
            $financialPeriod = $this->financialPeriod::where('status','open')->count();
            if ($financialPeriod >= 1) {
                return false;
            }
        }
        $financialPeriod = $this->financialPeriod::findOrFail($id);
        $financialPeriod->update($data);


        return true;
    }

    public function delete(string $id): bool
    {
        $this->financialPeriod::findOrFail($id)->delete();
        return true;
    }
}
