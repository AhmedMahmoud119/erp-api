<?php

namespace App\Domains\Tax\Repositories;

use App\Domains\Tax\Interfaces\TaxRepositoryInterface;
use App\Domains\Tax\Models\Tax;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TaxMySqlRepository implements TaxRepositoryInterface
{
    public function __construct(private Tax $tax)
    {
    }

    public function findById(string $id): Tax
    {
        return $this->tax::findOrFail($id);
    }

    public function list()
    {
        return $this->tax::when(request()->search, function ($q) {
            $q->where('name', 'like', '%' . request()->search . '%');
        })->when(request()->percentage, function ($q) {
            $q->where('percentage', request()->creator_id);
        })->when(request()->creator_id, function ($q) {
            $q->where('creator_id', request()->creator_id);
        })   ->when(request()->from, function ($q) {
            $q->whereDate('created_at', '>=', request()->from);
        })->when(request()->to, function ($q) {
            $q->whereDate('created_at', '<=', request()->to);
        })
            ->when(request()->created_at, function ($q) {
            $q->whereBetween('created_at', [request()->date_from, request()->date_to]);
        })->when(request()->sort_by, function ($q) {
            if (in_array(request()->sort_by, ['percentage',  'name', 'created_at'])) {
                $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
            }
            $q->orderBy('id', 'asc');
        })
            ->with('creator')->get();
    }

    public function store($request): bool
    {
        $tax = $this->tax::create([
            'code' => $request->code,
            'name' => $request->name,
            'percentage' => $request->percentage,
            'creator_id' => Auth::user()->id,
        ]);
        $modules = $request->modules;
        $tax->modules()->attach($modules);

        return true;
    }

    public function update(string $id, $request): bool
    {
        $tax = $this->tax::findOrFail($id);
        $tax->update([
            'code' => $request->code ?? $tax->code,
            'name' => $request->name ?? $tax->name,
            'percentage' => $request->percentage ?? $tax->percentage,
        ]);
        $modules = $request->modules;
        $tax->modules()->sync($modules);
        return true;
    }

    public function delete(string $id): bool
    {
        $this->tax::findOrFail($id)?->delete();
        return true;
    }
}
