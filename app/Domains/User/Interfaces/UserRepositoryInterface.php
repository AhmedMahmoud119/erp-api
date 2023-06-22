<?php

namespace App\Domains\User\Interfaces;

use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function findById(int $id);
    public function loginUser($request);
    public function logout();
    public function findByEmail(string $email);
    public function list();
    public function store($request): bool;
    public function update(int $id, $request): bool;
    public function delete(int $id): bool;
    public function updatePassword($request);
    public function me();


}
