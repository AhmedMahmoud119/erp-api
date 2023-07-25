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
//        return $request->status;
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionUser::create_user->value,'api'),Response::HTTP_FORBIDDEN, '403 Forbidden');

       $this->userService->store($request);
        return response()->json([
            'message' => __('Created Successfully'),
            'status' => true,

        ],200);
    }



    public function update($id,UpdateUserRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionUser::edit_user->value,'api'),Response::HTTP_FORBIDDEN, '403 Forbidden');

      $this->userService->update($id,$request);
        return response()->json([
            'message' => __('Updated Successfully'),
            'status' => true,

        ],200);
    }

    public function delete($id) {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionUser::delete_user->value,'api'),Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->userService->delete($id);

        return response()->json([
            'message' => __('Deleted Successfully'),
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
               'message' => __('Successfully logged in'),
               'token' => $user->createToken("API TOKEN", ['remember'])->plainTextToken,
              'data'=>  UserResource::make($user)
           ], 200);
        
       }
        return response()->json([
            'status' => false,
            'message' => __('Email & Password does not match with our record.'),
        ], 401);
    }
    public function updatePassword(ChangePasswordRequest $request)
    {
      if($this->userService->updatePassword($request))
      {
          return response()->json([
              'status' => true,
              'message' => __('Password changed successfully!'),
          ], 200);
      }
        return response()->json([
            'status' => false,
            'message' => __('Old Password Does not match'),
        ], 401);
    }

    public function logout()
    {
        $this->userService->logout();
        return response()->json([
            'status' => true,
            'message' =>__('Successfully logged out'),
        ], 200);
    }
    public function me(){
        return UserResource::make($this->userService->me());
    }

}
