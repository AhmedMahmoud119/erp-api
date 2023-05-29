<?php

namespace App\Domains\Form\Models;

use App\Domains\Field\Models\Field;
use App\Domains\Module\Models\Module;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;



class Form extends Model
{
    use HasFactory, SoftDeletes,HasTranslations;
    public $translatable = ['title'];

    protected $fillable = [
        'title',
        'last_version_id',
        'user_id'
    ];

    public function formVersions()
    {
        return $this->hasMany(FormVersion::class);
    }

    public function latestVersion() {
        return $this->hasOne(FormVersion::class)->latestOfMany();
    }

//    public function responses()
//    {
//        return $this->hasMany(FormField::class);
//    }

    public function modules()
    {
        return $this->belongsToMany(Module::class,'form_modules','form_id','module_id');
    }


}
