<?php

namespace App\Domains\GroupType\Models;

use App\Domains\Group\Models\Group;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class GroupType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'creator_id',
        'icon'
    ];
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function children()
    {
        return $this->hasMany(Group::class)->with('children');
    }
}
