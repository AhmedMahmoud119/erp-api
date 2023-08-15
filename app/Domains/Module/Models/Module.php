<?php

namespace App\Domains\Module\Models;

use App\Domains\Company\Models\Company;
use App\Domains\Form\Models\FormModule;
use App\Domains\Permission\Models\PermissionCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Module extends Model
{
    use HasFactory, SoftDeletes;

    public function permissionCategories()
    {
        return $this->hasMany(PermissionCategory::class, 'module_id');
    }
    public function forms(): BelongsToMany
    {
        return $this->belongsToMany(FormModule::class, 'form_modules', 'module_id', 'form_id');
    }
    public function taxes(): MorphToMany
    {
        return $this->morphedByMany(Tax::class, 'moduleables');
    }

    public function company(): MorphToMany
    {
        return $this->morphedByMany(Company::class, 'moduleables');
    }
}
