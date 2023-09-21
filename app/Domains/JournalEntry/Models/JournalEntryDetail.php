<?php

namespace App\Domains\JournalEntry\Models;

use App\Domains\Account\Models\Account;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class JournalEntryDetail extends Model
{
  use HasFactory, SoftDeletes;
  protected $fillable = [
    'account_id',
    'debit',
    'credit',
    'journal_entry_id',
    'description'
  ];
  public function journalEntry(): BelongsTo
  {
    return $this->belongsTo(JournalEntry::class, 'journal_entry_id');
  }
  public function account(): BelongsTo
  {
    return $this->belongsTo(Account::class, 'account_id');
  }
  public function getAmountAttribute()
  {
    return $this->debit - $this->credit;
  }
}
