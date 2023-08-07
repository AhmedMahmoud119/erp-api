<?php

namespace App\Domains\FinancialPeriod\Models;

use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FinancialPeriod extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'financial_Year',
        'status',
        'financial_Year_Start',
        'financial_Year_End',
        'creator_id',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class,'creator_id');
    }

}
