<?php

namespace App\Domains\Account\Models;

use App\Domains\Currency\Models\Currency;
use App\Domains\FixedAsset\Models\FixedAsset;
use App\Domains\Group\Models\Group;
use App\Domains\JournalEntry\Models\JournalEntryDetail;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Spatie\Translatable\HasTranslations;


class Account extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'group_id',
        'parent_id',
        'is_parent',
        'opening_balance',
        'account_type',
        'creator_id',
        'icon'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function parent()
    {
        return $this->belongsTo(Account::class);
    }

    public function journalEntryDetail(): HasMany
    {
        return $this->hasMany(JournalEntryDetail::class, 'account_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }
    public function children(): HasMany
    {
        return $this->hasMany(Account::class, 'parent_id')->with('children');
    }
    public function customers(): HasMany
    {
        return $this->hasMany(Account::class, 'parent_account_id');
    }
    public function fixedAssets()
    {
        return $this->morphMany(FixedAsset::class, 'parent');
    }


}
