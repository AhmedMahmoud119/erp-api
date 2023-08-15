<?php

namespace App\Domains\Vendor\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class State extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];
}
