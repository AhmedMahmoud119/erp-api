<?php

namespace App\Domains\Vendor\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;


class State extends Model
{

    use HasFactory, SoftDeletes, HasTranslations;
    public $translatable = [
        'name',
    ];
    protected $fillable = [
        'name',
        'country_id'
    ];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
