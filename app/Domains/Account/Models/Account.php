<?php

namespace App\Domains\Account\Models;

use App\Domains\Currency\Models\Currency;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;


class Account extends Model
{
    use HasFactory,SoftDeletes,HasTranslations;

    protected $fillable = [

    ];

}
