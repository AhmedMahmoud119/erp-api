<?php

namespace App\Domains\JournalEntry\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class JournalEntry extends Model
{
    use HasFactory, SoftDeletes;
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
}