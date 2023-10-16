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
            if (in_array(request()->sort_by, ['name', 'code', 'creator_id', 'group_type_id'])) {
                $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
            }
        })->when(request()->search, function ($q) {
            $q->where('name', 'like', '%' . request()->search . '%')
                ->orWhere('code', 'like', '%' . request()->search . '%');
        })->when(request()->group_type_id, function ($q) {
            $q->where('group_type_id', request()->group_type_id);
        })->when(request()->code, function ($q) {
            $q->where('code', request()->code);
        })->when(request()->name, function ($q) {
            $q->where('name', 'like', '%' . request()->name . '%');
        })->when(request()->from, function ($q) {
            $q->whereDate('created_at', '>=', request()->from);
        })->when(request()->to, function ($q) {
            $q->whereDate('created_at', '<=', request()->to);
        })->when(request()->creator_id, function ($q) {
            $q->where('creator_id', request()->creator_id);
        })->orderBy('name', 'asc')
            ->with('creator', 'group_type')->paginate(request('limit', config('app.pagination_count')));
    }


    public function findById(string $id): Group
    {
        return $this->group::findOrFail($id);
    }

    public function store($request)
    {
        $this->group::create([
            'name' => $request->name,
            'group_type_id' => $request->group_type_id,
            'code' => $this->generateCode($request->group_type_id),
            'creator_id' => auth()->user()->id,

        ]);

        return true;
    }

    public function update(string $id, $request): bool
    {
        $group = $this->group::findOrFail($id);
        $group->update([
            'name' => $request->name,
            'code' => $this->generateCode($request->group_type_id),
            'group_type_id' => $request->group_type_id
        ]);

        return true;
    }

    public function delete(string $id): bool
    {
        $group = $this->group::findOrFail($id);
        if ($group->accounts->isEmpty()) {
            $group->delete();
            return true;
        } else {
            return false;
        }
    }

    public function generatePDF()
    {
        $groups = Group::with('creator', 'group_type')->get();

        $data = [
            'title' => 'Groups List',
            'date' => date('m/d/Y'),
            'groups' => $groups,
        ];
        $pdf = PDF::loadView('GroupPDF', $data);

        $path = public_path('storage/exports/');
        $fileName = 'GroupsDetailes-' . date("Y-m-d-his") . '.pdf';
        $pdf->save($path . '/' . $fileName);

        if (tenant('id')) {
            return response()->json([
                'file_path' => url('storage/exports/' . $fileName),
            ]);
        }

        return response()->json([
            'file_path' => asset('storage/exports/' . $fileName),
        ]);
    }
    /**
     * Generate new Group code based on parent id
     * @param int $parentId
     * @return string
     */
    private function generateCode(int $parentId)
    {
        $groupType = GroupType::find($parentId);
        $lastGroup = Group::where('code', 'like', $groupType->code . '%')->whereRaw('LENGTH(code) = ?', [4])->orderBy('id', 'desc')->first();

        $lastGroupCode = $lastGroup ? ($lastGroup->code + 1) : $groupType->code . '001';
        $code = str_pad($lastGroupCode, 4, '0', STR_PAD_LEFT);

        return $code;
    }

} // End of Repo
