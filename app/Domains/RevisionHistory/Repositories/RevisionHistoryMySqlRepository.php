<?php

namespace App\Domains\RevisionHistory\Repositories;

use App\Domains\RevisionHistory\Interfaces\RevisionHistoryRepositoryInterface;
use App\Domains\RevisionHistory\Models\RevisionHistory;
use Illuminate\Database\Eloquent\Collection;

class RevisionHistoryMySqlRepository implements RevisionHistoryRepositoryInterface
{

    public function __construct(private RevisionHistory $revisionHistory)
    {
    }

    public function findById(string $id): RevisionHistory
    {
        return $this->revisionHistory::findOrFail($id);
    }
    public function findByModel(string $model,string $id): Collection
    {
        return $this->revisionHistory::where('revision_historyable_type', $model)->where('revision_historyable_id', $id)->get();
    }


    public function list()
    {
        return $this->revisionHistory::when(request()->type, function ($q, $v) {
            $q->where('revision_historyable_type', 'LIKE', '%' . request()->type . '%');
        })
            ->when(request()->search, function ($q, $v) {
                $q->where('old_data', 'LIKE', '%' . request()->search . '%')
                    ->orWhere('new_data', 'LIKE', '%' . request()->search . '%')
                    ->orWhere('reason', 'LIKE', '%' . request()->search . '%');
            })
            ->when(request()->from, function ($q, $v) {
                $q->whereDate('created_at', '>=', request()->from);
            })->when(request()->to, function ($q, $v) {
                $q->whereDate('created_at', '<=', request()->to);
            })->when(request()->revision_model, function ($q, $v) {
                $q->where('revision_historyable_type', request()->revision_model);
            })
            ->when(request()->sort_by, function ($q, $v) {
                if (in_array(request()->sort_by, ['edited_by', 'old_data', 'new_data', 'reason', 'created_at', 'updated_at'])) {
                    return    $q->orderBy(request()->sort_by, request()->sort_type ?? 'asc');
                }
                return $q;
            })
            ->paginate(request('limit', config('app.pagination_count')));
    }

    public function store($request, $model, $changes): bool
    {


        $this->revisionHistory::create($request->all() + [
            'edited_by'                 => auth()->user()->id,
            'revision_historyable_type' => $model,
            'revision_historyable_id'   => $request->id,
            'reason'                    => $request->reason,
            'old_data'                  => is_array($changes) ? json_encode($changes['old']) : $changes,
            'new_data'                  => is_array($changes) ? json_encode($changes['new']) : $changes,
        ]);

        return true;
    }

    //    public function update(string $id, $request): bool
    //    {
    //
    //
    //        return true;
    //    }

    //    public function delete(string $id): bool
    //    {
    //        $this->revisionHistory::findOrFail($id)?->delete();

    //        return true;
    //    }
}
