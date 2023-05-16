<?php

namespace App\Domains\Tenant\Models;


use App\Domains\User\Models\User;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Illuminate\Database\Eloquent\SoftDeletes;


class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains,SoftDeletes;
    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'email',
            'phone',
            'status',
            'plan',
            'industry_type',
            'creator_id',
            'assigned_id',
        ];
    }

    public function assigned()
    {
        return $this->belongsTo(User::class,'assigned_id');
    }
    public function creator()
    {
        return $this->belongsTo(User::class,'creator_id');
    }

}
