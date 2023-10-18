<?php

namespace App\Domains\JournalEntry\Repositories;

use App\Domains\Account\Models\Account;
use App\Domains\GroupType\Models\GroupType;
use App\Domains\JournalEntry\Exports\JournalEntriesExport;
use App\Domains\JournalEntry\Exports\JournalEntryDetailsExport;
use App\Domains\JournalEntry\Imports\JournalEntriesImport;
use App\Domains\JournalEntry\Imports\JournalEntryDetailsImport;
use App\Domains\JournalEntry\Interfaces\JournalEntryRepositoryInterface;
use App\Domains\JournalEntry\Models\JournalEntry;
use App\Domains\JournalEntry\Models\JournalEntryDetail;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class JournalEntryMySqlRepository implements JournalEntryRepositoryInterface
{

    public function __construct(private JournalEntry $journalEntry, private JournalEntryDetail $journalEntryDetail)
    {
    }

    public function findById(string $id): JournalEntry
    {
        $entry = $this->journalEntry::findOrFail($id);
        $entry->load([
            'details' => function ($q) {
                $q->with(['account']);
            },
            'creator'
        ]);

        return $entry;
    }

    public function list()
    {

        return $this->journalEntry::when(request()->title, function ($q) {
            $q->where('title', 'like', '%' . request()->title . '%');
        })->when(request()->entry_no, function ($q) {
            $q->where('entry_no', request()->entry_no);
        })->when(request()->date, function ($q) {
            $q->whereDate('date', '>=', request()->date);
        })->when(request()->description, function ($q) {
            $q->where('description', 'LIKE', '%' . request()->description . '%');
        })
            ->when(request()->total_credit, function ($q) {
                $q->joinSub(function ($query) {
                    $query->from('journal_entry_details')
                        ->selectRaw('journal_entry_id, SUM(credit) as total_credit')
                        ->groupBy('journal_entry_id');
                }, 'sub', 'journal_entries.id', '=', 'sub.journal_entry_id')
                    ->where('sub.total_credit', '=', request()->total_credit);
            })
            ->when(request()->creator_id, function ($q) {
                $q->where('creator_id', request()->creator_id);
            })->when(request()->from, function ($q) {
            $q->whereDate('created_at', '>=', request()->from);
        })->when(request()->to, function ($q) {
            $q->whereDate('created_at', '<=', request()->to);
        })->when(request()->sort_by || request()->sort_type, function ($q) {
            if (in_array(request()->sort_by, ['id', 'title', 'entry_no', 'date', 'description', 'created_at', 'updated_at', 'creator_id'])) {
                $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
            }
        })->orderBy('updated_at', 'desc')->with(['details', 'creator'])->paginate(request('limit', config('app.pagination_count')));
    }

    public function store($request): bool
    {
        try {
            DB::beginTransaction();
            $data = $request->only('title', 'description', 'entry_no', 'date', 'details');
            $latestEntry = $this->journalEntry::latest()->first();
            $data['entry_no'] = $latestEntry ? $latestEntry->entry_no + 1 : 1;
            $entry = $this->journalEntry::create($data + [
                'creator_id' => auth()->user()->id,
            ]);
            $details = collect($data['details'])->map(fn($detail) => [
                'account_id' => $detail['account_id'],
                'debit' => $detail['debit'],
                'credit' => $detail['credit'],
                'journal_entry_id' => $entry->id,
                'description' => $detail['description'] ?? '',
                'created_at' => now(),
            ])->toArray();
            $this->journalEntryDetail::insert($details);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(string $id, $request): bool
    {
        try {
            DB::beginTransaction();
            $journalEntry = $this->journalEntry::findOrFail($id);
            $data = $request->only('title', 'description', 'date', 'details');
            $journalEntry->update([
                'title' => $data['title'],
                'description' => $data['description'],
                'date' => $data['date'],
            ]);
            $journalEntry->details()->delete();
            collect($data['details'])->map(function ($q) use ($id) {
                $this->journalEntryDetail::updateOrCreate([
                    'account_id' => $q['account_id'],
                ], [
                    'debit' => $q['debit'],
                    'credit' => $q['credit'],
                    'description' => $q['description'] ?? '',
                    'journal_entry_id' => $id,
                ]);
            })->toArray();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
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
            logger('Exported Journal Entry Details'),
        ]);

        return true;
    }

    public function exportJournalEntries()
    {
        $fileName = 'journal_entries_' . Carbon::now()->format('YmdHis') . '.xlsx';
        (new JournalEntriesExport())->queue($fileName)->chain([
            logger('Exported Journal Entries'),
        ]);

        return true;
    }

    public function importJournalEntries()
    {
        (new JournalEntriesImport)->queue(request()->file('file'));

        return true;
    }

    public function balanceSheet()
    {

        $assets = GroupType::where(
            'code',
            1
        )->with('groups.accounts.journalEntryDetail.journalEntry')->whereHas(
                'groups.accounts.journalEntryDetail.journalEntry',
                function ($q) {
                    $q->when(request()->from, function ($q) {
                        $q->whereDate('date', '>=', request()->from);
                    })->when(request()->to, function ($q) {
                        $q->whereDate('date', '<=', request()->to);
                    });
                }
            )->first();
        $liabilities = GroupType::where(
            'code',
            2
        )->with('groups.accounts.journalEntryDetail.journalEntry')->whereHas(
                'groups.accounts.journalEntryDetail.journalEntry',
                function ($q) {
                    $q->when(request()->from, function ($q) {
                        $q->whereDate('date', '>=', request()->from);
                    })->when(request()->to, function ($q) {
                        $q->whereDate('date', '<=', request()->to);
                    });
                }
            )->first();

        $equity = GroupType::where(
            'code',
            3
        )->with('groups.accounts.journalEntryDetail.journalEntry')->whereHas(
                'groups.accounts.journalEntryDetail.journalEntry',
                function ($q) {
                    $q->when(request()->from, function ($q) {
                        $q->whereDate('date', '>=', request()->from);
                    })->when(request()->to, function ($q) {
                        $q->whereDate('date', '<=', request()->to);
                    });
                }
            )->first();

        return collect(['assets' => $assets, 'liabilities' => $liabilities, 'equity' => $equity]);
    }

    public function profitLoss()
    {
        $groups = GroupType::whereIn('code', [
            4,
            5,
        ])->with('groups.accounts.journalEntryDetail.journalEntry')->whereHas(
                'groups.accounts.journalEntryDetail.journalEntry',
                function ($q) {
                    $q->when(request()->from, function ($q) {
                        $q->whereDate('date', '>=', request()->from);
                    })->when(request()->to, function ($q) {
                        $q->whereDate('date', '<=', request()->to);
                    });
                }
            )->get();

        return $groups;
    }

    public function trialBalanceSheet()
    {
        $groups = Account::with('journalEntryDetail.journalEntry')->whereHas(
            'journalEntryDetail.journalEntry',
            function ($q) {
                $q->when(request()->from, function ($q) {
                    $q->whereDate('date', '>=', request()->from);
                })->when(request()->to, function ($q) {
                    $q->whereDate('date', '<=', request()->to);
                });
            }
        )->get();

        return $groups;
    }
}