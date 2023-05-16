<?php

namespace App\Domains\Form\Exports;

use App\Domains\Form\Interfaces\FormRepositoryInterface;
use App\Domains\Form\Models\FieldResponse;
use App\Domains\Form\Models\Form;
use App\Domains\Form\Models\FormVersion;
use App\Domains\Form\Repositories\FormMySqlRepository;
use App\Domains\Form\Services\FormService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;

class FormResponseExport implements FromCollection, WithMapping, WithHeadings, WithEvents
{
    public $id;
    public $formFields;
    public $header;
    public $formService;

    public function __construct($id)
    {
        $this->id = $id;

        $this->formService = new FormService(new FormMySqlRepository(new Form()));

        $this->formFields = $this->formService->getFieldsOfFormVersion($id);

        foreach ($this->formFields as $formField) {
            $this->header[$formField->field_id] = $formField->field->title;
        }

    }

    public function collection()
    {
        $fieldResponses = $this->formService->getFieldResponsesAccordingToForm($this->id);
        $submissionIds = $fieldResponses->pluck('submission_id')->toArray();
        $formGroupedResponse = $this->formService->getGroupedResponses($submissionIds);

        return $formGroupedResponse;
    }

    public function map($data): array
    {
        $map = [];
        foreach ($this->header as $field_id => $response) {
            $map[$field_id] = $data->where('formField.field_id',$field_id)->first()->value??'';
        }

        return $map;
    }

    public function headings(): array
    {
        return $this->header;
    }


    public function registerEvents(): array
    {
        return [

        ];
    }

}
