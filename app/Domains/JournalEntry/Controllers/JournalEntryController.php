<?php

namespace App\Domains\JournalEntry\Controllers;

use App\Domains\JournalEntry\Exports\JournalEntriesExport;
use App\Domains\JournalEntry\Imports\JournalEntriesImport;
use App\Domains\JournalEntry\Models\EnumPermissionJournalEntry;
use App\Domains\JournalEntry\Request\ImportJournalEntryDetailsRequest;
use App\Domains\JournalEntry\Request\StoreJournalEntryRequest;
use App\Domains\JournalEntry\Request\UpdateJournalEntryRequest;
use App\Domains\JournalEntry\Resources\JournalEntryResource;
use App\Domains\JournalEntry\Services\JournalEntryService;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
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
        ], Response::HTTP_OK);
    }

    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionJournalEntry::view_journalEntries->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return  JournalEntryResource::make($this->journalEntryService->findById($id));
    }

    public function create(StoreJournalEntryRequest $request)
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionJournalEntry::create_journalEntry->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->journalEntryService->create($request);
        return response()->json([
            'message' => __('Created Successfully'),
            'status' => true,
        ], Response::HTTP_CREATED);
    }

    public function update($id, UpdateJournalEntryRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionJournalEntry::edit_journalEntry->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->journalEntryService->update($id, $request);
        return response()->json([
            'message' => __('Updated Successfully'),
            'status' => true,
        ], Response::HTTP_OK);
    }

    public function importJournalEntryDetailsFromFile($id, ImportJournalEntryDetailsRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionJournalEntry::import_journalEntry->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->journalEntryService->importJournalEntryDetailsFromFile($id, $request);
        return response()->json([
            'message' => __('We are processing your request, you will receive an email once completed.'),
            'status' => true,
        ], Response::HTTP_OK);
    }
    public function exportJournalEntryDetailsToFile($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionJournalEntry::export_journalEntry->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->journalEntryService->exportJournalEntryDetailsToFile($id);
        return response()->json([
            'message' => __('We are processing your request, you will receive an email once completed.'),
            'status' => true,
        ], Response::HTTP_OK);
    }
    public function exportJournalEntries()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionJournalEntry::export_journalEntry->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->journalEntryService->exportJournalEntries();
        return response()->json([
            'message' => __('We are processing your request, you will receive an email once completed.'),
            'status' => true,
        ], Response::HTTP_OK);
    }
    public function importJournalEntries()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionJournalEntry::import_journalEntry->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->journalEntryService->importJournalEntries();
        return response()->json([
            'message' => __('Imported Successfully'),
            'status' => true,
        ], Response::HTTP_OK);
    }
}
