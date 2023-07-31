<?php

namespace App\Domains\JournalEntry\Models;

use App\Domains\Tenant\Models\Tenant;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class JournalEntry extends Model
{
    use HasFactory,SoftDeletes;

}
