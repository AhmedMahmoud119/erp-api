<?php

namespace App\Domains\Group\Models;

use App\Domains\GroupType\Models\GroupType;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Group extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'group_type_id',
        'code',
        'parent',
        'creator_id',

    ];
    public function creator()
    {
        return $this->belongsTo(User::class,'creator_id');
    }
    public function group_type()
    {
        return $this->belongsTo(GroupType::class,'group_type_id');
    }


}
