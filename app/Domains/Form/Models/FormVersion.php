<?php

namespace App\Domains\Form\Models;

use App\Domains\Field\Models\Field;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FormVersion extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'form_id',
        'version',
        'user_id'
    ];
    public function fields()
    {
        return $this->hasMany(FormField::class);
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
