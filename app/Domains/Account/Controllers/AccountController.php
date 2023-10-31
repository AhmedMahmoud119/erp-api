<?php

namespace App\Domains\Account\Controllers;


use App\Domains\Account\Models\Account;
use App\Domains\Account\Models\EnumPermissionAccount;
use App\Domains\Account\Request\ImportAccountRequest;
use App\Domains\Account\Request\ListAccountRequest;
use App\Domains\Account\Request\StoreAccountRequest;
use App\Domains\Account\Request\UpdateAccountRequest;
use App\Domains\Account\Resources\AccountParentsResource;
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

    public function list(ListAccountRequest $request)
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionAccount::view_accounts->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return AccountResource::collection($this->accountService->list());
    }
    public function parents()
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionAccount::view_accounts->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return AccountParentsResource::collection($this->accountService->parents());
    }
    public function notParents()
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionAccount::view_accounts->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return AccountParentsResource::collection($this->accountService->notParents());
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionAccount::delete_account->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $delete = $this->accountService->delete($id);

        if ($delete == 1) {
            return response()->json([
                'message' => __('Deleted Successfully'),
                'status' => true,
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => __('Cant Delete this Account'),
                'status' => false,
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function bulkDelete()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionAccount::delete_account->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $delete = $this->accountService->bulkDelete();

        if ($delete == 1) {
            return response()->json([
                'message' => __('Deleted Successfully'),
                'status' => true,
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => __('Cant Delete this Account'),
                'status' => false,
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

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

    public function import(ImportAccountRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionAccount::import_accounts->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->accountService->import();

        return response()->json([
            'message' => __('messages.imported_successfully'),
            'status' => true,
        ], 200);
    }

    public function exportExample()
    {
//        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionAccount::import_accounts->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//        $this->accountService->import();


        return response()->json([
            'file_path' => url('/account-example-import.xlsx'),
        ]);
    }

}
