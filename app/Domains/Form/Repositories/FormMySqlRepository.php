<?php

namespace App\Domains\Form\Repositories;

use App\Domains\Field\Models\Field;
use App\Domains\Field\Request\StoreFieldRequest;
use App\Domains\Form\Interfaces\FormRepositoryInterface;
use App\Domains\Form\Models\FieldResponse;
use App\Domains\Form\Models\Form;
use App\Domains\Form\Models\FormField;
use App\Domains\Form\Models\FormVersion;
use App\Domains\Form\Resources\FieldResponseResource;
use App\Domains\Form\Resources\FormResource;
use App\Domains\Form\Resources\FormVersionFieldsResource;
use Illuminate\Database\Eloquent\Collection;
use DB;

class FormMySqlRepository implements FormRepositoryInterface
{

    public function __construct(private Form $form)
    {

    }

    public function findById(string $id): Form
    {
        return $this->form::findOrFail($id);
    }

    public function list()
    {
        $forms = $this->form::with([
            'formVersions' => function ($query) {
                $query->orderBy('updated_at', 'desc')
//                    ->select(['form_id', 'updated_at as last_update'])
                ;
            },
        ])
//            ->select(['id', 'title'])
            ->withCount('formVersions')->get();

        return FormResource::collection($forms);
    }

    public function viewResponses($id, $request)
    {
        $fieldResponseQuery = FieldResponse::whereHas('formField', function ($q) use ($id) {
            $q->whereHas('formVersion', function ($q) use ($id) {
                $q->whereHas('form', function ($q) use ($id) {
                    $q->where('id', $id);
                });
            });
        })->when($request->search, function ($q, $search) use ($request) {
            $q->where('value', 'like', '%' . $search . '%');
        })->when($request->filter, function ($q, $filters) use ($request) {

            foreach ($filters as $field_id => $filter) {
                if ($field_id === array_key_first($filters)) {
                    $q->where(function ($q) use ($filter, $field_id) {
                        $q->where('value', 'like', '%' . $filter . '%')->whereHas('formField',
                            function ($q) use ($field_id) {
                                $q->where('field_id', $field_id);
                            });
                    });
                } else {
                    $q->orWhere(function ($q) use ($filter, $field_id) {
                        $q->where('value', 'like', '%' . $filter . '%')->whereHas('formField',
                            function ($q) use ($field_id) {
                                $q->where('field_id', $field_id);
                            });
                    });
                }
            }

        })->with(['formField.field'])->select('submission_id');


        $fieldResponse = FieldResponse::whereIn('submission_id',
            $fieldResponseQuery->pluck('submission_id')->toArray())->whereHas('formField', function ($q) {
            $q->where('hidden', 0);
        })->get()->groupBy('submission_id')->sortBy(function ($group, $key) {
            foreach ($group as $groupItem) {
                if ($groupItem->formField->field_id == request()->sort_field_id) {
                    return $groupItem->value;
                }
            }
        }, SORT_REGULAR,
            request()->sort_type == 'desc' ? true : false)->values()->paginate(config('app.pagination_count'));


        $fieldResponse->getCollection()->transform(function ($fieldResponseS) {
            return [
                'accessor' => $fieldResponseS[0]->submission_id,
                'fields'   => $fieldResponseS,
            ];
        });


        return FieldResponseResource::collection($fieldResponse);

    }

    public function viewVersionResponses($id, $request)
    {
        $fieldResponseQuery = FieldResponse::whereHas('formField', function ($q) use ($id) {
            $q->whereHas('formVersion', function ($q) use ($id) {
                $q->where('id', $id);
            });
        })->when($request->search, function ($q, $search) use ($request) {
            $q->where('value', 'like', '%' . $search . '%');
        })->when($request->filter, function ($q, $filters) use ($request) {

            foreach ($filters as $form_field_id => $filter) {
                if ($form_field_id === array_key_first($filters)) {
                    $q->where(function ($q) use ($filter, $form_field_id) {
                        $q->where('value', 'like', '%' . $filter . '%')->where('form_field_id', $form_field_id);
                    });
                } else {
                    $q->orWhere(function ($q) use ($filter, $form_field_id) {
                        $q->where('value', 'like', '%' . $filter . '%')->where('form_field_id', $form_field_id);
                    });
                }
            }

        })->with(['formField.field'])->select('submission_id');


        $fieldResponse = FieldResponse::whereIn('submission_id',
            $fieldResponseQuery->pluck('submission_id')->toArray())->whereHas('formField', function ($q) {
            $q->where('hidden', 0);
        })->get()->groupBy('submission_id')->sortBy(function ($group, $key) {
            foreach ($group as $groupItem) {
                if ($groupItem->formField->field_id == request()->sort_field_id) {
                    return $groupItem->value;
                }
            }
        }, SORT_REGULAR,
            request()->sort_type == 'desc' ? true : false)->values()->paginate(config('app.pagination_count'));


        $fieldResponse->getCollection()->transform(function ($fieldResponseS) {
            return [
                'accessor' => $fieldResponseS[0]->submission_id,
                'fields'   => $fieldResponseS,
            ];
        });


        return FieldResponseResource::collection($fieldResponse);

    }

    public function viewFields($id)
    {
        $formVersion = FormVersion::with([
            'fields.field',
            'fields' => function ($q) {
                $q->where('hidden', 0);
            },
        ])->where('form_id', $id)->orderBy('id', 'desc')->first();


        return new FormVersionFieldsResource($formVersion);
    }

    public function viewVersionFields($id)
    {
        $formVersion = FormVersion::with([
            'fields.field',
            'fields' => function ($q) {
                $q->where('hidden', 0);
            },
        ])->find($id);


        return new FormVersionFieldsResource($formVersion);
    }

    public function deleteFormField($form_field_id)
    {
        $formField = FormField::findOrFail($form_field_id);

        if ($formField->fieldResponses->count() > 0) {
            return false;
        }
        $formField->delete();

        return true;
    }

    public function hideFormField($form_field_id, $request)
    {
        $formField = FormField::findOrFail($form_field_id);

        $formField->update([
            'hidden' => $request->hidden,
        ]);

        return true;
    }

    public function listFormVersions($id)
    {
        $form = $this->form->with('formVersions')->findOrFail($id);

        return FormResource::make($form);
    }

    public function addField($id, $request)
    {
        $form = $this->form->findOrFail($id);
        $lastVersion = $form->latestVersion;

        $duplicated = FormField::where([
            'form_version_id' => $lastVersion->id,
            'field_id'        => $request->field_id,
        ])->first();

        $duplicated = FormField::where([
            'form_version_id' => $lastVersion->id,
            'field_id'        => $request->field_id,
        ])->first();

        DB::beginTransaction();
        try {
            if ($duplicated) {
                return throw new \Exception(__('Duplicated Field'), 401);
            } else if (count($lastVersion->fields->pluck('fieldResponses')->flatten()->toArray()) == 0) {
                $version_id = $lastVersion->id;
                FormField::firstOrCreate([
                    'form_version_id' => $version_id,
                    'field_id'        => $request->field_id,
                ]);
            } else {

                $version_id = $form->formVersions()->create([
                    'version' => 'v' . $lastVersion->id + 1,
                    'user_id' => auth()->user()->id,
                ]);
                $version_id = $version_id->id;

                $form->update([
                    'last_version_id' => $version_id,
                ]);

                FormField::firstOrCreate([
                    'form_version_id' => $version_id,
                    'field_id'        => $request->field_id,
                ]);

                foreach ($lastVersion->fields as $formField) {
                    FormField::firstOrCreate([
                        'form_version_id' => $version_id,
                        'field_id'        => $formField->field_id,
                    ]);
                }
            }

            FormField::firstOrCreate([
                'form_version_id' => $version_id,
                'field_id'        => $request->field_id,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception(__('Error Occurred') . ' ' . $e->getMessage(), $e->getCode());
        }

        return true;
    }

    public function fillData($id, $request)
    {
        $submission_id = uniqid() . '-' . time();

        foreach ($request->value as $form_field_id => $value) {

            if ( ! is_array($request->value[$form_field_id]) && file_exists($request->value[$form_field_id])) {
                $fileName = time() . '_' . $request->value[$form_field_id]->getClientOriginalName();
                $filePath = $request->value[$form_field_id]->storeAs('uploads', $fileName, 'public');
                $value = '/storage/' . $filePath;
            }

            FieldResponse::create([
                'form_field_id' => $form_field_id,
                'value'         => $value,
                'submission_id' => $submission_id,
            ]);
        }

        return true;
    }

    public function versionDetails($version_id)
    {
        $versionDetails = FormVersion::with('fields.field')->findOrFail($version_id);

        return new FormVersionFieldsResource($versionDetails);
    }

    public function store($request)
    {
        $form = $this->form::create($request->all());

        $form->modules()->sync($request->module_id);

        $form->formVersions()->create([
            'version' => 'v1',
            'user_id' => auth()->user()->id,
        ]);

        $form->update([
            'last_version_id' => $form->formVersions->last()->id,
        ]);

        return true;
    }

    public function getFieldsOfFormVersion($id)
    {
        $formVersion = FormVersion::with('fields.field')->where('form_id', $id)->orderBy('id', 'desc')->first();

        return $formVersion->fields;
    }

    public function getFieldResponsesAccordingToForm($form_id)
    {
        return FieldResponse::whereHas('formField', function ($q) use ($form_id) {
            $q->whereHas('formVersion', function ($q) use ($form_id) {
                $q->whereHas('form', function ($q) use ($form_id) {
                    $q->where('id', $form_id);
                });
            });
        })->with('formField.field')->select('submission_id');

    }

    public function getGroupedResponses($submissionIds)
    {
        return FieldResponse::with('formField')->whereIn('submission_id', $submissionIds)->get()->sortBy(function (
            $response
        ) {
            return $response->formField->field_id;
        })->groupBy('submission_id');
    }

    public function update(string $id, $request)
    {

    }

    public function delete(string $id): bool
    {
        $this->form::findOrFail($id)?->delete();

        return true;
    }

    public function createFieldInForm($id, StoreFieldRequest $request)
    {


        $field = Field::create([
            'title' => $request->title,
            'type' => $request->type,
            'some_requirements' => $request->some_requirements,
            'options' => $request->options,
        ]);
        $form = $this->form->findOrFail($id);
        $lastVersion = $form->latestVersion;

        $duplicated = FormField::where([
            'form_version_id' => $lastVersion->id,
            'field_id'        => $field->id,
        ])->first();

        DB::beginTransaction();
        try {
            if ($duplicated) {
                return throw new \Exception(__('Duplicated Field'), 401);
            } else if (count($lastVersion->fields->pluck('fieldResponses')->flatten()->toArray()) == 0) {
                $version_id = $lastVersion->id;
                FormField::firstOrCreate([
                    'form_version_id' => $version_id,
                    'field_id'        => $field->id,
                ]);
            } else {

                $version_id = $form->formVersions()->create([
                    'version' => 'v' . $lastVersion->id + 1,
                    'user_id' => auth()->user()->id,
                ]);
                $version_id = $version_id->id;

                $form->update([
                    'last_version_id' => $version_id,
                ]);

                FormField::firstOrCreate([
                    'form_version_id' => $version_id,
                    'field_id'        => $field->id,
                ]);

                foreach ($lastVersion->fields as $formField) {
                    FormField::firstOrCreate([
                        'form_version_id' => $version_id,
                        'field_id'        => $formField->field_id,
                    ]);
                }
            }

            FormField::firstOrCreate([
                'form_version_id' => $version_id,
                'field_id'        => $field->id,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception(__('Error Occurred') . ' ' . $e->getMessage(), $e->getCode());
        }

        return true;
    }

}
