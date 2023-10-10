<?php

namespace App\Domains\Group\Services;


use App\Domains\Group\Exports\GroupsExport;
use App\Domains\Group\Imports\GroupsImport;
use App\Domains\Group\Interfaces\GroupRepositoryInterface;
use App\Domains\Group\Models\Group;
use App\Domains\Group\Resources\GroupResource;
use Maatwebsite\Excel\Facades\Excel;

class GroupService
{
    public function __construct(private GroupRepositoryInterface $groupRepository)
    {
    }

    public function list()
    {
        return $this->groupRepository->list();
    }
    public function findById($id)
    {
        return $this->groupRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->groupRepository->delete($id);
    }

    public function create($request)
    {

        return $this->groupRepository->store($request);
    }

    public function update($id,$request)
    {

        return $this->groupRepository->update($id,$request);
    }
    public function generatePDF()
    {
        return $this->groupRepository->generatePDF();
    }
    public function export()
    {
        $filename = time() . '-groups.csv';
        $path = 'exports/groups/' . $filename;
//        $groups = GroupResource::collection( Group::with('creator','group_type')->get());
        Excel::store(new GroupsExport(), $path, 'public');

        if(tenant('id')){
            return response()->json([
                'file_path' => url('storage/tenant'.tenant('id').'/app/public/exports/groups/' . $filename),
            ]);
        }

        return response()->json([
            'file_path' => asset('storage/'.$path)
        ]);
    }
    public function import()
    {
        Excel::import(new GroupsImport, request()->file_input);

        return true ;
    }
}
