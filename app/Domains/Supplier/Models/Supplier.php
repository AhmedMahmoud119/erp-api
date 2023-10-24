<?php

namespace App\Domains\Supplier\Models;

use App\Domains\Account\Models\Account;
use App\Domains\CashManagment\Models\CashManagment;
use App\Domains\Currency\Models\Currency;
use App\Domains\Purchase\Models\Purchase;
use App\Domains\Vendor\Models\Address;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
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
        'account_id',
        'currency_id',
//        'address_id',
    ];
//    public function address()
//    {
//        return $this->belongsTo(Address::class);
//    }

    public function parent()
    {
        return $this->belongsTo(Account::class,'parent_account_id');
    }
    public function account()
    {
        return $this->belongsTo(Account::class,'account_id');
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function purchase(): MorphOne
    {
        return $this->morphOne(Purchase::class, 'purchasable');
    }
    public function cash()
    {
        return $this->morphMany(CashManagment::class, 'cashable');
    }
}
