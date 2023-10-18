<?php

namespace App\Domains\BankAccount\Models;

use App\Domains\Account\Models\Account;
use App\Domains\Currency\Models\Currency;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;


class BankAccount extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;
    public $translatable = [];

    protected $fillable = [
        'code',
        'name',
        'account_number',
        'holder_name',
        'account_type',
        'parent_account_id',
        'account_id',
        'parent_expenses_account_id',
        'expenses_account_id',
        'currency_id',
        'opening_balance',
        'creator_id',
        'current_balance',
        'status',
        'authorized_by',


    ];
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
    public function parent()
    {
        return $this->belongsTo(Account::class, 'parent_account_id');
    }
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function parentExpenses()
    {
        return $this->belongsTo(Account::class, 'parent_expenses_account_id');
    }
    public function accountExpenses()
    {
        return $this->belongsTo(Account::class, 'expenses_account_id');
    }


}
