<?php

namespace App\Domains\JournalEntry\Interfaces;

use App\Domains\JournalEntry\Models\JournalEntry;
use App\Domains\JournalEntry\Request\ImportJournalEntryDetailsRequest;
use App\Domains\JournalEntry\Request\StoreJournalEntryRequest;
use App\Domains\JournalEntry\Request\UpdateJournalEntryRequest;
use Exception;

interface JournalEntryRepositoryInterface
{
    public function findById(string $id): JournalEntry;
    public function list();
    public function store(StoreJournalEntryRequest $request): bool;
    public function update(string $id, UpdateJournalEntryRequest $request): bool;
    public function delete(string $id): bool;
    public function importJournalEntryDetailsFromFile(string $id, ImportJournalEntryDetailsRequest $request): bool;
    public function exportJournalEntryDetailsToFile(string $id);
    public function exportJournalEntries();
    public function importJournalEntries();
    public function balanceSheet();
}
