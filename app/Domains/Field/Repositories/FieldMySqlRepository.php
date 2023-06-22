<?php

namespace App\Domains\Field\Repositories;

use App\Domains\Field\Interfaces\FieldRepositoryInterface;
use App\Domains\Field\Models\Field;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class FieldMySqlRepository implements FieldRepositoryInterface
{
    public function __construct(private Field $field)
    {
    }


    public function findById(int $id): Field
    {
        return $this->field::findOrFail($id);

    }

    public function list()
    {
        return $this->field::when(request()->title, function ($q) {
            $q->where('title', 'like', '%' . str_replace('\\', '\\\\', json_encode(request()->title)) . '%');
        })
            ->when(request()->type, function ($q) {
                $q->where('type', request()->type);
            })->paginate(request('limit',config('app.pagination_count')));

    }


    public function store($request)
    {

        $field = $this->field::create([
                'title' => $request->title,
                'type' => $request->type,
                'some_requirements' => $request->some_requirements,
                'options' => $request->options,
            ]
        );
        return $field;
    }

    public function update(int $id, $request): bool
    {
        $field = $this->field::findOrFail($id);

        if ($field->formField()->exists()) {
            return false;
        }

        $field->update([
            'title' => $request->title,
            'type' => $request->type,
            'some_requirements' => $request->some_requirements,
            'options' => $request->options,
        ]);

        return true;
    }

    public function delete(int $id): bool
    {
        $field = $this->field::findOrFail($id);
        if ($field->formField()->exists()) {
            return false;
        }
        $field->delete();

        return true;
    }
}
