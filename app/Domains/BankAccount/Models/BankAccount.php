<?php

namespace App\Domains\BankAccount\Models;

use App\Domains\Currency\Models\Currency;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;


class BankAccount extends Model
{
    use HasFactory,SoftDeletes,HasTranslations;
    public $translatable = [];

    protected $fillable = [
        'name',
        'account_number',
        'holder_name',
        'account_type',
        'chart_of_account',
        'currency_id',
        'opening_balance',
        'creator_id',
        'current_balance',
        'status',
        'authorized_by',


    ];
    public function creator()
    {
        return $this->belongsTo(User::class,'creator_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class,'currency_id');
    }


}
