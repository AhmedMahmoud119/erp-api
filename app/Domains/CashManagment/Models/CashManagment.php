<?php

namespace App\Domains\CashManagment\Models;

use App\Domains\Account\Models\Account;
use App\Domains\Customer\Models\Customer;
use App\Domains\Supplier\Models\Supplier;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CashManagment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date',
        'description',
        'amount',
        'payment_method',
        'account_id',
        'creator_id'
    ];
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
//    public function debtor()
//     {
//         return $this->belongsTo(Customer::class, 'debtor_id');
//     }
//     public function creditor()
//     {
//         return $this->belongsTo(Supplier::class, 'creditor_id');
//     }
   public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
    public function cashable()
    {
        return $this->morphTo();
    }
} //End Of Model
