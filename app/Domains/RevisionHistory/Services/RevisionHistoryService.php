<?php

namespace App\Domains\RevisionHistory\Services;


use App\Domains\RevisionHistory\Interfaces\RevisionHistoryRepositoryInterface;

class RevisionHistoryService
{
    public function __construct(private RevisionHistoryRepositoryInterface $revisionHistoryRepository)
    {
    }

    public function list()
    {
        return $this->revisionHistoryRepository->list();
    }
    public function findById($id)
    {
        return $this->revisionHistoryRepository->findById($id);
    }

//    public function delete($id)
//    {
//        return $this->revisionHistoryRepository->delete($id);
//    }

    public function create($request,$model,$changes)
    {
        return $this->revisionHistoryRepository->store($request,$model,$changes);
    }
    public function findByModel($model,$id)
    {
        return $this->revisionHistoryRepository->findByModel($model,$id);
    }

//    public function update($id,$request)
//    {
//        return $this->revisionHistoryRepository->update($id,$request);
//    }
}
