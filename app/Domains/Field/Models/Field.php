<?php

namespace App\Domains\Field\Models;

use App\Domains\Form\Models\FormField;
use App\Domains\Form\Models\FormVersion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;


class Field extends Model
{
    use HasFactory,SoftDeletes,HasTranslations;
    public $translatable = ['title' ,'options'];

    protected $fillable = [
        'title',
        'type',
        'some_requirements',
        'options',
    ];

    public function setSomeRequirementsAttribute($value)
    {
        $this->attributes['some_requirements'] = json_encode($value);
    }

    public function getSomeRequirementsAttribute($value)
    {
        return json_decode($value);
    }
    public function form_versions()
    {
        return $this->belongsToMany(FormVersion::class, 'form_field');
    }

    public function formField(){
        return $this->hasMany(FormField::class);
    }

}
