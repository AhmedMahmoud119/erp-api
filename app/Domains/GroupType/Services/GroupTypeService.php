<?php

namespace App\Domains\GroupType\Services;


use App\Domains\GroupType\Interfaces\GroupTypeRepositoryInterface;

class GroupTypeService
{
    public function __construct(private GroupTypeRepositoryInterface $groupTypeRepository)
    {
    }

    public function list()
    {
        return $this->groupTypeRepository->list();
    }
    public function findById($id)
    {
        return $this->groupTypeRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->groupTypeRepository->delete($id);
    }

    public function create($request)
    {

        return $this->groupTypeRepository->store($request);
    }

    public function update($id,$request)
    {

        return $this->groupTypeRepository->update($id,$request);
    }
    public function getTreeView()
    {
        return $this->groupTypeRepository->getTreeView();
    }


    public function treeViewPDF()
    {
        return $this->groupTypeRepository->treeViewPDF();
    }

}
