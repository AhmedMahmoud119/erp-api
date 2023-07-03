<?php

namespace App\Domains\Company\Models;

use App\Domains\Tenant\Models\Tenant;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Company extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'status',
        'creator_id',
//        'tenant_id',
    ];
    public function creator()
    {
        return $this->belongsTo(User::class,'creator_id');
    }
//    public function tenant()
//    {
//        return $this->belongsTo(Tenant::class,'tenant_id');
//    }
}
