<?php

namespace App\Domains\Group\Models;

use App\Domains\Account\Models\Account;
use App\Domains\FixedAsset\Models\FixedAsset;
use App\Domains\GroupType\Models\GroupType;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Group extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'group_type_id',
        'code',
        'creator_id',
        'icon'
    ];
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    public function group_type()
    {
        return $this->belongsTo(GroupType::class, 'group_type_id');
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function children()
    {
        return $this->hasMany(Account::class)
            ->where('parent_id', null)
            ->with('children');
    }
    public function fixedAssets()
    {
        return $this->morphMany(FixedAsset::class, 'parent');
    }
}
