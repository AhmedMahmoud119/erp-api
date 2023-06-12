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
        return $this->financialPeriod::findOrFail($id);
    }

    public function list()
    {
        return $this->financialPeriod::when(request()->search, function ($q) {
            $q->where('name', 'like', '%' . request()->search . '%');
        })->when(request()->creator_id, function ($q) {
            $q->where('creator_id', request()->creator_id);
        })->when(request()->created_at, function ($q) {
            $q->whereBetween('created_at', [request()->date_from, request()->date_to]);
        })->when(request()->sort_by, function ($q) {
            if (in_array(request()->order_by, ['financial_Year','created_at'])) {
                $q->orderBy(request()->order_by, request()->sort_by === 'asc' ? 'asc' : 'desc');
            }
            $q->orderBy('id', 'asc');
        })
        ->with('creator')
        ->paginate(request('limit',config('app.pagination_count')));
    }

    public function store($request): bool
    {
        $this->financialPeriod::create([
            'financial_Year' => $request->financial_Year,
            'status' => $request->status,
            'financial_Year_Start' => $request->financial_Year_Start,
            'financial_Year_End' => $request->financial_Year_End,
            'creator_id' => Auth::user()->id
        ]);
        return true;
    }

    public function update(string $id, $request): bool
    {
        $financialPeriod = $this->financialPeriod::findOrFail($id);
        $financialPeriod->update([
            'financial_Year' => $request->financial_Year ?? $financialPeriod->financial_Year,
            'status' => $request->status ?? $financialPeriod->status,
            'financial_Year_Start' => $request->financial_Year_Start ?? $financialPeriod->financial_Year_Start,
            'financial_Year_End' => $request->financial_Year_End ?? $financialPeriod->financial_Year_End,
        ]);

        return true;
    }

    public function delete(string $id): bool
    {
        $this->financialPeriod::findOrFail($id)?->delete();
        return true;
    }
}
