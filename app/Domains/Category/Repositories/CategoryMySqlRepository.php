<?php

namespace App\Domains\Category\Repositories;

use App\Domains\Category\Interfaces\CategoryRepositoryInterface;
use App\Domains\Category\Models\Category;

class CategoryMySqlRepository implements CategoryRepositoryInterface
{
    public function __construct(private Category $category)
    {
    }
    public function findById(string $id): Category
    {
        return $this->category::findOrFail($id);
    }
    public function list()
    {
        return Category::when(request()->search, function ($q) {
            $searchTerm = '%' . request()->search . '%';
            $q->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                    ->orWhere('description', 'like', $searchTerm);
            });
        })
            ->when(request()->creator_id, function ($q) {
                return $q->where('creator_id', request()->creator_id);
            })
            ->when(request()->parent_id, function ($q) {
                return $q->where('parent_id', request()->parent_id);
            })
            ->when(request()->sort_by, function ($q) {
                if (in_array(request()->sort_by, ['name', 'created_at', 'creator_id'])) {
                    $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
                }
            })
            ->with(['creator','parent'])
            ->orderBy('name')->paginate(request('limit', config('app.pagination_count')));
    }

    public function store($request): bool
    {
        $this->category::create(
            $request->validated() + [
                'creator_id' => auth()->user()->id,
        ]);
        return true;
    }

    public function update(string $id, $request): bool
    {
        $category = $this->category::findOrFail($id);
        $category->update($request->validated() + [
            'creator_id' => auth()->user()->id,
        ]);
        return true;
    }

    public function delete(string $id): bool
    {
        $this->category::findOrFail($id)->delete();

        return true;
    }

}
