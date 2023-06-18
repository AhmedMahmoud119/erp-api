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

    public function findByEmail(string $email)
    {
        // TODO: Implement findByEmail() method.
    }

    public function list()
    {
        return $this->revisionHistory::
        when(request()->type, function ($q, $v) {
            $q->where('revision_historyable_type','LIKE','%'.request()->type.'%');
        })->paginate(request('limit', config('app.pagination_count')));
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
