<?php

namespace App\Domains\Currency\Models;

use App\Domains\Tenant\Models\Tenant;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Currency extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'symbol',
        'price_rate',
        'price',
        'backup_changes',
        'from',
        'to',
        'default',
        'creator_id',
    ];
    public function creator()
    {
        return $this->belongsTo(User::class,'creator_id');
    }

}
