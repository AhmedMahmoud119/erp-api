<?php

namespace App\Domains\JournalEntry\Models;

use App\Domains\User\Models\User;
use App\Traits\HasFinancialPeriod;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class JournalEntry extends Model
{
    use HasFactory, SoftDeletes, HasFinancialPeriod;
    protected $fillable = [
        'title',
        'entry_no',
        'date',
        'description',
        'creator_id',
    ];
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    public function details(): HasMany
    {
        return $this->hasMany(JournalEntryDetail::class, 'journal_entry_id');
    }
    public function getTotalDebitAttribute(): float
    {
        return $this->details->sum('debit');
    }
    public function getTotalCreditAttribute(): float
    {
        return $this->details->sum('credit');
    }
    public function getDifferenceAttribute(): float
    {
        return $this->total_debit - $this->total_credit;
    }
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::parse($value)->format('Y-m-d');
    }
}
