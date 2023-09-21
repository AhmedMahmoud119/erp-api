<?php

namespace App\Domains\Vendor\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Country extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];
    public function states()
    {
        return $this->hasMany(State::class);
    }
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}