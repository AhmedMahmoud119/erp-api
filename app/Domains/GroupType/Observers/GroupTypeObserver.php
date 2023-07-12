<?php

namespace App\Domains\GroupType\Observers;

use App\Domains\GroupType\Models\GroupType;
use App\Domains\RevisionHistory\Services\RevisionHistoryService;

class GroupTypeObserver
{

    /**
     * Handle the GroupType "created" event.
     *
     * @param \App\Domains\GroupType\Models\GroupType $groupType
     *
     * @return void
     */
    public function created(GroupType $groupType)
    {
        //
    }

    public function updating(GroupType $groupType)
    {
        $changes = [];
        foreach ($groupType->getDirty() as $key => $value) {
            $original = $groupType->getOriginal($key);
            $changes['old'][$key] = $original;
            $changes['new'][$key] = $value;
        }


        app(RevisionHistoryService::class)->create(request(),
            'App\Domains\GroupType\Models\GroupType',$changes);

    }

    public function updated(GroupType $groupType)
    {
    }

    public function deleting(GroupType $groupType)
    {
        app(RevisionHistoryService::class)->create(request(),
            'App\Domains\GroupType\Models\GroupType','Row ' . $groupType->id . ' Deleted');
    }

    /**
     * Handle the GroupType "deleted" event.
     *
     * @param \App\Domains\GroupType\Models\GroupType $groupType
     *
     * @return void
     */
    public function deleted(GroupType $groupType)
    {
        //
    }

    /**
     * Handle the GroupType "restored" event.
     *
     * @param \App\Domains\GroupType\Models\GroupType $groupType
     *
     * @return void
     */
    public function restored(GroupType $groupType)
    {
        //
    }

    /**
     * Handle the GroupType "force deleted" event.
     *
     * @param \App\Domains\GroupType\Models\GroupType $groupType
     *
     * @return void
     */
    public function forceDeleted(GroupType $groupType)
    {
        //
    }
}
