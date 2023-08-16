<?php

namespace App\Domains\Tax\Models;

use App\Domains\Module\Models\Module;
use App\Domains\Tenant\Models\Tenant;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Tax extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'percentage',
        'creator_id',
        'module_id',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function modules(): MorphToMany
    {
        return $this->morphToMany(Module::class, 'moduleables');
    }
}
