<?php

namespace App\Domains\Vendor\Models;

use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Vendor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'status',
        'creator_id',
        'tenant_id',
        'user_id',
        'description'
    ];
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
