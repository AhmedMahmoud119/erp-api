<?php

namespace App\Domains\Tax\Observers;

use App\Domains\Tax\Models\Tax;
use App\Domains\RevisionHistory\Services\RevisionHistoryService;

class TaxObserver
{

    /**
     * Handle the Tax "created" event.
     *
     * @param \App\Domains\Tax\Models\Tax $tax
     *
     * @return void
     */
    public function created(Tax $tax)
    {
        //
    }

    public function updating(Tax $tax)
    {
        $changes = [];
        foreach ($tax->getDirty() as $key => $value) {
            $original = $tax->getOriginal($key);
            $changes['old'][$key] = $original;
            $changes['new'][$key] = $value;
        }


        app(RevisionHistoryService::class)->create(request(),
            'App\Domains\Tax\Models\Tax',$changes);

    }

    public function updated(Tax $tax)
    {
    }

    public function deleting(Tax $tax)
    {
        app(RevisionHistoryService::class)->create(request(),
            'App\Domains\Tax\Models\Tax','Row ' . $tax->id . ' Deleted');
    }

    /**
     * Handle the Tax "deleted" event.
     *
     * @param \App\Domains\Tax\Models\Tax $tax
     *
     * @return void
     */
    public function deleted(Tax $tax)
    {
        //
    }

    /**
     * Handle the Tax "restored" event.
     *
     * @param \App\Domains\Tax\Models\Tax $tax
     *
     * @return void
     */
    public function restored(Tax $tax)
    {
        //
    }

    /**
     * Handle the Tax "force deleted" event.
     *
     * @param \App\Domains\Tax\Models\Tax $tax
     *
     * @return void
     */
    public function forceDeleted(Tax $tax)
    {
        //
    }
}
