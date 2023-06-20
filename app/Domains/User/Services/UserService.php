<?php

namespace App\Domains\User\Services;


use App\Domains\User\Exports\UsersExport;
use App\Domains\User\Interfaces\UserRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;


class UserService
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function list() {
        return $this->userRepository->list();
    }


    public function findById($id) {
        return $this->userRepository->findById($id);
    }

    public function store( $request)
    {
        return $this->userRepository->store($request);
    }
    public function loginUser($request)
    {
        return $this->userRepository->loginUser($request);
    }
    public function updatePassword($request)
    {
        return $this->userRepository->updatePassword($request);
    }
    public function logout()
    {
        return $this->userRepository->logout();
    }

    public function update($id, $request)
    {
        return $this->userRepository->update($id,$request);
    }

    public function delete($id) {
        return $this->userRepository->delete($id);
    }
    public function export()
    {
        $filename = time() . '-users.csv';
        $path = 'exports/users/' . $filename;
        Excel::store(new UsersExport(), $path, 'public');

        return response()->json([
            'file_path' => asset('storage/'.$path)
        ]);
    }
    public function me(){
        return $this->userRepository->me();
    }
}
