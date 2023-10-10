<?php

namespace App\Domains\BankAccount\Controllers;


use App\Domains\BankAccount\Models\BankAccount;
use App\Domains\BankAccount\Models\EnumPermissionBankAccount;
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

    public function list()
    {

        abort_if(!auth()->user()->hasPermissionTo(
            EnumPermissionBankAccount::view_bankAccounts->value,
            'api'
        ), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return BankAccountResource::collection($this->bankAccountService->list());
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(
            EnumPermissionBankAccount::delete_bankAccount->value,
            'api'
        ), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->bankAccountService->delete($id);
        return response()->json([
            'message' => __('Deleted Successfully'),
            'status'  => true,
        ], 200);
    }

    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(
            EnumPermissionBankAccount::view_bankAccounts->value,
            'api'
        ), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BankAccountResource($this->bankAccountService->findById($id));
    }

    public function create(StoreBankAccountRequest $request)
    {

        abort_if(!auth()->user()->hasPermissionTo(
            EnumPermissionBankAccount::create_bankAccount->value,
            'api'
        ), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->bankAccountService->create($request);
        return response()->json([
            'message' => __('Created Successfully'),
            'status'  => true,
        ], 200);
    }

    public function update($id, UpdateBankAccountRequest $request)
    {

        abort_if(!auth()->user()->hasPermissionTo(
            EnumPermissionBankAccount::edit_bankAccount->value,
            'api'
        ), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->bankAccountService->update($id, $request);
        return response()->json([
            'message' => __('Updated Successfully'),
            'status'  => true,
        ], 200);
    }
    public function generatePDF()
    {

        abort_if(!auth()->user()->hasPermissionTo(
            EnumPermissionBankAccount::generatePDF_bankAccounts->value,
            'api'
        ), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $this->bankAccountService->generatePDF();
    }
    public function export()
    {
        abort_if(!auth()->user()->hasPermissionTo(
            EnumPermissionBankAccount::export_bankAccounts->value,
            'api'
        ), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $this->bankAccountService->export();
    }

    public function modules()
    {
        abort_if(!auth()->user()->hasPermissionTo(
            EnumPermissionBankAccount::export_bankAccounts->value,
            'api'
        ), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modules = [
            [
                'id' => 1,
                'name' => 'Accounting',
            ],
            [
                'id' => 2,
                'name' => 'Setup',
            ]
        ];

        return response()->json([
            'modules' => $modules,
            'status'  => true,
        ], 200);
    }

    public function models($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(
            EnumPermissionBankAccount::export_bankAccounts->value,
            'api'
        ), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($id == 1) {
            $models = [
                [
                    'id' => 1,
                    'name' => 'bank account',
                    'url' => asset('examples/bank-account.csv'),
                ],
            ];
        } else {
            $models = [];
        }


        return response()->json([
            'data' => $models,
            'status' => true,
            'module' => $id == 1 ? 'Accounting' : '',
        ], 200);
    }

    public function import($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(
            EnumPermissionBankAccount::export_bankAccounts->value,
            'api'
        ), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $import = false;

        if ($id == 1) {
            $import = $this->bankAccountService->import();
        }

        if ($import) {
            return response()->json([
                'message' => __('Uploaded Successfully'),
                'status'  => true,
            ], 200);
        }

        return response()->json([
            'message' => __('This file cant upload'),
            'status'  => false,
        ], 400);
    }

    public function types(){
        return response()->json(
            [
                'data' => [
                    [
                        'name' => 'current'
                    ],
                    [
                        'name' => 'saving'
                    ],
                    [
                        'name' => 'loan'
                    ],
                    [
                        'name' => 'dollar'
                    ],
                    [
                        'name' => 'salary'
                    ]
                ]
            ]
            , 200);
    }
}
