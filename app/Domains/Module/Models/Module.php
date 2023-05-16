<?php

namespace App\Domains\Module\Models;

use App\Domains\Form\Models\FormModule;
use App\Domains\Permission\Models\PermissionCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Module extends Model
{
    use HasFactory,SoftDeletes;

    public function permissionCategories(){
        return $this->hasMany(PermissionCategory::class,'module_id');
    }

    public function forms()
    {
        return $this->belongsToMany(FormModule::class,'form_modules','module_id','form_id');
    }
}
