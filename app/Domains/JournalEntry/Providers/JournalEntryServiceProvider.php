<?php

declare(strict_types=1);

namespace App\Domains\JournalEntry\Providers;

use App\Domains\JournalEntry\Interfaces\JournalEntryRepositoryInterface;
use App\Domains\JournalEntry\Models\JournalEntry;
use App\Domains\JournalEntry\Observers\JournalEntryObserver;
use App\Domains\JournalEntry\Repositories\JournalEntryMySqlRepository;
use Illuminate\Support\ServiceProvider;

class JournalEntryServiceProvider extends ServiceProvider
{
    public $bindings = [
        JournalEntryRepositoryInterface::class => JournalEntryMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {
        JournalEntry::observe(JournalEntryObserver::class);
    }
}
