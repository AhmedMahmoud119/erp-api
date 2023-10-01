<?php

namespace App\Domains\Tax\Repositories;

use App\Domains\Module\Models\Moduleables;
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
        return $this->tax::when(request()->filled('search'), function ($q) {
            $q->where('name', 'like', '%' . request()->search . '%');
        })->when(request()->has('percentage'), function ($q) {
            $term = intval(request()->percentage);
            $q->where('percentage', '>=', $term);
            $q->where('percentage', '<', ++$term);
        })->when(request()->creator_id, function ($q) {
            $q->where('creator_id', request()->creator_id);
        })->when(request()->from, function ($q) {
            $q->whereDate('created_at', '>=', request()->from);
        })->when(request()->to, function ($q) {
            $q->whereDate('created_at', '<=', request()->to);
        })->when(request()->sort_by, function ($q) {
            if (in_array(request()->sort_by, ['percentage', 'id', 'creator_id', 'name', 'created_at'])) {
                $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
            }
            $q->orderBy('name', 'asc');
        })->orderBy('name', 'asc')
            ->with('creator')->paginate(request('limit', config('app.pagination_count')));
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
        Moduleables::where('moduleables_id', $id)->where('moduleables_type', Tax::class)->delete();
        $modules = collect($request->modules)->map(function ($module) use ($id) {
            return [
                'moduleables_id' => $id,
                'moduleables_type' => Tax::class,
                'module_id' => $module,
            ];
        });
        Moduleables::insert($modules->toArray());

        return true;
    }

    public function delete(string $id): bool
    {
        $this->tax::findOrFail($id)?->delete();
        return true;
    }
}