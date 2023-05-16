<?php

namespace App\Domains\Form\Models;

use App\Domains\Field\Models\Field;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FormField extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'form_version_id',
        'field_id',
        'hidden',
    ];

    public function field(){
        return $this->belongsTo(Field::class);
    }

    public function formVersion(){
        return $this->belongsTo(FormVersion::class);
    }

    public function fieldResponses(){
        return $this->hasMany(FieldResponse::class);
    }
}
