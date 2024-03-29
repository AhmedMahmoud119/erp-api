<?php

namespace App\Domains\Account\Models;

use App\Domains\Currency\Models\Currency;
use App\Domains\Group\Models\Group;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Spatie\Translatable\HasTranslations;


class Account extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'group_id',
        'parent_id',
        'opening_balance',
        'account_type',
        'creator_id',
    ];

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function parent(){
        return $this->belongsTo(Account::class);
    }

}
