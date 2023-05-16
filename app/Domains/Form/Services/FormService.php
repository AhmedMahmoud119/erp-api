<?php

namespace App\Domains\Form\Services;


use App\Domains\Form\Exports\FormResponseExport;
use App\Domains\Form\Exports\UsersExport;
use App\Domains\Form\Interfaces\FormRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;

class FormService
{
    public function __construct(private FormRepositoryInterface $formRepository)
    {
    }

    public function list()
    {
        return $this->formRepository->list();
    }

    public function viewFields($id)
    {
        return $this->formRepository->viewFields($id);
    }

    public function viewVersionFields($id)
    {
        return $this->formRepository->viewVersionFields($id);
    }

    public function deleteFormField($form_field_id)
    {
        return $this->formRepository->deleteFormField($form_field_id);
    }
    public function hideFormField($form_field_id,$request)
    {
        return $this->formRepository->hideFormField($form_field_id,$request);
    }
    public function export($id)
    {
        $filename = time() . '-responses.csv';
        $path = 'exports/responses/' . $filename;
        Excel::store(new FormResponseExport($id), $path, 'public');

        return response()->json([
            'file_path' => asset('storage/'.$path)
        ]);
    }
    public function viewResponses($id,$request)
    {
        return $this->formRepository->viewResponses($id,$request);
    }

    public function viewVersionResponses($id,$request)
    {
        return $this->formRepository->viewVersionResponses($id,$request);
    }

    public function listFormVersions($id)
    {
        return $this->formRepository->listFormVersions($id);
    }

    public function addField($id, $request)
    {
        return $this->formRepository->addField($id, $request);
    }

    public function versionDetails($version_id)
    {
        return $this->formRepository->versionDetails($version_id);
    }

    public function fillData($id, $request)
    {
        return $this->formRepository->fillData($id, $request);
    }

    public function findById($id)
    {
        return $this->formRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->formRepository->delete($id);
    }

    public function create($request)
    {
        return $this->formRepository->store($request);
    }

    public function update($id, $request)
    {
        return $this->formRepository->update($id, $request);
    }


    public function getFieldsOfFormVersion($id){
        return $this->formRepository->getFieldsOfFormVersion($id);
    }

    public function getFieldResponsesAccordingToForm($form_id){
        return $this->formRepository->getFieldResponsesAccordingToForm($form_id);
    }

    public function getGroupedResponses($form_id){
        return $this->formRepository->getGroupedResponses($form_id);
    }
}
