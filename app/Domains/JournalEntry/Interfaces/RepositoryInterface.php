<?php

namespace App\Domains\JournalEntry\Interfaces;

use App\Domains\JournalEntry\Models\JournalEntry;
use App\Domains\JournalEntry\Request\StoreJournalEntryRequest;
use App\Domains\JournalEntry\Request\UpdateJournalEntryRequest;
use Illuminate\Database\Eloquent\Collection;

interface JournalEntryRepositoryInterface
{
    public function findById(string $id): JournalEntry;
    public function list(): Collection;
    public function store(StoreJournalEntryRequest $request): bool;
    public function update(string $id, UpdateJournalEntryRequest $request): bool;
    public function delete(string $id): bool;
}
