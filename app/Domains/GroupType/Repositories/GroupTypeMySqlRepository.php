<?php

namespace App\Domains\GroupType\Repositories;

use App\Domains\Group\Models\Group;
use App\Domains\GroupType\Interfaces\GroupTypeRepositoryInterface;
use App\Domains\GroupType\Models\GroupType;
use FontLib\TrueType\Collection;
use Illuminate\Support\Facades\Storage;

class GroupTypeMySqlRepository implements GroupTypeRepositoryInterface
{
    public function __construct(private GroupType $groupType)
    {
    }

    public function list()
    {
        return $this->groupType::when(request()->sort_by, function ($q) {
            if (in_array(request()->sort_by, ['name', 'code', 'creator_id'])) {
                $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
            }
        })->when(request()->search, function ($q) {
            $q->where('name', 'like', '%' . request()->search . '%')
                ->orwhere('code', 'like', '%' . request()->search . '%');
        })
            ->when(request()->name, function ($q) {
                $q->where('name', request()->name);
            })->when(request()->code, function ($q) {
                $q->where('code', request()->code);
            })
            ->when(request()->from, function ($q) {
                $q->whereDate('created_at', '>=', request()->from);
            })->when(request()->to, function ($q) {
                $q->whereDate('created_at', '<=', request()->to);
            })

            ->when(request()->creator_id, function ($q) {
                $q->where('creator_id', request()->creator_id);
            })->with('creator')
            ->paginate(request('limit', config('app.pagination_count')));
    }
    public function getTreeView()
    {
        return $this->groupType::with(['groups.accounts.children', 'creator'])->get();
    }

    public function findById(string $id): GroupType
    {
        return $this->groupType::findOrFail($id);
    }

    public function store($request): bool
    {
        $groupType = GroupType::select("code")
            ->orderBy('id', 'DESC')
            ->first();
        $this->groupType::create([
            'name' => $request->name,
            'code' => $groupType->code + 1,
            'is_fixed' => 0,
            'creator_id' => auth()->user()->id,
            'icon' => $request->icon,

        ]);

        return true;
    }

    public function update(string $id, $request): bool
    {

        $groupType = $this->groupType::findOrFail($id);
        if (in_array($id, [1, 2, 3, 4, 5])) {
            return false;
        }
        $groupType->update([
            'name' => $request->name,
        ]);

        return true;
    }

    public function delete(string $id): bool
    {
        $groups = Group::where('group_type_id', $id)->count();

        if ($groups > 0 || in_array($id, [1, 2, 3, 4, 5])) {
            return false;
        }

        $this->groupType::findOrFail($id)->delete();

        return true;
    }
}
