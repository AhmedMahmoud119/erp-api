<?php

namespace App\Domains\JournalEntry\Repositories;

use App\Domains\JournalEntry\Interfaces\JournalEntryRepositoryInterface;
use App\Domains\JournalEntry\Models\JournalEntry;
use Illuminate\Database\Eloquent\Collection;

class JournalEntryMySqlRepository implements JournalEntryRepositoryInterface
{
    public function __construct(private JournalEntry $journalEntry)
    {
    }

    public function findById(string $id): JournalEntry
    {
        return $this->journalEntry::findOrFail($id);
    }

    public function list()
    {
        return $this->journalEntry::when(request()->tenant_id, function ($q) {
            $q->where('tenant_id', request()->tenant_id);
        })->when(request()->journalEntry_id, function ($q) {
            $q->where('id', request()->journalEntry_id);
        })->when(request()->name, function ($q) {
            $q->where('name', request()->name);
        })->when(request()->creator_id, function ($q) {
            $q->where('creator_id', request()->creator_id);
        })->when(request()->date_from, function ($q) {
            $q->whereDate('created_at', '>=', request()->date_from);
        })->when(request()->date_to, function ($q) {
            $q->whereDate('created_at', '<=', request()->date_to);
        })->paginate(request('limit', config('app.pagination_count')));
    }

    public function store($request): bool
    {

        $this->journalEntry::create($request->except(['password', 'password_confirmation']) + [
            'creator_id' => auth()->user()->id
        ]);


        return true;
    }

    public function update(string $id, $request): bool
    {
        $journalEntry = $this->journalEntry::findOrFail($id);
        $journalEntry->update([
            'name' => $request->name ?? $journalEntry->name,
            'status' => $request->status ?? $journalEntry->status,
            //            'tenant_id' => $request->tenant_id ?? $journalEntry->tenant_id,
        ]);

        return true;
    }

    public function delete(string $id): bool
    {
        $this->journalEntry::findOrFail($id)?->delete();
        return true;
    }
}
