<?php

namespace App\Domains\Group\Observers;

use App\Domains\Group\Models\Group;
use App\Domains\RevisionHistory\Services\RevisionHistoryService;

class GroupObserver
{

    /**
     * Handle the Group "created" event.
     *
     * @param \App\Domains\Group\Models\Group $group
     *
     * @return void
     */
    public function created(Group $group)
    {
        //
    }

    public function updating(Group $group)
    {
        $changes = [];
        foreach ($group->getDirty() as $key => $value) {
            $original = $group->getOriginal($key);
            $changes['old'][$key] = $original;
            $changes['new'][$key] = $value;
        }


        app(RevisionHistoryService::class)->create(request(),
            'App\Domains\Group\Models\Group',$changes);

    }

    public function updated(Group $group)
    {
    }

    public function deleting(Group $group)
    {
        app(RevisionHistoryService::class)->create(request(),
            'App\Domains\Group\Models\Group','Row ' . $group->id . ' Deleted');
    }

    /**
     * Handle the Group "deleted" event.
     *
     * @param \App\Domains\Group\Models\Group $group
     *
     * @return void
     */
    public function deleted(Group $group)
    {
        //
    }

    /**
     * Handle the Group "restored" event.
     *
     * @param \App\Domains\Group\Models\Group $group
     *
     * @return void
     */
    public function restored(Group $group)
    {
        //
    }

    /**
     * Handle the Group "force deleted" event.
     *
     * @param \App\Domains\Group\Models\Group $group
     *
     * @return void
     */
    public function forceDeleted(Group $group)
    {
        //
    }
}
