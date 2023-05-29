<?php

namespace App\Domains\User\Repositories;

use App\Domains\Role\Resources\RolePermissionsResource;
use App\Domains\User\Interfaces\UserRepositoryInterface;
use App\Domains\User\Models\User;
use App\Domains\User\Resources\UserResource;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class UserMySqlRepository implements UserRepositoryInterface
{
    public function __construct(private User $user)
    {
    }
    public function list()
    {
        return  $this->user::when(
            request()->search,
            function ($q) {
                $q->where('name', 'like', '%' . request()->search . '%')
                    ->orwhere('category', 'like', '%' . request()->search . '%');
            }
        )->with('roles')->paginate(request('limit', config('app.pagination_count')));
    }

    public function findById($id)
    {
        $user = $this->user::with('parent')->findOrFail($id);
        return $user;
    }

    public function findByEmail(string $email)
    {
        // TODO: Implement findByEmail() method.
    }


    public function store($request): bool
    {
        $password = Str::random(10);
        $user = $this->user::create($request->except('password') + ['creator_id' => auth()->user()->id, 'password' => $password,'status' => $request->status]);
        $user->roles()->sync($request->role_id);
        $subject = "Your Password For Your Email";
        $email = $request->email;
        $name = $request->name;
        Mail::send(
            'SendPasswordByEmail',
            ['name' => $name, 'password' => $password],
            function ($mail) use ($subject, $email) {
                $mail->from('admin@mail.com');
                $mail->to($email);
                $mail->subject($subject);
            }
        );

        return true;
    }

    public function update($id, $request): bool
    {
        $user = $this->user::findOrFail($id);
        $user->roles()->sync($request->role_id);
        $user->update($request->except(['password']));

        return true;
    }

    public function delete($id): bool
    {
        $this->user::findOrFail($id)?->delete();
        return true;
    }

    // Authentication methods
    public function loginUser($request)
    {

        $remember_me = $request->has('remember_me') ? true : false;
        if (!Auth::attempt($request->only(['email', 'password']), $remember_me)) {
            return false;
        }

        $user =  $this->user::where('email', $request->email)->first();

        return $user;
    }
    public function updatePassword($request)
    {
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return false;
        }

        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return true;
    }


    public function logout()
    {
        Auth::user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return true;
    }
}
