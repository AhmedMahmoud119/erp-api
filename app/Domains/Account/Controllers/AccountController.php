<?php

namespace App\Domains\Account\Controllers;


use App\Domains\Account\Models\Account;
use App\Domains\Account\Models\EnumPermissionAccount;
use App\Domains\Account\Request\FilterAccountRequest;
use App\Domains\Account\Request\StoreAccountRequest;
use App\Domains\Account\Request\UpdateAccountRequest;
use App\Domains\Account\Resources\AccountResource;
use App\Domains\Account\Services\AccountService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct(private AccountService $accountService)
    {
    }

    public function list(FilterAccountRequest $request)
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionAccount::view_accounts->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return  AccountResource::collection($this->accountService->list());
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionAccount::delete_account->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->accountService->delete($id);
        return response()->json([
            'message' => __('Deleted Successfully'),
            'status' => true,
        ], 200);
    }

    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionAccount::view_accounts->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AccountResource($this->accountService->findById($id));
    }

    public function create(StoreAccountRequest $request)
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionAccount::create_account->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->accountService->create($request);
        return response()->json([
            'message' => __('Created Successfully'),
            'status' => true,
        ], 200);
    }

    public function update($id, UpdateAccountRequest $request)
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionAccount::edit_account->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->accountService->update($id, $request);
        return response()->json([
            'message' => __('Updated Successfully'),
            'status' => true,
        ], 200);
    }
    public function generatePDF()
    {

//        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionAccount::generatePDF_accounts->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $this->accountService->generatePDF();
    }
    public function export()
    {
//        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionAccount::export_accounts->value,'api'),Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $this->accountService->export();
    }

}