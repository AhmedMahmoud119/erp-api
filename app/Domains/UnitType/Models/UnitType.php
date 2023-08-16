<?php

namespace App\Domains\UnitType\Models;

use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UnitType extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'creator_id'
    ];
    public function creator (){
        return $this->belongsTo(User::class,'creator_id');
    }
}
