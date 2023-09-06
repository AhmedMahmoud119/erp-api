<?php

namespace App\Domains\BankAccount\Controllers;


use App\Domains\BankAccount\Models\BankAccount;
use App\Domains\BankAccount\Models\EnumPermissionBankAccount;
use App\Domains\BankAccount\Request\FilterBankAccountRequest;
use App\Domains\BankAccount\Request\StoreBankAccountRequest;
use App\Domains\BankAccount\Request\UpdateBankAccountRequest;
use App\Domains\BankAccount\Resources\BankAccountResource;
use App\Domains\BankAccount\Services\BankAccountService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    public function __construct(private BankAccountService $bankAccountService)
    {
    }

    public function list(FilterBankAccountRequest $request)
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionBankAccount::view_bankAccounts->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return  BankAccountResource::collection($this->bankAccountService->list());
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionBankAccount::delete_bankAccount->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->bankAccountService->delete($id);
        return response()->json([
            'message' => __('Deleted Successfully'),
            'status' => true,
        ], 200);
    }

    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionBankAccount::view_bankAccounts->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BankAccountResource($this->bankAccountService->findById($id));
    }

    public function create(StoreBankAccountRequest $request)
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionBankAccount::create_bankAccount->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->bankAccountService->create($request);
        return response()->json([
            'message' => __('Created Successfully'),
            'status' => true,
        ], 200);
    }

    public function update($id, UpdateBankAccountRequest $request)
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionBankAccount::edit_bankAccount->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->bankAccountService->update($id, $request);
        return response()->json([
            'message' => __('Updated Successfully'),
            'status' => true,
        ], 200);
    }
    public function generatePDF()
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionBankAccount::generatePDF_bankAccounts->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $this->bankAccountService->generatePDF();
    }
    public function export()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionBankAccount::export_bankAccounts->value,'api'),Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $this->bankAccountService->export();
    }
    public function exampleDownload()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionBankAccount::export_bankAccounts->value,'api'),Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response()->json([
            'url' => asset('examples/bank-account.csv'),
            'status' => true,
        ], 200);
    }

    public function import()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionBankAccount::export_bankAccounts->value,'api'),Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->bankAccountService->import();

        return response()->json([
            'message' => __('Uploaded Successfully'),
            'status' => true,
        ], 200);
    }

}
