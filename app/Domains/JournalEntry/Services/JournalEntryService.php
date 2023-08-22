<?php

namespace App\Domains\JournalEntry\Services;


use App\Domains\JournalEntry\Interfaces\JournalEntryRepositoryInterface;
use App\Mail\SendPassword;
use Illuminate\Support\Facades\Mail;

class JournalEntryService
{
    public function __construct(private JournalEntryRepositoryInterface $JournalEntryRepository)
    { }

    public function list()
    {
        return $this->JournalEntryRepository->list();
    }
    public function findById($id)
    {
        return $this->JournalEntryRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->JournalEntryRepository->delete($id);
    }

    public function create($request)
    {
        return $this->JournalEntryRepository->store($request);
    }

    public function update($id, $request)
    {
        return $this->JournalEntryRepository->update($id, $request);
    }
    public function importJournalEntryDetailsFromFile($id, $request)
    {
        return $this->JournalEntryRepository->importJournalEntryDetailsFromFile($id, $request);
    }
    public function exportJournalEntryDetailsToFile($id)
    {
        return $this->JournalEntryRepository->exportJournalEntryDetailsToFile($id);
    }
    public function exportJournalEntries()
    {
        return $this->JournalEntryRepository->exportJournalEntries();
    }
    public function importJournalEntries(){
        return $this->JournalEntryRepository->importJournalEntries();
    }
    public function balanceSheet(){
        return $this->JournalEntryRepository->balanceSheet();
    }
    public function trialBalanceSheet(){
        return $this->JournalEntryRepository->trialBalanceSheet();
    }
    public function profitLoss(){
        return $this->JournalEntryRepository->profitLoss();
    }
}
