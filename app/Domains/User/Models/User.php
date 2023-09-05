<?php

namespace App\Domains\User\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Domains\BankAccount\Models\BankAccount;
use App\Domains\Role\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Collection\Collection;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'status',
        'parent_id',
        'creator_id',
    ];
    //    protected $appends = ['role'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function newFactory()
    {
        return \App\Domains\User\Database\Factories\UserFactory::new();
    }
    public function activeScope($query)
    {
        return $query->where('active', true);
    }
    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    public function children()
    {
        return $this->hasMany(User::class, 'parent_id');
    }
    public function descendants()
    {
        return $this->children()->with('descendants'); 
    }


}
