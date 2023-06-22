<?php

namespace App\Domains\BankAccount\Observers;

use App\Domains\BankAccount\Models\BankAccount;
use App\Domains\RevisionHistory\Services\RevisionHistoryService;

class BankAccountObserver
{

    /**
     * Handle the BankAccount "created" event.
     *
     * @param \App\Domains\BankAccount\Models\BankAccount $bankAccount
     *
     * @return void
     */
    public function created(BankAccount $bankAccount)
    {
        //
    }

    public function updating(BankAccount $bankAccount)
    {
        $changes = [];
        foreach ($bankAccount->getDirty() as $key => $value) {
            $original = $bankAccount->getOriginal($key);
            $changes['old'][$key] = $original;
            $changes['new'][$key] = $value;
        }


        app(RevisionHistoryService::class)->create(request(),
            'App\Domains\BankAccount\Models\BankAccount',$changes);

    }

    public function updated(BankAccount $bankAccount)
    {
    }

    public function deleting(BankAccount $bankAccount)
    {
        app(RevisionHistoryService::class)->create(request(),
            'App\Domains\BankAccount\Models\BankAccount','Row ' . $bankAccount->id . ' Deleted');
    }

    /**
     * Handle the BankAccount "deleted" event.
     *
     * @param \App\Domains\BankAccount\Models\BankAccount $bankAccount
     *
     * @return void
     */
    public function deleted(BankAccount $bankAccount)
    {
        //
    }

    /**
     * Handle the BankAccount "restored" event.
     *
     * @param \App\Domains\BankAccount\Models\BankAccount $bankAccount
     *
     * @return void
     */
    public function restored(BankAccount $bankAccount)
    {
        //
    }

    /**
     * Handle the BankAccount "force deleted" event.
     *
     * @param \App\Domains\BankAccount\Models\BankAccount $bankAccount
     *
     * @return void
     */
    public function forceDeleted(BankAccount $bankAccount)
    {
        //
    }
}
