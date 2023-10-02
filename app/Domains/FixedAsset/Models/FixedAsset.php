<?php

namespace App\Domains\FixedAsset\Models;

use App\Domains\Account\Models\Account;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FixedAsset extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'description',
        'acquisition_date',
        'acquisition_value',
        'depreciation_ratio',
        'depreciation_duration_value',
        'depreciation_duration_type',
        'depreciation_value',
        'parent_account_id',
        'parent_Group_id',
        'creator_id',
    ];
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    public function parent_group()
    {
        return $this->belongsTo(Group::class, 'parent_group_id');
    }
    public function parent_account()
    {
        return $this->belongsTo(Account::class, 'parent_account_id');
    }
} //End Of Model
