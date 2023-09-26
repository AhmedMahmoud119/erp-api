<?php

namespace App\Domains\Supplier\Models;

use App\Domains\Account\Models\Account;
use App\Domains\Currency\Models\Currency;
use App\Domains\Purchase\Models\Purchase;
use App\Domains\User\Models\User;
use App\Domains\Vendor\Models\Address;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Supplier extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'contact',
        'code',
        'parent_account_id',
        'currency_id',
        'address_id',
        'creator_id',
    ];
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function account()
    {
        return $this->belongsTo(Account::class,'parent_account_id');
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function purchase(): MorphMany
    {
        return $this->morphMany(Purchase::class, 'purchasable');
    }
    public function creator()
    {
        return $this->belongsTo(User::class,'creator_id');
    }
}
