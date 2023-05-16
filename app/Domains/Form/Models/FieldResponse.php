<?php

namespace App\Domains\Form\Models;

use App\Domains\Field\Models\EnumFieldTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FieldResponse extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'form_field_id',
        'value',
        'submission_id',
    ];

    public function formField()
    {
        return $this->belongsTo(FormField::class);
    }


    public function setValueAttribute($value)
    {
        $this->attributes['value'] = is_array($value) ? json_encode($value) : $value;
    }

    public function getValueAttribute($value)
    {
        if(in_array($this->formField->field->type,[EnumFieldTypes::fileUpload->value,EnumFieldTypes::image->value])){
            return asset($value);
        }

        return is_array(json_decode($value)) ? json_decode($value) : $value;
    }
}
