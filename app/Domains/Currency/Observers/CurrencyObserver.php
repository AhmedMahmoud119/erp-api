<?php

namespace App\Domains\Currency\Observers;

use App\Domains\Currency\Models\Currency;
use App\Domains\RevisionHistory\Services\RevisionHistoryService;

class CurrencyObserver
{

    /**
     * Handle the Currency "created" event.
     *
     * @param \App\Domains\Currency\Models\Currency $currency
     *
     * @return void
     */
    public function created(Currency $currency)
    {
        //
    }

    public function updating(Currency $currency)
    {
        $changes = [];
        foreach ($currency->getDirty() as $key => $value) {
            $original = $currency->getOriginal($key);
            $changes['old'][$key] = $original;
            $changes['new'][$key] = $value;
        }


        app(RevisionHistoryService::class)->create(request(),
            'App\Domains\Currency\Models\Currency',$changes);

    }

    public function updated(Currency $currency)
    {
    }

    public function deleting(Currency $currency)
    {
        app(RevisionHistoryService::class)->create(request(),
            'App\Domains\Currency\Models\Currency','Row ' . $currency->id . ' Deleted');
    }

    /**
     * Handle the Currency "deleted" event.
     *
     * @param \App\Domains\Currency\Models\Currency $currency
     *
     * @return void
     */
    public function deleted(Currency $currency)
    {
        //
    }

    /**
     * Handle the Currency "restored" event.
     *
     * @param \App\Domains\Currency\Models\Currency $currency
     *
     * @return void
     */
    public function restored(Currency $currency)
    {
        //
    }

    /**
     * Handle the Currency "force deleted" event.
     *
     * @param \App\Domains\Currency\Models\Currency $currency
     *
     * @return void
     */
    public function forceDeleted(Currency $currency)
    {
        //
    }
}
