<?php

namespace App\Domains\JournalEntry\Controllers;


use App\Domains\JournalEntry\Models\EnumPermissionJournalEntry;
use App\Domains\JournalEntry\Request\ImportJournalEntryDetailsRequest;
use App\Domains\JournalEntry\Request\StoreJournalEntryRequest;
use App\Domains\JournalEntry\Request\UpdateJournalEntryRequest;
use App\Domains\JournalEntry\Resources\BalanceSheetResource;
use App\Domains\JournalEntry\Resources\CollectionBalanceSheetResource;
use App\Domains\JournalEntry\Resources\JournalEntryResource;
use App\Domains\JournalEntry\Resources\ProfitLossGroupsResource;
use App\Domains\JournalEntry\Resources\ProfitLossResource;
use App\Domains\JournalEntry\Resources\TrialBalanceSheetResource;
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
        try {
            $this->journalEntryService->create($request);
            return response()->json([
                'message' => __('Created Successfully'),
                'status' => true,
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => false,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update($id, UpdateJournalEntryRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionJournalEntry::edit_journalEntry->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $this->journalEntryService->update($id, $request);
            return response()->json([
                'message' => __('Updated Successfully'),
                'status' => true,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => false,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
    public function importJournalEntries(ImportJournalEntryDetailsRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionJournalEntry::import_journalEntry->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->journalEntryService->importJournalEntries();
        return response()->json([
            'message' => __('Imported Successfully'),
            'status' => true,
        ], Response::HTTP_OK);
    }

    public function balanceSheet()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionJournalEntry::view_balance_sheet->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CollectionBalanceSheetResource($this->journalEntryService->balanceSheet());
    }

    public function trialBalanceSheet()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionJournalEntry::view_trial_balance_sheet->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TrialBalanceSheetResource($this->journalEntryService->trialBalanceSheet());
    }
    public function profitLoss()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionJournalEntry::view_profit_loss->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProfitLossGroupsResource($this->journalEntryService->profitLoss());
    }
}
