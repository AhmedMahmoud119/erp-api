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
        return $this->revisionHistory::paginate(request('limit', config('app.pagination_count')));
    }

    public function store($request, $model, $changes): bool
    {


        $this->revisionHistory::create($request->all() + [
                'edited_by'                 => auth()->user()->id,
                'revision_historyable_type' => $model,
                'revision_historyable_id'   => $request->id,
                'old_data'                  => json_encode($changes['old']),
                'new_data'                  => json_encode($changes['new']),
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
