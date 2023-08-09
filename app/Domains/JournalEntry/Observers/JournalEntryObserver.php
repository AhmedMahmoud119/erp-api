<?php

namespace App\Domains\JournalEntry\Observers;

use App\Domains\JournalEntry\Models\JournalEntry;
use App\Domains\RevisionHistory\Services\RevisionHistoryService;

class JournalEntryObserver
{

    /**
     * Handle the Group "created" event.
     *
     * @param \App\Domains\Group\Models\JournalEntry $journalEntry
     *
     * @return void
     */
    public function created(JournalEntry $journalEntry)
    {
        //
    }

    // public function updating(JournalEntry $journalEntry)
    // {
    //     $changes = [];
    //     foreach ($journalEntry->getDirty() as $key => $value) {
    //         $original = $journalEntry->getOriginal($key);
    //         $changes['old'][$key] = $original;
    //         $changes['new'][$key] = $value;
    //     }


    //     app(RevisionHistoryService::class)->create(
    //         request(),
    //         'App\Domains\JournalEntry\Models\JournalEntry',
    //         $changes
    //     );
    // }

    // public function updated(JournalEntry $journalEntry)
    // {
    // }

    // public function deleting(JournalEntry $journalEntry)
    // {
    //     app(RevisionHistoryService::class)->create(
    //         request(),
    //         'App\Domains\JournalEntry\Models\JournalEntry',
    //         'Row ' . $journalEntry->id . ' Deleted'
    //     );
    // }

    /**
     * Handle the JournalEntry "deleted" event.
     *
     * @param \App\Domains\JournalEntry\Models\JournalEntry $journalEntry
     *
     * @return void
     */
    public function deleted(JournalEntry $journalEntry)
    {
        //
    }

    /**
     * Handle the JournalEntry "restored" event.
     *
     * @param \App\Domains\JournalEntry\Models\JournalEntry $journalEntry
     *
     * @return void
     */
    public function restored(JournalEntry $journalEntry)
    {
        //
    }

    /**
     * Handle the JournalEntry "force deleted" event.
     *
     * @param \App\Domains\JournalEntry\Models\JournalEntry $journalEntry
     *
     * @return void
     */
    public function forceDeleted(JournalEntry $journalEntry)
    {
        //
    }
}
