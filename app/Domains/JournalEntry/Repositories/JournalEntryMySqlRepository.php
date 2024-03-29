<?php

namespace App\Domains\JournalEntry\Repositories;

use App\Domains\JournalEntry\Exports\JournalEntriesExport;
use App\Domains\JournalEntry\Exports\JournalEntryDetailsExport;
use App\Domains\JournalEntry\Imports\JournalEntriesImport;
use App\Domains\JournalEntry\Imports\JournalEntryDetailsImport;
use App\Domains\JournalEntry\Interfaces\JournalEntryRepositoryInterface;
use App\Domains\JournalEntry\Models\JournalEntry;
use App\Domains\JournalEntry\Models\JournalEntryDetail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Facades\Excel;

class JournalEntryMySqlRepository implements JournalEntryRepositoryInterface
{
    public function __construct(private JournalEntry $journalEntry, private JournalEntryDetail $journalEntryDetail)
    {
    }

    public function findById(string $id): JournalEntry
    {
        $entry = $this->journalEntry::findOrFail($id);
        $entry->load(['details']);
        return $entry;
    }

    public function list()
    {

        return $this->journalEntry::when(request()->search, function ($q) {
            $q->where('title', request()->search)
                ->orWhere('entry_no', request()->search);
        })->when(request()->creator_id, function ($q) {
            $q->where('creator_id', request()->creator_id);
        })->when(request()->from, function ($q) {
            $q->whereDate('created_at', '>=', request()->from);
        })->when(request()->to, function ($q) {
            $q->whereDate('created_at', '<=', request()->to);
        })->when(request()->sort, function ($q) {
            if (in_array(request()->sort, ['title', 'entry_no', 'date', 'created_at', 'updated_at', 'creator_id'])) {
                $q->orderBy(request()->sort, request()->order);
            }
            return $q;
        })->with(['details'])
            ->paginate(request('limit', config('app.pagination_count')));
    }

    public function store($request): bool
    {

        $data = $request->only('title', 'description', 'entry_no', 'date', 'accounts');
        $entry = $this->journalEntry::create($data + [
            'creator_id' => auth()->user()->id,
        ]);
        $accounts = collect($data['accounts'])->map(
            fn ($detail) =>
            [
                'account_id' => $detail['account_id'],
                'debit' => $detail['debit'],
                'credit' => $detail['credit'],
                'journal_entry_id' => $entry->id,
                'tax_id' => $detail['tax_id'] ?? null,
                'description' => $detail['description'] ?? '',
                'created_at' => now(),
            ]
        )->toArray();
        $this->journalEntryDetail::insert($accounts);
        return true;
    }

    public function update(string $id, $request): bool
    {
        $journalEntry = $this->journalEntry::findOrFail($id);
        $data = $request->only('title', 'description', 'entry_no', 'date', 'accounts');
        $journalEntry->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'entry_no' => $data['entry_no'],
            'date' => $data['date'],
        ]);
        collect($data['accounts'])->map(function ($q) use ($id) {
            $this->journalEntryDetail::updateOrCreate(
                [
                    'id' => $q['id'] ?? null
                ],
                [
                    'account_id' => $q['account_id'],
                    'debit' => $q['debit'],
                    'credit' => $q['credit'],
                    'tax_id' => $q['tax_id'] ?? null,
                    'description' => $q['description'] ?? '',
                    'journal_entry_id' => $id,
                ]
            );
        })->toArray();

        return true;
    }

    public function delete(string $id): bool
    {
        $this->journalEntry::findOrFail($id)?->delete();
        $this->journalEntryDetail::where('journal_entry_id', $id)->delete();
        return true;
    }

    public function importJournalEntryDetailsFromFile(string $id, $request): bool
    {
        Excel::import(new JournalEntryDetailsImport($id), $request->file('file'));
        return true;
    }

    public function exportJournalEntryDetailsToFile(string $id)
    {
        $entry = $this->journalEntry::findOrFail($id);
        $fileName = 'journal_entry_details_' . $entry->entry_no . '_' . Carbon::now()->format('YmdHis') . '.xlsx';

        (new JournalEntryDetailsExport($id))->queue($fileName)->chain([
            logger('Exported Journal Entry Details')
        ]);
        return true;
    }
    public function exportJournalEntries()
    {
        $fileName = 'journal_entries_' . Carbon::now()->format('YmdHis') . '.xlsx';
        (new JournalEntriesExport())->queue($fileName)->chain([
            logger('Exported Journal Entries')
        ]);
        return true;
    }
    public function importJournalEntries()
    {
        (new JournalEntriesImport)->queue(request()->file('file'));
        return true;
    }
}
