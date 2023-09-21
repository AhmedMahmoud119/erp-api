<?php

namespace App\Domains\Warehouse\Models;

use App\Domains\User\Models\User;
use App\Domains\Vendor\Models\Address;
use App\Traits\HasFinancialPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Warehouse extends Model
{
    use HasFactory, SoftDeletes,HasFinancialPeriod;

    protected $fillable = [
        'name',
        'description',
        'assigned_id',
        'creator_id',
        'address_id',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class,'creator_id');
    }
    public function assigned()
    {
        return $this->belongsTo(User::class,'assigned_id');
    }
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
