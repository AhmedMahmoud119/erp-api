<?php

namespace App\Domains\User\Controllers;


use App\Domains\Permission\Models\EnumPermissionUser;
use App\Domains\Role\Resources\RolePermissionsResource;
use App\Domains\User\Exports\ExportUser;
use App\Domains\User\Request\ChangePasswordRequest;
use App\Domains\User\Request\LoginUserRequest;
use App\Domains\User\Request\StoreUserRequest;
use App\Domains\User\Request\UpdateUserRequest;
use App\Domains\User\Resources\UserResource;
use App\Domains\User\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Domains\User\Models\User;


class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
        $this->middleware('auth:sanctum', ['except' => ['loginUser']]);

    }


    public function list() {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionUser::view_users->value,'api'),Response::HTTP_FORBIDDEN, '403 Forbidden');

        return UserResource::collection($this->userService->list());
    }


    public function findById($id) {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionUser::view_users->value,'api'),Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource( $this->userService->findById($id));
    }


    public function store(StoreUserRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionUser::create_user->value,'api'),Response::HTTP_FORBIDDEN, '403 Forbidden');

       $this->userService->store($request);
        return response()->json([
            'message' => __('messages.created_successfully'),
            'status' => true,

        ],200);
    }



    public function update($id,UpdateUserRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionUser::edit_user->value,'api'),Response::HTTP_FORBIDDEN, '403 Forbidden');

      $this->userService->update($id,$request);
        return response()->json([
            'message' => __('messages.updated_successfully'),
            'status' => true,

        ],200);
    }

    public function delete($id) {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionUser::delete_user->value,'api'),Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->userService->delete($id);

        return response()->json([
            'message' => __('messages.deleted_successfully'),
            'status' => true,
        ],200);


    }
    public function export()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionUser::export_users->value,'api'),Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $this->userService->export();
    }

    // Authentication methods
    public function loginUser(LoginUserRequest $request)
    {
        $user=$this->userService->loginUser($request);
       if($user)
       {
           return response()->json([
               'status' => true,
               'message' => __('messages.successfully_logged_in'),
               'token' => $user->createToken("API TOKEN", ['remember'])->plainTextToken,
               'role'=>RolePermissionsResource::collection($user->roles)
           ], 200);
       }
        return response()->json([
            'status' => false,
            'message' => __('messages.email_&_password_does_not_match_with_our_record'),
        ], 401);
    }
    public function updatePassword(ChangePasswordRequest $request)
    {
      if($this->userService->updatePassword($request))
      {
          return response()->json([
              'status' => true,
              'message' => __('messages.password_changed_successfully'),
          ], 200);
      }
        return response()->json([
            'status' => false,
            'message' => __('messages.old_password_does_not_match'),
        ], 401);
    }

    public function logout()
    {
        $this->userService->logout();
        return response()->json([
            'status' => true,
            'message' =>__('messages.successfully_logged_out'),
        ], 200);
    }


}
