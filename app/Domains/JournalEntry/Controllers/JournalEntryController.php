<?php

namespace App\Domains\JournalEntry\Controllers;

use App\Domains\JournalEntry\Models\EnumPermissionJournalEntry;
use App\Domains\JournalEntry\Request\StoreJournalEntryRequest;
use App\Domains\JournalEntry\Request\UpdateJournalEntryRequest;
use App\Domains\JournalEntry\Resources\JournalEntryResource;
use App\Domains\JournalEntry\Services\JournalEntryService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class JournalEntryController extends Controller
{
    public function __construct(private JournalEntryService $journalEntryService)
    {
    }

    public function list()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionJournalEntry::view_journalEntries->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return  JournalEntryResource::collection($this->journalEntryService->list());
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionJournalEntry::delete_journalEntry->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->journalEntryService->delete($id);
        return response()->json([
            'message' => __('Deleted Successfully'),
            'status' => true,
        ], 200);
    }

    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionJournalEntry::view_journalEntries->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JournalEntryResource($this->journalEntryService->findById($id));
    }

    public function create(StoreJournalEntryRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionJournalEntry::create_journalEntry->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->journalEntryService->create($request);
        return response()->json([
            'message' => __('Created Successfully'),
            'status' => true,
        ], 200);
    }

    public function update($id, UpdateJournalEntryRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionJournalEntry::edit_journalEntry->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->journalEntryService->update($id, $request);
        return response()->json([
            'message' => __('Updated Successfully'),
            'status' => true,
        ], 200);
    }
}
