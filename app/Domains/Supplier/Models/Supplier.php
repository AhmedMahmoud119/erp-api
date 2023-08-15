<?php

namespace App\Domains\Supplier\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Supplier extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'contact',
        'code',
        'parent',
        'currency_id',
        'address_id',
    ];
    public function address()
    {
        return $this->hasMany(Address::class);
    }
    public function parent()
    {
        return $this->hasOne(Account::class,'parent');
    }
    public function currency()
    {
        return $this->hasMany(Currency::class);
    }
}
