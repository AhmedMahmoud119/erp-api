<?php

namespace App\Domains\Vendor\Models;

use App\Domains\Account\Models\Account;
use App\Domains\Currency\Models\Currency;
use App\Domains\Purchase\Models\Purchase;
use App\Domains\User\Models\User;
use App\Domains\Vendor\Resources\AddressResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;


class Vendor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'contact',
        'email',
        'currency_id',
        'parent_account_id',
        'address_id',
        'billing_address_id',
        'creator_id',
    ];
    public function account()
    {
        return $this->belongsTo(Account::class, 'parent_account_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class,'currency_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function billingAddress()
    {
        return $this->belongsTo(Address::class,'billing_address_id');
    }

    public function purchase(): MorphOne
    {
        return $this->morphOne(Purchase::class, 'purchasable');
    }
}
