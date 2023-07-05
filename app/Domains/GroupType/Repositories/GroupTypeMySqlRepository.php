<?php

namespace App\Domains\GroupType\Repositories;

use App\Domains\Group\Models\Group;
use App\Domains\GroupType\Interfaces\GroupTypeRepositoryInterface;
use App\Domains\GroupType\Models\GroupType;
use Illuminate\Support\Facades\Storage;

class GroupTypeMySqlRepository implements GroupTypeRepositoryInterface
{
    public function __construct(private GroupType $groupType)
    {
    }

    public function list()
    {
        return $this->groupType::when(request()->sort_by, function ($q) {
            if (in_array(request()->sort_by, [ 'type_name','code','creator_id' ])) {
                $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
            }
        })->when(request()->search, function ($q) {
            $q->where('type_name', 'like', '%' . request()->search . '%')
                ->orwhere('code', 'like', '%' . request()->search . '%');

        })
            ->when(request()->type_name, function ($q) {
            $q->where('type_name', request()->type_name);
              })->when(request()->name,function ($q){
            $q->where('code',request()->code );
        })
            ->when(request()->from, function ($q) {
                $q->whereDate('created_at', '>=', request()->from);
            })->when(request()->to, function ($q) {
                $q->whereDate('created_at', '<=', request()->to);
            })

            ->when(request()->creator_id, function ($q) {
                $q->where('creator_id', request()->creator_id);
            })->with('creator')
            ->orderBy('type_name', 'asc')->get();
    }

    public function findById(string $id): GroupType
    {
        return $this->groupType::findOrFail($id);
    }

    public function store($request): bool
    {
        $this->groupType::create([
            'type_name' => $request->type_name,
            'code' => $request->code,
            'creator_id' => auth()->user()->id,

        ]);

        return true;
    }

    public function update(string $id, $request): bool
    {

       $groupType = $this->groupType::findOrFail($id);

       $groupType->update([
           'type_name' => $request->type_name,
           'code' => $request->code,
        ]);

        return true;
    }

    public function delete(string $id): bool
    {
        $groups=Group::where('group_type_id',$id)->get();
        if($groups)
            return false;
        $this->groupType::findOrFail($id)->delete();

        return true;
    }



}
