<?php

namespace App\Domains\Group\Repositories;

use App\Domains\Group\Models\Group;
use App\Domains\Group\Interfaces\GroupRepositoryInterface;
use App\Domains\GroupType\Models\GroupType;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class GroupMySqlRepository implements GroupRepositoryInterface
{
    public function __construct(private Group $group)
    {
    }

    public function list()
    {
        return $this->group::when(request()->sort_by, function ($q) {
            if (in_array(request()->sort_by, [ 'name','code','creator_id','group_type_id'])) {
                $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
            }
        })->when(request()->search, function ($q) {
            $q->where('name', 'like', '%' . request()->search . '%')
                ->orwhere('code', 'like', '%' . request()->search . '%');

        })
            ->when(request()->type_name, function ($q) {
                $q->where('group_type_id', request()->group_type_id);
            })->when(request()->code,function ($q){
                $q->where('code',request()->code );

            })->when(request()->name,function ($q){
                $q->where('name',request()->name );
            })
                ->when(request()->from, function ($q) {
                        $q->whereDate('created_at', '>=', request()->from);
                })->when(request()->to, function ($q) {
                        $q->whereDate('created_at', '<=', request()->to);
                    })

                    ->when(request()->creator_id, function ($q) {
                        $q->where('creator_id', request()->creator_id);
                    })->with('creator','group_type')
                    ->orderBy('name', 'asc')->get();
            }

    public function findById(string $id): Group
    {
        return $this->group::findOrFail($id);
    }

    public function store($request)
    {
        $group_type=GroupType::findOrFail($request->group_type_id);
        $group=Group::select("code")->whereBetween('code', [$group_type->code,$group_type->code + 999])
                ->orderBy('id', 'DESC')
                ->first();
            if($group)
            {
                $code=$group->code+1;
            }
            else
            {
                $code=$group_type->code+1;
            }

        $this->group::create([
            'name' => $request->name,
            'group_type_id' => $request->group_type_id,
            'code' =>$code,
            'creator_id' => auth()->user()->id,

        ]);

        return true;
    }

    public function update(string $id, $request): bool
    {

        $group = $this->group::findOrFail($id);

        $group->update([
            'type_name' => $request->type_name,
        ]);

        return true;
    }

    public function delete(string $id): bool
    {
        $this->group::findOrFail($id)->delete();

        return true;
    }
    public function generatePDF()
    {
        $groups = Group::with('creator','group_type')->get();

        $data = [
            'title' => 'Groups List',
            'date' => date('m/d/Y'),
            'groups' => $groups
        ];
        $pdf = PDF::loadView('GroupPDF', $data);

        $path = public_path('storage/exports/groups/');
        $fileName = time() . '-GroupsDetailes.pdf';
        $pdf->save($path . '/' . $fileName);
        return response()->json([
            'file_path' => asset('storage/exports/groups/' . $fileName)
        ]);

    }


}
