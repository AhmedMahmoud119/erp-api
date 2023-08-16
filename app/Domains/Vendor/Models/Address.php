<?php

namespace App\Domains\Vendor\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'address',
        'phone',
        'name',
        'zip_code',
        'state_id',
        'city_id',
        'country_id',
    ];

    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
    public function state(){
        return $this->belongsTo(State::class);
    }
}
