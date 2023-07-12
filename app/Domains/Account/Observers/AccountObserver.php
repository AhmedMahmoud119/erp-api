<?php

namespace App\Domains\Account\Observers;

use App\Domains\Account\Models\Account;
use App\Domains\RevisionHistory\Services\RevisionHistoryService;

class AccountObserver
{

    /**
     * Handle the Account "created" event.
     *
     * @param \App\Domains\Account\Models\Account $account
     *
     * @return void
     */
    public function created(Account $account)
    {
        //
    }

    public function updating(Account $account)
    {
        $changes = [];
        foreach ($account->getDirty() as $key => $value) {
            $original = $account->getOriginal($key);
            $changes['old'][$key] = $original;
            $changes['new'][$key] = $value;
        }


        app(RevisionHistoryService::class)->create(request(),
            'App\Domains\Account\Models\Account',$changes);

    }

    public function updated(Account $account)
    {
    }

    public function deleting(Account $account)
    {
        app(RevisionHistoryService::class)->create(request(),
            'App\Domains\Account\Models\Account','Row ' . $account->id . ' Deleted');
    }

    /**
     * Handle the Account "deleted" event.
     *
     * @param \App\Domains\Account\Models\Account $account
     *
     * @return void
     */
    public function deleted(Account $account)
    {
        //
    }

    /**
     * Handle the Account "restored" event.
     *
     * @param \App\Domains\Account\Models\Account $account
     *
     * @return void
     */
    public function restored(Account $account)
    {
        //
    }

    /**
     * Handle the Account "force deleted" event.
     *
     * @param \App\Domains\Account\Models\Account $account
     *
     * @return void
     */
    public function forceDeleted(Account $account)
    {
        //
    }
}
