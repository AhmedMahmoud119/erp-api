<?php

namespace App\Domains\SafeMovement\Models;

use App\Domains\Account\Models\Account;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SafeMovement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date',
        'description',
        'amount',
        'source_id',
        'destination_id',
        'assets_involved',
        'creator_id',
    ];
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    public function destination()
    {
        return $this->belongsTo(Account::class, 'destination_id');
    }
    public function source()
    {
        return $this->belongsTo(Account::class, 'source_id');
    }

} //End Of Model
